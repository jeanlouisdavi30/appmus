<?php

/*
Les champs de la base de données muso
    id
    muso
    email
    telephone
    representant
    password
    valider
    date_creation
    date_enregistrement

*/

?>

<?php
$muso = "";
$email = "";
$telephone = "";
$representant ="";
$adresse ="";
$section = "";
$commune = "";
$departement = "";
$pays = "";
$password = "";
$password2 = "";
$date_creation = "";
$date_enregistrement = "";
$error_array = array();

if(isset($_POST['reg_button'])){

  //nom de la mutuelle
  $muso = strip_tags($_POST['reg_muso']);
  $muso = ucfirst(strtolower(($muso)));
  $_SESSION['reg_muso'] = $muso; //

  //email du mutuelle
  $email = strip_tags($_POST['reg_email']);
  $_SESSION['reg_email'] = $email; //

  // Telephone du mutuelle
  $telephone = strip_tags($_POST['reg_telephone']);
  $telephone = str_replace(' ', '', $telephone);
  $_SESSION['reg_telephone'] = $telephone; //

  //Representant du mutuelle
  $representant = strip_tags($_POST['reg_representant']);
  $representant = ucfirst(strtolower(($representant)));
  $_SESSION['reg_representant'] = $representant; //

  //Adresse de la mutuelle
  $adresse = strip_tags($_POST['reg_adresse']);
  $adresse = ucfirst(strtolower(($adresse)));
  $_SESSION['reg_adresse'] = $adresse; //

  //Representant du mutuelle
  $section = strip_tags($_POST['reg_section']);
  $section = ucfirst(strtolower(($section)));
  $_SESSION['reg_section'] = $section; //

  //Representant du mutuelle
  $commune = strip_tags($_POST['reg_commune']);
  $commune = ucfirst(strtolower(($commune)));
  $_SESSION['reg_commune'] = $commune; //

  //Representant du mutuelle
  $departement = strip_tags($_POST['reg_dep']);
  $departement = ucfirst(strtolower(($departement)));
  $_SESSION['reg_dep'] = $departement; //

  //Representant du mutuelle
  $pays = strip_tags($_POST['reg_pays']);
  $pays = ucfirst(strtolower(($pays)));
  $_SESSION['reg_pays'] = $pays; //

  //password
  $password = strip_tags($_POST['reg_password']);
  $password = str_replace(' ', '', $password);

  //email
  $password2 = strip_tags($_POST['reg_password2']);
  $password2 = str_replace(' ', '', $password2);

  $date_creation = date("Y-m-d");

    //Check if the email is in valid format
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      // check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM muso WHERE email='$email'");

      //count the number of rows returned

      $num_row = mysqli_num_rows($e_check);

      if($num_row > 0 ){
        array_push($error_array, "<span style='color: red'>Ce email est déja enregistré<br></span>" );
      }


    }else{
      array_push($error_array, "<span style='color: red'>Le format d'email n'est pas valid<br></span>" );
    }


  if (strlen($muso) > 25 || strlen($muso) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom du muso doit contenir entre 2 and 25 charactères au moins <br></span>");
  }

  if (strlen($telephone) > 15 || strlen($telephone) < 8 ) {
    array_push($error_array, "<span style='color: red'>Votre numéro de téléphone n'est pas valid<br></span>");
  }


  if (strlen($representant) > 50 || strlen($representant) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom du representant doit contenir entre 2 and 50 character au moins<br></span>");
  }

  if (strlen($adresse) > 100 || strlen($adresse) < 2 ) {
    array_push($error_array, "<span style='color: red'>l'adresse doit contenir entre 2 and 100 character au moins<br></span>");
  }

  if (strlen($section) > 100 || strlen($section) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom de la section doit contenir entre 2 à 100 character au moins<br></span>");
  }

  if (strlen($commune) > 25 || strlen($commune) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom de la commune doit contenir entre 2 and 25 character au moins<br></span>");
  }

  if (strlen($departement) > 25 || strlen($departement) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom du département doit contenir entre 2 and 25 character au moins<br></span>");
  }

  if (strlen($pays) > 25 || strlen($pays) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom du pays doit contenir entre 2 and 25 character au moins<br></span>");
  }


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
    $password = md5($password); //Encript the password before insert it into the SQLiteDatabase

    //generate username by caractere first name and lastname
    /*
    $username = strtolower($fname . "_" . $lname);
    $check_user_name_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

    $i = 0; */

    //if email exists add number to $username
    /*
    while(mysqli_num_rows($check_user_name_query) != 0){
      $i++; // ad 1 to i
      $username = $username . "_" . $i;
      $check_user_name_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    } */

    //profile pic
    /*
    $rand = rand(1, 2);

    if($rand == 1){
      $profile_pic = "assets/images/profil_pics/default/head_alizarin.png";
    }else {
      $profile_pic = "assets/images/profil_pics/default/head_belize_hole.png";
    } */

   $query = mysqli_query($con, "INSERT INTO `muso` VALUES (NULL, '$muso', '$email', '$telephone', '$representant', '$password', 'non', '$date_creation', '$date_creation', '$adresse', NULL, '$commune', '$departement', '$pays', '$section', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");

   $last_id = mysqli_insert_id($con);

   $to = $email;
   $subject = "Musomobil, validation de compte";
   $message="<html><head>";
   $message .= "<title>Validation de votre compte musomobil</title>";
   $message .= "</head><body>";
   $message .= "<h3><img src=\"http://musomobil.org/logo-muso-mobil2.png/\" height=\"20px\"> MUSOMOBIL <br></h3>";
   $message .= "<h3>Valider votre compte musomobil en cliquant sur ce lien: <br></h3>";
   $message .= "<a href=\"https://musomobil.org/valider_email.php?id_valid=$last_id\">Valider votre compte musomobil</a>";
   $message .= "</body></html>";
   $headers  = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
   $headers .= "From: info@musomobil.org" . "\r\n";
   $headers .= 'Bcc:jeanlouisdavi30@yahoo.fr';

   mail($to, $subject, $message, $headers);


   if (mysqli_query($con, $query)) {
    echo "La mutuelle est enregistré avec succès";
// envoie de l'email de confirmation a l'email ocinewdescrit
      $last_id = mysqli_insert_id($con);

      $to = $email;
      $subject = "Musomobil, validation de compte";
      $message="<html><head>";
      $message .= "<title>Validation de votre compte musomobil</title>";
      $message .= "</head><body>";
      $message .= "<h3><img src=\"http://musomobil.org/logo-muso-mobil2.png/\" height=\"20px\"> MUSOMOBIL <br></h3>";
      $message .= "<h3>Valider votre compte musomobil en cliquant sur ce lien: <br></h3>";
      $message .= "<a href=\"https://musomobil.org/valider_email.php?id_valid=$last_id\">Valider votre compte musomobil</a>";
      $message .= "</body></html>";
      $headers  = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
      $headers .= "From: info@musomobil.org" . "\r\n";
      $headers .= 'Bcc:jeanlouisdavi30@yahoo.fr';

      mail($to, $subject, $message, $headers);


    }else {
    echo "Error: " . $query . "<br>" . $con->error;

  }

  mysqli_close($con);

  array_push($error_array, "<span style='color: #14c800'>You're all set ! Go ahead and login </span>" );
  $_SESSION['reg_muso'] = "";
  $_SESSION['reg_email'] = "";
  $_SESSION['reg_telephone'] = "";
  $_SESSION['reg_representant'] = "";

  header("Location: confirm_registration.php");
  exit();

  }

}




 ?>
