<?php
   
   include("../model/utilisateur.php");
    session_start();
    $user_model=new Utilisateur;


    if(isset($_POST["submit"])){
        if($_POST["password"] == $_POST["password2"] ){
            $user = $user_model->reinitialisation_mot_de_passe($_SESSION["email"], $_POST["password"]);
            if($user == false)
            {
                echo "There is a probleme occured";
            }
            else
            {
                echo "Password changed succefully";
                header("Refresh: 2; url=../view/login.php");
            }
        }
        else
        {
            echo "Passwords doesn't match";
        }
        session_destroy();
    }
?>