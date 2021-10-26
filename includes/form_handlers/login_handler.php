<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/Chicago");
session_start();

if(isset($_POST['log_button'])){
  $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

  $_SESSION['log_email'] = $email;

  $password = md5($_POST['log_password']);

  $check_database_query = mysqli_query($con, "SELECT * FROM muso WHERE email = '$email' AND password = '$password' AND valider ='yes'");

  $check_login_query = mysqli_num_rows($check_database_query);

  if($check_login_query == 1){
    $row = mysqli_fetch_array($check_database_query);
    $id_muso = $row['id'];
    $username = $row['muso'];
    $email = $row['email'];
    $telephone = $row['telephone'];
    $representant = $row['representant'];
    $nbr_membre = $row['nbr_membre'];
    $date_creation = $row['date_creation'];
    $adresse = $row['adresse'];
    $ville = $row['ville'];
    $pays = $row['pays'];
    $code_postal = $row['code_postal'];
    $bal_c_bleu = $row['bal_c_bleu'];
    $bal_c_vert = $row['bal_c_vert'];
    $bal_c_rouge = $row['bal_c_rouge'];

  $user_closed_query = mysqli_query($con, "SELECT * FROM muso WHERE email = '$email' AND valider='no'");

   if(mysqli_num_rows($user_closed_query) == 1){
    $reopen_account = mysqli_query($con, "UPDATE muso SET valider='yes' WHERE email='$email'");
   }

  $_SESSION['muso_id'] = $id_muso;
	$_SESSION['username'] = $username;
	$_SESSION['email'] = $email;
	$_SESSION['telephone'] = $telephone;
  $_SESSION['representant'] = $representant;
  $_SESSION['nbr_membre'] = $nbr_membre;
  $_SESSION['date_creation'] = $date_creation;
  $_SESSION['adresse'] = $adresse;
  $_SESSION['ville'] = $ville;
  $_SESSION['pays'] = $pays;
  $_SESSION['code_postal'] = $code_postal;
  $_SESSION['bal_c_bleu'] = $bal_c_bleu;
  $_SESSION['bal_c_vert'] = $bal_c_vert;
  $_SESSION['bal_c_rouge'] = $bal_c_rouge;

	$_SESSION['log'] = "<a href=\"logout.php\">Deconnexion</a>";
	header('Location: ad/index.php');
	exit();

  }else{
    array_push($error_array, "<span style='color:red'>l'email ou le mot de passe n'est pas correct <br> Ou l'email n'est pas encore validé<br></span>");
 }


}

?>
