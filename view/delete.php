<?php
include('boite_outils.php');


include('mesfonctions.php');

include_once("../model/database.php");



$user_model = new Database;
$connect = $user_model->connexion();

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $requete = "SELECT id_photo FROM commentaire WHERE id= $id";
        $re = $connect->prepare($requete);
      $re->execute();
      if($nuplet = $re->fetch(PDO::FETCH_ASSOC)){
        $id_photo = $nuplet['id_photo'];
        
       
    $sql="DELETE FROM commentaire where id=$id";
    $resu = $connect->prepare($sql);
      $resu->execute();
     if($resu){
        
       header ("location:photo.php?id=$id_photo");
     }
    }
    
    else{
         die("Error");
    }
 }
?>