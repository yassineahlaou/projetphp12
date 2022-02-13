<?php
include('boite_outils.php');


include('mesfonctions.php');



include_once("../model/database.php");



$user_model = new Database;
$connect = $user_model->connexion();
	
if (isset($_POST['but']) && $_POST['but'] == 'ajout_commentaire') {
	$id_photo = $_POST['id'];
	$contenu = addslashes($_POST['contenu']);
	if ($id_photo != null) {
		$requete = "INSERT INTO commentaire(contenu,id_photo,auteur) VALUES ('$contenu',$id_photo,'$login')";
		$resultat = $connect->prepare($requete);
        $resultat->execute();
	}

} else if (isset($_POST['but']) && $_POST['but'] == 'maj') {
	$id_photo = $_POST['id'];
	$date = verifie_date($_POST['date_photo']);
	$description = addslashes($_POST['description']);
	if ($id_photo != null) {
		$requete = "UPDATE photo SET description = '$description', date_photo = '$date' WHERE id = $id_photo";
		$resultat = $connect->prepare($requete);
        $resultat->execute();
	}
} else {
	$id_photo = $_GET['id'];
}

?>
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
</head>
<body>
<?php
	if ($id_photo == null) {
		print "<p><b>Aucune photo de specifiee!</b></p>";
	} else {
	  $requete = "SELECT fichier,date_photo,description,proprietaire FROM photo WHERE id = $id_photo";
	  $resultat = $connect->prepare($requete);
      $resultat->execute();
	  if ($nuplet = $resultat->fetch(PDO::FETCH_ASSOC)) {
	  	$proprietaire = $nuplet['proprietaire'];
		  $personne_param = rawurlencode($proprietaire);
		  $fi= $nuplet['fichier'];
		  $da = $nuplet['date_photo'];
		  $desc = $nuplet['description'];

		  print "<div>\n";
		  print "<br><br><p style='margin-left:80px;'><img src='$fi'  width=\"300\" height=\"300\"></p>\n";
		  $date = strtotime($da);
		  $date_affichee = date('d/m/Y',$date);
		  print "<p><b>Photo de <a href=\"photos_personne.php?personne=$personne_param\">$proprietaire</a> prise le  $date_affichee</b></p>\n";
		  
		  print "<p>$desc</p>\n";
		  print "</div>\n";
		  print "<hr width='500px' style='margin-left:-1px'>";

		  print "<p><b>Les commentaires</b></p>\n";

		  
		  
	  /*	affiche_photo(
	  			$proprietaire,
	  			$nuplet['date_photo'],
	  			stripslashes($nuplet['description']),
	  			$nuplet['fichier']);*/
	  	$requete = "SELECT id, auteur, contenu, depot FROM commentaire WHERE id_photo = $id_photo";
	  	$resultat = $connect->prepare($requete);
        $resultat->execute();
	  	while ($nuplet = $resultat->fetch(PDO::FETCH_ASSOC)) {
			$deleteid = $nuplet['id'];

			$auteur = $nuplet['auteur'];
			$personne_param = rawurlencode($auteur);
			$date_commentaire = $nuplet['depot'];
			$contenu = $nuplet['contenu'];

			print "<div>\n";
	print "<p><b><a href=\"photo
	s_personne.php?personne=$personne_param\">$auteur</a></b> ($date_commentaire):</p>\n";
	print "<p>$contenu </p>";
		  
	$requet = "SELECT proprietaire FROM photo WHERE id = $id_photo";
	  $result = $connect->prepare($requet);
      $result->execute();
	  if ($nuplet = $result->fetch(PDO::FETCH_ASSOC)) {
		$proprietaire = $nuplet['proprietaire'];
		$personne_param = rawurlencode($proprietaire);
		
	
	if ($login==$personne_param )
	{
		
		 

		
		
		print "<a href=\"delete.php?deleteid=$deleteid\" >Delete </a>";
	}
}
	
	print "</div>";
	  		/*affiche_commentaire(
	  				$nuplet['auteur'],
	  				$nuplet['depot'],
	  				stripslashes($nuplet['contenu']));*/

	  	}
	  	
	  	print "<div>";
	  	print "<form action='photo.php?id=$id_photo' method='POST'>\n";
	  	print "<h3><b>Ajouter un commentaire</b></h3>";
	  	print "<p><textarea name='contenu' rows='10' cols='60' placeholder='entrer votre commentaire'></textarea></p>\n";
	  	print "<input type='hidden' name='but' value='ajout_commentaire'>";
	  	print "<input type='hidden' name='id' value='$id_photo'>";
	  	print "<p><input type='submit' value='Ajouter' class='btn btn-success'><input type='reset' value='Vider' class='btn btn-danger'></p>\n";
	  	print "</form>";
	  	print "</div>\n";
	  } else {
	  	print "<p><b>Cette photo n'existe pas!</b></p>";
	  }
	} 
?>
<br>
<?php
if ($proprietaire == $login) {
	print "<p class='btn btn-warning'><a href='modifie_photo.php?id=$id_photo'>Modifier les informations sur cette photo</a>.</p>";
}
?>
<?php
		print '<p><a href="photos_personne.php?personne=' . $personne_param . '" class="btn btn-dark">Retour au profil</a></p>' . "\n"
?>

</body>
</html>
<?php
$connect = null;
?>
