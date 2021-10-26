<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("EDT");
session_start();

if(!isset($_SESSION['email']) AND !isset($_SESSION['username'])){
	header('Location: ../login.php');
	exit();
}

$aujourdhui = date("Y-m-d");
//Augmenter de 10 An
$mate = strtotime($aujourdhui."- 10 years");
$date_min = date("Y-m-d", $mate);

// variable to insert from the forms to the SQLiteDatabase
$nom = $prenom = $sexe = $tranche_age = $telephone = $email = $date_naissance = $adresse = $valider = $actif = $fonction = $photo ="";
//Error variable to display massages
$nom_err = $prenom_err = $sexe_err = $tranche_age_err = $telephone_err = $email_err = $date_naissance_err = $adresse_err = $valider_err = $actif_err = $fonction_err = $photo_err = "";

try
{
  //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso;charset=utf8', 'enartsht_david', 'Wendy30');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

if(isset($_POST['submit'])){

  // Validate name
  $input_nom = trim($_POST["nom"]);
  if(empty($input_nom)){
      $nom_err = "Veuillez entrer le nom";
  } else{
      $nom = $input_nom;
  }

  // Validate prenom
  $input_prenom = trim($_POST["prenom"]);
  if(empty($input_prenom)){
      $prenom_err = "Veuillez entrer le prenom";
  } else{
      $prenom = $input_prenom;
  }

	// Validate sexe
	$input_sexe = trim($_POST["sexe"]);
	if(empty($input_sexe)){
			$sexe_err = "Veuillez entrer le sexe";
	} else{
			$sexe = $input_sexe;
	}

	// Validate de la tranche d'age
	$input_tranche_age = trim($_POST["tranche_age"]);
	if(empty($input_tranche_age)){
			$tranche_age_err = "Veuillez entrer une tranche d'age";
	} else{
			$tranche_age = $input_tranche_age;
	}

  // Validate telephone
  $input_telephone = trim($_POST["telephone"]);
  if(empty($input_telephone)){
      $telephone_err = "Veuillez entrer le telephone";
  } else{
      $telephone = $input_telephone;
  }

  // Validate l'email
  $input_email = trim($_POST["email"]);
  if(empty($input_email)){
      $email_err = "Veuillez entrer l'email";
  } else{
      $email = $input_email;
  }

	$input_date_naissance = $_POST["date_naissance"];
	$aujourdhui = date("Y-m-d");
	$diff = date_diff(date_create($input_date_naissance), date_create($aujourdhui));
	$age = $diff->format('%y');

  // Validate date de naissanc
  if(empty($input_date_naissance)){
      $date_naissance_err = "Veuillez entrer la date de naissance";
  }else if($age  < 10 ){
      $date_naissance_err = "Le membre doit avoir au moins 10 ans";
  }else{
			$date_naissance = $input_date_naissance;
	}

  // Validate adresse
  $input_adresse = trim($_POST["adresse"]);
  if(empty($input_adresse)){
      $adresse_err = "Veuillez entrer l'adresse";
  } else{
      $adresse = $input_adresse;
  }

  // Validate fonction
  $input_fonction = trim($_POST["fonction"]);
  if(empty($input_fonction)){
      $fonction_err = "Veuillez entrer la fonction du membre";
  } else{
      $fonction = $input_fonction;
  }


/*
id	id_muso	nom	prenom	telephone	email	date_naissance	adresse	valider	actif	fonction	photo
*/
// On ajoute une entrée dans la table jeux_video

$req = $bdd->prepare('INSERT INTO `membres`(`id_muso`, `nom`, `prenom`, `sexe`, `tranche_age`, `telephone`, `email`, `date_naissance`, `adresse`, `valider`, `actif`, `fonction`, `photo`) VALUES(:id_muso, :nom, :prenom, :sexe, :tranche_age, :telephone, :email, :date_naissance, :adresse, :valider, :actif, :fonction, :photo)');
$req->execute(array(
  'id_muso' => $_SESSION['muso_id'],
	'nom' => $nom,
  'prenom' => $prenom,
	'sexe' => $sexe,
	'tranche_age' => $tranche_age,
	'telephone' => $telephone,
  'email' => $email,
  'date_naissance' => $date_naissance,
	'adresse' => $adresse,
	'valider' => 'non',
  'actif'=> 'oui',
  'fonction' => $fonction,
  'photo' => 'img/photo_membre.png',
	));
  echo 'Le membre a bien été ajouté !';

	header("Location: index.php");
	exit();

}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MUSOMOBIL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

<!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/nav_top.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "includes/nav_left.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajouter un membre</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
  <div class="container-fluid">

        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Infos du membre</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nom</label>
                <input type="text" class="form-control" name="nom" id="exampleInputEmail1" placeholder="Nom" value="<?php echo $input_nom; ?>" required>
                <span class="help-block"><?php echo $nom_err;?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="exampleInputEmail1" placeholder="Prénom" value="<?php echo $input_prenom; ?>" required>
                <span class="help-block"><?php echo $nom_err;?></span>
              </div>

							<div class="form-group">
								<label for="exampleInputEmail1">Sexe</label>
							<select type="text" class="form-control" name="sexe" id="exampleInputEmail1" placeholder="Sexe" value="<?php echo $donnees['sexe']; ?>" required>
								 <option value="">-- choix - Sexe --</option>
								 <option value="F">F</option>
								 <option value="M">M</option>
							</select>
							<span class="help-block"><?php echo $sexe_err;?></span>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Tranche d'age</label>
							<select type="text" class="form-control" name="tranche_age" id="exampleInputEmail1" placeholder="Tranche d'age" value="<?php echo $donnees['tranche_age']; ?>" required>
								 <option value="jeune">35 ans ou moins</option>
								 <option value="adulte">Plus de 35 ans</option>
							</select>
							<span class="help-block"><?php echo $tranche_age_err;?></span>
							</div>

              <div class="form-group">
                <label for="exampleInputEmail1">Téléphone</label>
                <input type="text" class="form-control" name="telephone" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $input_telephone; ?>">
                <span class="help-block"><?php echo $nom_err;?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="text" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" value="<?php echo $input_email; ?>">
                <span class="help-block"><?php echo $nom_err;?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Date de naissance (le membre doit avoir 10 ans aux moins)</label>
                <input type="date" class="form-control" name="date_naissance" id="exampleInputEmail1" max="<?php echo $date_min; ?>" placeholder="Date de naissance" value="<?php echo $input_date_naissance; ?>" required>
                <span class="help-block"><?php echo $nom_err;?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Adresse - Localité</label>
                <input type="text" class="form-control" name="adresse" id="exampleInputEmail1" placeholder="Adresse: #, Rue, section, Commune, etc... " value="<?php echo $input_adresse; ?>">
                <span class="help-block"><?php echo $nom_err;?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Fonction</label>
                <input type="text" class="form-control" name="fonction" id="exampleInputEmail1" placeholder="Fonction" value="<?php echo $input_fonction; ?>">
                <span class="help-block"><?php echo $adresse_err;?></span>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->
    </section>
  <!-- /.content -->
  </div>
    <!-- Main content -->

		<!-- footer -->
		<?php include "includes/footer.php"; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>



<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>



</body>
</html>
