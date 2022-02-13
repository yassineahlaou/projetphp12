<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Inscription</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Enter your new password</h2>
        </div>
        <form action="../controller/controleur_password.php" method="post" id="form" class="form">
            <div class="form-control">
                <label for="username">Password</label>
                <input type="password" placeholder="password" id="password" name="password" minlength="6" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Password check</label>
                <input type="password" placeholder="comfirm your password" id="password2" name="password2" minlength="6" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <button type="submit" name="submit">Validate</button>
        </form>
    </div>
</body>

</html>