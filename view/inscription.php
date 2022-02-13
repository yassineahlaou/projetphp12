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
            <h2>Create Account</h2>
        </div>
        <form action="../controller/controleur_inscription.php" method="post" id="form" class="form">
            <div class="form-control">
                <label for="fullname">Full name</label>
                <input type="text" placeholder="enter your name" id="fullname" name="fullname" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" placeholder="enter your name" id="username" name="username" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Email</label>
                <input type="email" placeholder="enter a valid email" id="email" name="email" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
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
            <button id="button">Check informations</button>
            <button type="submit">Submit</button>
            <br>
            <a href="login.php">Return to login page</a>

        </form>
    </div>
    <script src="form.js"></script>
</body>

</html>