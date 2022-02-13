<?php
include('boite_outils.php');

include_once("../model/database.php");



$user_model = new Database;
$connect = $user_model->connexion();?>
<html>
<head>
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
			//$id = $nuplet['id'];
			$personne_param = rawurlencode($personne);
	 		$fichier = $nuplet['fichier'];
	 		$date = $nuplet['date_photo'];
	 		$description = stripslashes($nuplet['description']);
	 		print "<h2>Modification de la photo</h2>\n";
	 		print "<form action='photo.php' method='POST' name='maj'>\n";
	 		print "<p><textarea name='description' rows='10' cols='60'>$description</textarea></p>\n";
	 		print "<p>Date de la photo: ";
	 		input_date('date_photo','maj',$date);
	 		print "</p>\n";
			
	 		print "<input type='hidden' name='id' value='$id_photo'>";
	 		print "<input type='hidden' name='but' value='maj'>";
	 		print "<p><input type='submit' value='Envoyer'></p>\n";
			 

			print "<button><a href='photo.php?id=$id_photo'>Annuler les modifications</a></button>";



	 		print "</form>\n";

			 if (isset($_POST['delete_photo'])) {
				
				delete_photo($id_photo,$personne_param);
				
			}
			 print "<div>";
			 print "<form method='POST'>\n";
			 print "<p><input type='submit' value='Supprimer photo' name='delete_photo'></p>\n";
			 print "</form>";
			 print "</div>\n";
			 
			
			 //print "<a href=\"deletephoto.php?delid=$id_photo\">Supprimer la photo</a>";
			 
	 		print "<p><img src='$fichier'></p>";
	 	} else {
	 		print "<p><b>Vous ne pouvez pas modifier les informations de cette photo !</b></p>";
		}
  } else {
  	print 'a'.$nuplet.'b';
	  print "<p><b>Photo non existante !</b></p>";
  }
} else {
	print "<p><b>Photo non sp�cifi�e !</b></p>";
}
?>
</body>
</html>
<?php
$connect = null;
?>