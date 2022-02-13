<?php
include('boite_outils.php');

include_once("../model/database.php");



$user_model = new Database;
$connect = $user_model->connexion();?>
<html>
<head>
<title>Photo</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style>
      body {
				background-image: url("https://images.unsplash.com/photo-1579546929518-9e396f3cc809?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEzNzYzNn0?utm_source=dictionnaire&utm_medium=referral");
				background-repeat: no-repeat;
				background-size: cover;
				font-family: 'Open Sans', sans-serif;
				align-items: center;
				justify-content: center;
        		margin-left: 35%;

			}
    </style>
  <title>Mise a jour d'une photo</title>
  <script  type="text/javascript" src="fonctions.js"> </script>
</head>
<body>

<?php
if (isset($_GET['id'])) {
	$id_photo = $_GET['id'];
	$requete = "SELECT fichier,date_photo,description,proprietaire FROM photo WHERE id = $id_photo";
	$resultat = $connect->prepare($requete);
    $resultat->execute();
	if ($nuplet = $resultat->fetch(PDO::FETCH_ASSOC)) {
	 	if ($nuplet['proprietaire'] == $login) {
			$personne = $nuplet['proprietaire'];
			$personne_param = rawurlencode($personne);
	 		$fichier = $nuplet['fichier'];
	 		$date = $nuplet['date_photo'];
	 		$description = stripslashes($nuplet['description']);
			print "<br><br>";
	 		print "<h2><b>Modification de la photo</b></h2><br><br>\n";
	 		print "<form action='photo.php' method='POST' name='maj'>\n";
			 print "<p><b>Description</b></p>";
	 		print "<p><textarea name='description' rows='10' cols='60'>$description</textarea></p>\n";
	 		print "<p><b>Date de la photo: </b>";
	 		input_date('date_photo','maj',$date);
	 		print "</p>\n";
			
	 		print "<input type='hidden' name='id' value='$id_photo'>";
	 		print "<input type='hidden' name='but' value='maj'>";
	 		print "<p><input type='submit' value='Envoyer' class='btn btn-success'></p>\n";
			 

			print "<a href='photo.php?id=$id_photo' class='btn btn-warning'>Annuler les modifications</a>";



	 		print "</form>\n";

			 if (isset($_POST['delete_photo'])) {
				
				delete_photo($id_photo,$personne_param);
				
			}
			 print "<div>";
			 print "<form method='POST'>\n";
			 print "<p><input type='submit' value='Supprimer photo' name='delete_photo' class='btn btn-danger'></p>\n";
			 print "</form>";
			 print "</div>\n";
			 
			
			 //print "<a href=\"deletephoto.php?delid=$id_photo\">Supprimer la photo</a>";
			 
	 		print "<p><img src='$fichier' width='300px' heigth='300px'></p>";
	 	} else {
	 		print "<p><b>Vous ne pouvez pas modifier les informations de cette photo !</b></p>";
		}
  } else {
  	print 'a'.$nuplet.'b';
	  print "<p><b>Photo non existante !</b></p>";
  }
} else {
	print "<p><b>Photo non specifiee !</b></p>";
}
?>
</body>
</html>
<?php
$connect = null;
?>