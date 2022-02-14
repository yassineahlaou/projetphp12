<?php
session_start();
include_once("../model/database.php");



function login_ou_reconnection() {
	global $login;
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
	} 
	else {
		header( "refresh 5 url=../index.php ");
	}
	}



function detruire_session()
{
	$_SESSION = array();
	session_write_close();
}

function deconnexion() {
	detruire_session();	
}


/*function delete_comment($deleteid){
	$connect = connexion();
	$requete1 = "SELECT id_photo FROM commentaire WHERE id= $deleteid";
	$re1 = $connect->prepare($requete1);
  $re1->execute();
  if($nuplet = $re1->fetch(PDO::FETCH_ASSOC)){
	$id_photo = $nuplet['id_photo'];
	
   
$sql1="DELETE FROM commentaire where id=$deleteid";
$resu1 = $connect->prepare($sql1);
  $resu1->execute();
 if($resu1){

	
   header ("location:photo.php?id=$id_photo");
 }
}


}*/


function delete_photo($id_ph,$perso_param){	
	$user_model = new Database;
	$connect = $user_model->connexion();
    $query1 = "DELETE FROM commentaire WHERE id_photo = '$id_ph'";
    $rt1 = $connect->prepare($query1);
    $rt1->execute();
	if ($rt1)
	{
    
    $query = "DELETE FROM photo WHERE id = '$id_ph'";
    $rt = $connect->prepare($query);
    $rt->execute();
	if ($rt)
	{
	header ("location:photos_personne.php?personne=$perso_param");
	}
	}
	
}

function charger_page($page)
{	
	echo "<script>
	<!-- Hide from JavaScript-Impaired Browsers
 	parent.location=\"" . $page . "\"
	// End Hiding -->
	</script>";
}
	
function genere_nom_fichier($nom_depart) {
	if (file_exists($nom_depart)) {
		$ppos = strrpos($nom_depart,'.');
		$ext = substr($nom_depart,$ppos);
		$prefix = substr($nom_depart,0,$ppos);
		$i=0;
		while(file_exists("$prefix$i$ext")) {
			$i++;
		}
		return $prefix.$i.$ext;
	} else {
		return $nom_depart;
	}
}
	
function sauve_photo($param_fichier) {
	global $login;
	if ($param_fichier == null) {
		die("Il faut specifier le nom du parametre dans ".
		    "lequel est stockee la photo a la fonction sauve_photo !!!");
	}	
	
	if ($_FILES[$param_fichier]['error']) {
		switch ($_FILES[$param_fichier]['error']){
	    case UPLOAD_ERR_INI_SIZE:
           	print "Le fichier depasse la limite autorisee par le serveur (fichier php.ini).";
           	break;
        case UPLOAD_ERR_FORM_SIZE:
           	print "Le fichier depasse la limite autorisee dans le formulaire HTML.";
           	break;
        case UPLOAD_ERR_PARTIAL:
           	print "L'envoi du fichier a ete interrompu pendant le transfert.";
          	break;
        case UPLOAD_ERR_NO_FILE:
           	print "Le fichier que vous avez envoye a une taille nulle.";
         	break;
	 	case UPLOAD_ERR_NO_TMP_DIR:
	 		print "Pas de repertoire temporaire defini.";
	 		break;
	 	case UPLOAD_ERR_CANT_WRITE:
	 		print "Ecriture du fichier impossible.";
	 	default:
			print "Erreur inconnue.";
		}
		return null;
	}
	else {
	 	$chemin_destination = '../photos/'.rawurlencode($login);
		@mkdir($chemin_destination);
	 	$chemin_destination = $chemin_destination.'/';
	 	$urlphoto=$chemin_destination.$_FILES[$param_fichier]['name'];
	 			$urlphoto=genere_nom_fichier($urlphoto);
	 	move_uploaded_file($_FILES[$param_fichier]['tmp_name'],$urlphoto);
	 	return $urlphoto;
	}
}



	
function verifie_date($date) {
	$timestamp = strtotime($date);
	if ($timestamp && $timestamp != -1) {
		return date('Y-m-d',$timestamp);
	} else {
		return date('Y-m-d');
	}
}
	
login_ou_reconnection();
