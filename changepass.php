<?php
 ob_start(); // turns on output buffering
 $timezone = date_default_timezone_set("America/Chicago");
 session_start();

 // variable to insert from the forms to the SQLiteDatabase
 $password = "";
 //Error variable to display massages
 $password_err ="";

 try
 {
   //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
 	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso;charset=utf8', 'enartsht_david', 'Wendy30');
 }
 catch (Exception $e)
 {
         die('Erreur : ' . $e->getMessage());
 }


 if(isset($_GET['id_pass']) && isset($_POST['reg_button'])){

   //password
   $id = $_GET['id_pass'];

   $password = strip_tags($_POST['reg_password']);
   $password = str_replace(' ', '', $password);

   //email
   $password2 = strip_tags($_POST['reg_password2']);
   $password2 = str_replace(' ', '', $password2);
   $error_array = array();


   if($password != $password2){
     array_push($error_array, "<span style='color: red'>Les mots de passe ne sont pas identiques<br></span>");
   }
   else{
     if(preg_match('/[^A-Za-z0-9]/', $password)){
       array_push($error_array, "<span style='color: red'>Le mot de passe peut contenir que des lettres et des nombres<br></span>");
     }
   }
   if(strlen($password) > 30 || strlen($password) < 5 ){
     array_push($error_array, "<span style='color: red'>le mot de passe doit contenir entre 5 à 30 charactères au moins<br></span>");
   }

   if(empty($error_array)){
     $password = md5($password);

 // Requete de modification des champs de la table muso
    $req = $bdd->prepare('UPDATE muso SET password = :password WHERE id = :id')  or die(print_r($bdd->errorInfo()));
    $req->execute(array(
   	'password' => $password,
     'id' => $id,
   	));

   	echo "Modification du password réussit!";

    $req->closeCursor();

     header("Location: login.php");
     exit();
   }

 }



 ?>


<!DOCTYPE html>
<html>

<head>
	<title>change pass</title>
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
				<div class="d-flex justify-content-center form_container">
					<form id="change_pass" action="" method="post">
            <p style="color: white">Entrez votre nouveau mot de passe</p>
            <div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="reg_password" class="form-control input_pass" value="" placeholder="password" required>
						</div>
            <div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="reg_password2" class="form-control input_pass" value="" placeholder="password" required>
						</div>

					 <div class="d-flex justify-content-center mt-3 login_container">
				 	       <button type="submit" name="reg_button" value="Login" class="btn login_btn">Changer</button>
				   </div>
           <?php if(in_array("<span style='color: red'>Les mots de passe ne sont pas identiques<br></span>", $error_array)) echo "<span style='color: red'>Les mots de passe ne sont pas identiques<br></span>";
           else if(in_array("<span style='color: red'>Le mot de passe peut contenir que des lettres et des nombres<br></span>", $error_array)) echo "<span style='color: red'>Le mot de passe peut contenir que des lettres et des nombres<br></span>";
           else if(in_array("<span style='color: red'>le mot de passe doit contenir entre 5 à 30 charactères au moins<br></span>", $error_array)) echo "<span style='color: red'>le mot de passe doit contenir entre 5 à 30 charactères au moins<br></span>";
           ?>   
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
