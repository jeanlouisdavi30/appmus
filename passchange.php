<?php
require "config/config.php";
//require "includes/form_handlers/register_handler.php";
//require "includes/form_handlers/login_handler.php";


$error_array = array();
$email = "";
$id_email = "";

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['button_pass']) && isset($_POST['email_pass'])) {
  $email = strip_tags($_POST['email_pass']);

  //Check if the email is in valid format
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // check if email already exists
    $e_check = mysqli_query($con, "SELECT id FROM muso WHERE email='$email'");

    //count the number of rows returned

    $num_row = mysqli_num_rows($e_check);

    // envoie d'email à l'utilisateur
    if($num_row > 0 ){
      $row = mysqli_fetch_array($e_check);
      $id_email = $row['id'];
      $to = $_POST['email_pass'];
      $subject = "Changer le mot de passe de la Mutuelle";
      $message="<html><head>";
      $message .= "<title>HTML email</title>";
      $message .= "</head><body>";
      $message .= "<h3><img src=\"http://musomobil.org/logo-muso-mobil2.png/\" height=\"20px\"> MUSOMOBIL <br></h3>";
      $message .= "<h3>Changer le mot de passe de la Mutuelle en cliquant sur ce lien: <br></h3>";
      $message .= "<a href=\"https://musomobil.org/changepass.php?id_pass=$id_email\">Changer le mot de passe</a>";
      $message .= "</body></html>";
      $headers  = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
      $headers .= "From: info@musomobil.org" . "\r\n";
      $headers .= 'Bcc:jeanlouisdavi30@yahoo.fr';

    /*
    foreach( $_SESSION['cart'] as $key => $value )
    $message .= "$key: $value\n<br>";
    $message .= "$subtotal";
    */

      mail($to, $subject, $message, $headers);

    }
    else
    {
      array_push($error_array, "<span style='color: red'>Votre email n'est pas enregistre à musobil, verifiez l'email ou enregistrez votre mutuelle<br></span>" );
    }


  }

}

?>


<!DOCTYPE html>
<html>

<head>
	<title>pass change</title>
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
					<form id="passchange" action="" method="post">
            <p style="color: white">Entrez votre email pour changer votre mot de passe, un email vous sera envoyé.</p>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>

							<input type="email_pass"  name="email_pass" placeholder="Email" class="form-control input_user" required>
						</div>
            <?php if(in_array("<span style='color: red'>Votre email n'est pas enregistre à musobil, verifiez l'email ou enregistrez votre mutuelle<br></span>", $error_array )){
              echo "<span style='color: red'>Votre email n'est pas enregistre à musobil, verifiez l'email ou enregistrez votre mutuelle<br></span>";
            }?>
						<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button_pass" value="passchange" class="btn login_btn">Envoyer</button>
				   </div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
