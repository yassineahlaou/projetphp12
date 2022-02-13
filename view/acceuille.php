<?php
include("boite_outils.php");
include_once("../model/database.php");


$user_model = new Database;
$connect = $user_model->connexion();

if ($_SESSION['login']) {
?>

	<html>

	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<title>Accueil</title>
		<style>
			body {
				background-image: url("https://images.unsplash.com/photo-1579546929518-9e396f3cc809?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEzNzYzNn0?utm_source=dictionnaire&utm_medium=referral");
				background-repeat: no-repeat;
				background-size: cover;
				font-family: 'Open Sans', sans-serif;
				align-items: center;
				justify-content: center;
			}

			center, h3 {
				color: black;
			}

			ul {
				
				list-style-type: none;
				margin: 0;
				width:138%;
				padding: 0;
				overflow: hidden;
				background-color: #333;
			}
			li {
			float: left;
			border-right:1px solid #bbb;
			}

			li:last-child {
			border-right: none;
			}

			li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			}

			li a:hover:not(.active) {
			background-color: #111;
			}
			div {
				padding-left: 20%;
				width: 900px;
				height: 620px;
				margin-bottom: 20px;
			}

			div #form{
				margin-left: 20%;
				border: solid black 2px;
				border-radius: 1%;
			}
			textarea {
				border-radius: 2%;
			}
			hr{
				width: 80%;
			}

		</style>
		<script src="fonctions.js"> </script>
		<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
	</head>

	<body>
		<?php
		print "<center><h1><b>Bienvenue $login</b></h1></center><br>";
		?>
		<div>
			<h3><b>Voir les photos de:</b></h3>
			<ul>
				<?php
				$requete = "SELECT login FROM utilisateur";
				$resultat = $connect->prepare($requete);
				$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$resultat->execute();
				while ($nuplet = $resultat->fetch(PDO::FETCH_ASSOC)) {
					$personne = $nuplet['login'];
					$personne_param = rawurlencode($personne);
					print '<li ><a href="photos_personne.php?personne='
						. $personne_param . '">' . $personne . '</a></li>' . "\n";
				}
				?>
			</ul>
		<br><br>
			<div id="form" class="container">
			<h3><b>Ajouter une photo a ma collection</b></h3>
			<br>
			<form action="ajoute_photo.php" method="POST" enctype="multipart/form-data" name="add_photo">
				<p>Fichier de la photo: <input type="file" name="photo" size=30 class="btn btn-light"></p>
				<p>Description de la photo:</p>
				<p><textarea name="description" rows="10" cols="50" placeholder="entrer la description de votre photo"></textarea></p>
				<p>Date de la photo: <? input_date('date_photo', 'add_photo'); ?></p>

				<p>
					<input type="submit" class="btn btn-success" value="Ajouter la photo">
					<input type="reset" class="btn btn-danger" value="Annuler">
				</p>
			</form>
			<br>
			<p><a href="../controller/controleur_deconnexion.php" class="btn btn-dark">Se deconnecter</a></p>
			</div>
		</div>
	</body>

	</html>
<?php

} else {

	header("Location: ../index.php");
}


$connect = null;
?>