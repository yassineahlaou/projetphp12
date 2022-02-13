<?php
include("../model/utilisateur.php");
    session_start();
    $user_model=new Utilisateur;


    if(isset($_POST["submit"])){
        if(!empty($_SESSION["token"]) && $_SESSION["token"] == $_POST["token"] && !empty($_SESSION["email"])){
            $user = $user_model->find_user_by_email("1", $_SESSION["email"]);
            if($user == false)
            {
                echo "There's no account associated with this email";
            }
            else
            {
                header("Location: ../view/new_password.php");
            }
        }
        else
        {
            echo "Token invalid";
        }
    }
?>