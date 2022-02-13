<html>

<head>
    <link rel="stylesheet" href="form.css">
    <title>Saisie des identifiants</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Reset password:</h2>
        </div>

        <form action='../controller/controleur_mailer.php' method='post' class='form'>
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" placeholder="enter your email" id="email" name="email" size="32" maxlength="128" required/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>

            <button type="submit" name="submit">Reset</button>

            <br>
            
            <a href="login.php">Return to login page</a>
        </form>
    </div>
</body>

</html>