<?php
include("boite_outils.php");
include("mesfonctions.php");
include_once("../model/database.php");

if ($_SESSION['login']) {
?>
	<html>

	<head>
		<title>Ajout de la photo ...</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<style>
		body {
					background-image: url("https://wallpapercave.com/wp/wp3589868.jpg");
					background-repeat: no-repeat;
					background-size: cover;
					font-family: 'Open Sans', sans-serif;
					align-items: center;
					justify-content: center;
					margin-left: 35%;

				}
		</style>
	</head>

	<body>
		<?php
		if (isset($_POST['description'])) {
			$description = addslashes($_POST['description']);
		} else {
			$description = "";
		}

		if (isset($_POST['date_photo'])) {
			$date_photo = verifie_date($_POST['date_photo']);
		} else {
			$date_photo = date('Y-m-d');
		}

		$fichier = sauve_photo('photo');

		if ($fichier != null) {
			$user_model = new Database;
			$connect = $user_model->connexion();
			if (isset($login)) {
				$requete = "INSERT INTO photo(fichier,date_photo,description,proprietaire) VALUES ('$fichier','$date_photo','$description','$login')";
			}
			$resultat = $connect->prepare($requete);
			$resultat->execute();
			print "<h3>Photo ajoutee:</h3>";
			affiche_photo($login, $date_photo, stripslashes($description), $fichier);
		} else {
			print "<p><b>Echec de l'ajout de la photo !!!</b></p>";
		}
		?>
		
		<hr width='500px' style='margin-left:-1px'>
		<?php
		print '<a href="photos_personne.php?personne=' . $login . '" class="btn btn-dark">Retour a l\'accueil</a>' . "\n"
		?>
	</body>

	</html>
<?php
} else {
	header("Location: ../index.php");
}

$connect = null;
?>