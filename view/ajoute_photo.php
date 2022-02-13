<?php
include("boite_outils.php");
include("mesfonctions.php");
include_once("../model/database.php");

if ($_SESSION['login']) {
?>
	<html>

	<head>
		<title>Ajout de la photo ...</title>
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
		<hr>
		<?php
		print '<p><a href="photos_personne.php?personne=' . $login . '">Retour a l\'accueil</a></p>' . "\n"
		?>
	</body>

	</html>
<?php
} else {
	header("Location: ../index.php");
}

$connect = null;
?>