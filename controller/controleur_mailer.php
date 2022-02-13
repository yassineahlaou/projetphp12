<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    require '../vendor/autoload.php';
 
    session_start();

    if (isset($_POST["submit"]))
    {
        $email = $_POST["email"];
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
            $mail->setFrom($email, 'mini Facebook');
            $mail->addAddress($email, "client : ");
            $mail->isHTML(true); 
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $_SESSION['token'] = $verification_code;
            $_SESSION['email'] = $email;
            $mail->Subject = 'Password reset';
            $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
            $mail->send(); 
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            header("Location: ../view/token.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>

