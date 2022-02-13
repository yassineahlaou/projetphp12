<?php
include("../model/utilisateur.php");
    session_start();
    $user_model=new Utilisateur;


    if(isset($_POST["verify_account"])){
        if(!empty($_SESSION["code"]) && $_SESSION["code"] == $_POST["code"] && !empty($_SESSION["email"])){
            $user = $user_model->verify($_SESSION["email"]);
            if($user == false)
            {
                echo "Error";
            }
            else
            {
                header("Location: ../view/index.php");
            }
        }
        else
        {
            echo "Code invalid";
        }
    }
?>