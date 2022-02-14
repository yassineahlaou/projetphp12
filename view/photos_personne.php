<?php
include('boite_outils.php');


include_once("../model/database.php");



$user_model = new Database;
$connect = $user_model->connexion();
$personne = $_GET['personne'];


if ($_SESSION['login']) {
?>



  <html>

  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type='text/javascript'>
      $(document).ready(function() {
        $('.dateFilter').datepicker({
          dateFormat: "yy-mm-dd"
        });
      });
    </script>
    <style>
      body {
				background-image: url("https://wallpapercave.com/wp/wp3589868.jpg");
				background-repeat: no-repeat;
				background-size: cover;
				font-family: 'Open Sans', sans-serif;
				align-items: center;
				justify-content: center;
        margin-left: 25%;

			}

.imggallery{

width: 75%;




}

      div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 220px;
  height: 300px;

}


div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: 200px;
}

div.desc {
  padding: 1px;
  text-align: center;
}
    </style>

    <?php
    print "<title>Photos de $personne</title>";
    ?>
  </head>

  <body>
    <br><br>
    <form method='post' action=''>
      <b>Start Date</b> <input style="width:200px; border-radius:3px;" type="date" class="dateFilter" name="fromDate" value="<?php if (isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>">

      <b>End Date</b> <input style="width:200px; border-radius:3px;" type="date" class="dateFilter" name="endDate" value="<?php if (isset($_POST['endDate'])) echo $_POST['endDate']; ?>">

      <input type="submit" name="but_search" value="Search" class="btn btn-success">
    </form>
     <?php
    print '<br><p><a href="acceuille.php" class="btn btn-dark">Retour a l\'accueil</a></p>' . "\n"
  ?>
    <!--<input type ="text" name = "from_date"  id = "from_date">
<input type ="text" name = "to_date"  id = "to_date">
<input type ="button" name = "filter"  id = "filter" value = "Filtrer">-->

    <?php
    print "<h2>Photos de $personne</h2><br>\n";
    ?>


    <!-- Employees List -->
    <div class="imggallery">

      

        <?php
        $emp_query = "SELECT * FROM photo WHERE proprietaire = '$personne'";

        // Date filter
        if (isset($_POST['but_search'])) {
          $fromDate = $_POST['fromDate'];
          $endDate = $_POST['endDate'];

          if (!empty($fromDate) && !empty($endDate)) {
            $emp_query .= " AND date_photo 
                          BETWEEN '" . $fromDate . "' and '" . $endDate . "' ";
          }
        }

        // Sort
        $emp_query .= " ORDER BY date_photo  DESC";
        //$employeesRecords = mysqli_query($connect,$emp_query);
        $resultat = $connect->prepare($emp_query);
        $resultat->execute();
        $row_count = $resultat->rowCount();


        // Check records found or not
        if ($row_count > 0) {
          while ($empRecord = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $id_photo = $empRecord['id'];
            $date = $empRecord['date_photo'];
            $fichier = $empRecord['fichier'];
            $personne_param = rawurlencode($personne);
            $description_courte = substr(stripslashes($empRecord['description']), 0, 30);
            if (strlen($empRecord['description']) > 30) {
              $description_courte = $description_courte . '...';
            }



            echo "<div class='gallery'>";
 
    echo "<a href=\"photo.php?id=$id_photo\"><img src=\"$fichier\"  width='200' height='200'></a>";
  
echo"<div class='desc'><a href=\"photo.php?id=$id_photo\">$description_courte</a></div><div class='desc'>$date </div></div>";




          }
        } else {
          echo"<table>";
          echo "<tr>";
          echo "<td colspan='3'>No record found.</td>";
          echo "</tr>";
          echo"<table>";
        }
        ?>
      
    </div>
    <br>








    <!--print "<ol>\n";
$requete = "SELECT * FROM photo WHERE proprietaire = '$personne'";
$resultat = $connect->prepare($requete);
$resultat->execute();

while ($nuplet = $resultat->fetch(PDO::FETCH_ASSOC)) {
	$id_photo = $nuplet['id'];
	$date = $nuplet['date_photo'];
	
		$personne_param = rawurlencode($personne);
	$description_courte = substr(stripslashes($nuplet['description']),0,30);
	if (strlen($nuplet['description']) > 30) {
		$description_courte = $description_courte.'...';
	}
	$resume = $description_courte.$date;
	print "<div id=\"order_list\">";
	print "<li><a href='photo.php?id=$id_photo'>$resume</a></li>";
	print "</div>";
}

print "</ol>\n";
?>-->
  
  </body>

  </html>
  <!--<script>
    $(document).ready(function(){
		$.datepicker.setDefaults({
   dateFormat:'yy-mm-dd'
});
        $(function(){
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });

		$('#filter').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    if(from_date != '' && to_date != '')
  {
	  
        $.ajax({
            url:"filter.php",
            method: "POST",
            data:{from_date:from_date, to_date:to_date},
			
            success:function(data)
            {
				console.log(data);
				$('#order_list').html = data; // erreur
				alert("hello");   
            }
			
		});
	}
		else {
			alert("Please Select date");
		}
    });
});
</script>-->
<?php
} else {
  header("Location: ../index.php");
}


$connect = null;
?>