<?php
 ob_start(); // turns on output buffering
 $timezone = date_default_timezone_set('EDT');
 session_start();

 try
 {
   //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
 	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso;charset=utf8', 'enartsht_david', 'Wendy30');
 }
 catch (Exception $e)
 {
         die('Erreur : ' . $e->getMessage());
 }


 if(isset($_GET['id_valid'])){

   $id_valid = $_GET['id_valid'];

 // Requette de validation du compte de la mutuelle
    $req = $bdd->prepare('UPDATE muso SET valider = :valider WHERE id = :id')  or die(print_r($bdd->errorInfo()));
    $req->execute(array(
   	'valider' => "yes",
     'id' => $id_valid,
   	));

    $req->closeCursor();


   }

 ?>


 <!DOCTYPE html>
 <html>

 <head>
 	<title>valider email</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
 	<link rel="stylesheet" href="style3.css">
 </head>
 <!--Coded with love by Mutiullah Samim-->
 <body>
 	<div class="container h-100">
 		<div class="d-flex justify-content-center h-100">
 			<div class="user_card">
 				<div class="d-flex justify-content-center">
 					<div class="brand_logo_container">
 						<img src="logo-muso-mobil2.png" class="brand_logo" alt="Logo">
 					</div>
 				</div>

 				<div class="musomobil"><h6><center style="color:white">Votre  Muso est validée avec succès, <a href='login.php'><br>Cliquez ici pour aller au login<a><br> Merci</center><h6></div>
 			</div>
 		</div>
 		<div><center><img src="logo-muso.gif"></center></div>
 	</div>

 </body>
 </html>
