<html>

<head>
    <link rel="stylesheet" href="form.css">
    <title>Saisie des identifiants</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2 style="color:red;">Your account isn't yet verified !</h2>
            <p>A verifiaction code was sent to your email <br>
                <b>Please enter it below : </b>
            </p>
        </div>

        <form action='../controller/controleur_activation.php' method='post' class='form'>
            <div class="form-control">
                <label for="token">Code:</label>
                <input type="text" placeholder="enter the code sent to your email" id="email" name="code" size="32" maxlength="128" required/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>

            <button type="submit" name="verify_account">Validate</button>
        </form>
    </div>
</body>

</html>