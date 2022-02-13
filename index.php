<html>

<head>
    <link rel="stylesheet" href="form.css">
    <title>Saisie des identifiants</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Connexion to the website:</h2>
        </div>

        <form action='controller/controleur_login.php' method='POST' class='form'>
            <div class="form-control">
                <label for="username">Username:</label>
                <input type="text" placeholder="enter your username" id="username" name="login" size="32" maxlength="128" required />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>

            <div class="form-control">
                <label for="username">Password:</label>
                <input type="password" placeholder="password" id="password" name="password" size="32" maxlength="32" required />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>

            <button type="submit">Sign in</button>
            <button type="reset">Clear</button>
            <br>

            &emsp;<a href="view/inscription.php">Sign up</a>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
            <a href="view/forgotten_password.php">Forgotten password</a>
        </form>
    </div>
</body>

</html>