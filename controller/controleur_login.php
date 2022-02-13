<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';
    require_once("../model/utilisateur.php");

    session_start();

    $user_model=new Utilisateur;
    $user = $user_model->login($_POST["login"], $_POST["password"]);
    $_SESSION["login"] = $_POST["login"];
    if($user == false)
    {
        echo "Invalid account";
    }
    else
    {
        if($user_model->is_verified($_POST["login"]) == "1"){
            header("Location: ../view/acceuille.php");
        }
        else
        {
            $email = $user->email;
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP(); 
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'testjava665@gmail.com';
                $mail->Password = 'testJava...!';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom($email, 'Mini Facebook');
                $mail->addAddress($email, "Client : ");
                $mail->isHTML(true); 
                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                $_SESSION['code'] = $verification_code;
                $_SESSION['email'] = $email;
                $mail->Subject = 'Account verification';
                $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
                $mail->send(); 
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
                header("Location: ../view/account_verification.php");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>