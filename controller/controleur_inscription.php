<?php
require_once("../model/utilisateur.php");

$user_model=new Utilisateur;

if($user_model->find_user_by_email($_POST["username"], $_POST["email"]))
        {
            echo "Email or username already exist";
            //header("Refresh: 2; url=view/form.php");
        }
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        if($user_model->inscription($_POST["fullname"], $_POST["email"], $_POST["username"], $password)){
            header("Refresh: 2; url=../view/login.php");
        }
        else
        {
            die("something wrong !");
        }
?>