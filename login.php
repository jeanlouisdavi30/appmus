<?php
require "config/config.php";
require "includes/form_handlers/register_handler.php";
require "includes/form_handlers/login_handler.php";

 ?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Muso</title>
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
					<form id="login" action="login.php" method="post">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email"  name="log_email" placeholder="Email" value="<?php if(isset($_SESSION['log_email'])) echo $_SESSION['log_email']; ?>" class="form-control input_user" required>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="log_password" class="form-control input_pass" value="" placeholder="password" required>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label signin" for="customControlInline" style="color:#1386b6;">Se rappeler de moi</label>
							</div>
						</div>
            <?php if(in_array("<span style='color:red'>l'email ou le mot de passe n'est pas correct <br> Ou l'email n'est pas encore validé<br></span>", $error_array )){
              echo "<span style='color:red'>l'email ou le mot de passe n'est pas correct <br> Ou l'email n'est pas encore validé<br></span>";
            }?>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="log_button" value="Login" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<a href="register.php" id="signin" class="signin" >Enregistrer une nouvelle Muso <p/></a>
					</div
          <p>
					<div class="d-flex justify-content-center links">
						<a href="passchange.php"><p>Mot de passe oublié?</a>
					</div>
				</div>
				<div class="musomobil"><h5><center>MUSOMOBIL</center><h5></div>
			</div>
		</div>
		<div><center><img src="logo-muso.gif"></center></div>
	</div>

</body>
</html>
