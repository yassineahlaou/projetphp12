<html>

<head>
    <link rel="stylesheet" href="form.css">
    <title>Saisie des identifiants</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Enter the token sent to your email:</h2>
        </div>

        <form action='../controller/controleur_token.php' method='POST' class='form'>
            <div class="form-control">
                <label for="token">Token:</label>
                <input type="text" placeholder="enter your token" id="email" name="token" size="32" maxlength="128" required/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>

            <button type="submit" name="submit">Validate</button>
        </form>
    </div>
</body>

</html>