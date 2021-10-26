<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/Chicago");
session_start();

if(!isset($_SESSION['email']) AND !isset($_SESSION['username'])){
	header('Location: ../login.php');
	exit();
}

$auj = date("Y-m-d");
// variable to insert from the forms to the SQLiteDatabase
$muso = $email = $telephone = $representant = $nbr_membre = $date_creation = $adresse = $localite = $ville = $dep = $pays = $code_postal = $reseaux = $org = $cat_abcp = $bal_c_bleu = $bal_c_vert = $bal_c_rouge ="";
//Error variable to display massages
$muso_err = $email_err = $telephone_err = $representant_err = $nbr_membre_err = $date_creation_err = $adresse_err = $localite_err = $ville_err = $dep_err = $pays_err = $code_postal_err = $reseaux_err = $org_err = $cat_abcp_err = $bal_c_bleu_err = $bal_c_vert_err = $bal_c_rouge_err ="";

try
{
  //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso;charset=utf8', 'enartsht_david', 'Wendy30');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query("SELECT * FROM muso WHERE id='".$_SESSION['muso_id']."' ");
$donnees = $reponse->fetch();



if(isset($_POST['submit'])){

	// Validate name
	$input_muso = trim($_POST["muso"]);
	if(empty($input_muso)){
			$nom_err = "Veuillez entrer le muso";
	} else{
			$muso = $input_muso;
	}

	// Validate prenom
	$input_email = trim($_POST["email"]);
	if(empty($input_email)){
			$email_err = "Veuillez entrer l'email'";
	} else{
			$email = $input_email;
	}

	// Validate telephone
	$input_telephone = trim($_POST["telephone"]);
	if(empty($input_telephone)){
			$telephone_err = "Veuillez entrer le telephone";
	} else{
			$telephone = $input_telephone;
	}

	// Validate l'email
	$input_representant = trim($_POST["representant"]);
	if(empty($input_representant)){
			$representant_err = "Veuillez entrer le representant";
	} else{
			$representant = $input_representant;
	}

	// Validate date de naissance
	$input_date_creation = trim($_POST["date_creation"]);
	if(empty($input_date_creation)){
			$date_creation_err = "Veuillez entrer la date de creatione";
	} else{
			$date_creation = $input_date_creation;
	}

	// Validate adresse
	$input_adresse = trim($_POST["adresse"]);
	if(empty($input_adresse)){
			$adresse_err = "Veuillez entrer l'adresse";
	} else{
			$adresse = $input_adresse;
	}

	// Validate localite
	$input_localite = trim($_POST["localite"]);
	if(empty($input_localite)){
			$localite_err = "Veuillez entrer la localité";
	} else{
			$localite = $input_localite;
	}

	// Validate ville
	$input_ville = trim($_POST["ville"]);
	if(empty($input_ville)){
			$ville_err = "Veuillez entrer la commune ou ville";
	} else{
			$ville = $input_ville;
	}

	// Validate departement
	$input_dep = trim($_POST["dep"]);
	if(empty($input_dep)){
			$dep_err = "Veuillez entrer le département ou Etat ";
	} else{
			$dep = $input_dep;
	}

	// Validate pays
	$input_pays = trim($_POST["pays"]);
	if(empty($input_pays)){
			$pays_err = "Veuillez entrer le pays";
	} else{
			$pays = $input_pays;
	}

	// Validate pays
	$input_code_postal = trim($_POST["code_postal"]);
	if(empty($input_code_postal)){
			$code_postal_err = "Veuillez entrer le code postal";
	} else{
			$code_postal = $input_code_postal;
	}

	// Reseau affilié
	$input_reseaux = trim($_POST["reseaux"]);
	if(empty($input_reseaux)){
			$reseaux_err = "Veuillez entrer les reseaux affiliés";
	} else{
			$reseaux = $input_reseaux;
	}

	// Organisation affilié
	$input_org = trim($_POST["org"]);
	if(empty($input_org)){
			$org_err = "Veuillez entrer l'organisation affilié";
	} else{
			$org = $input_org;
	}

	// Organisation affilié
	$input_cat_abcp = trim($_POST["cat_abcp"]);
	if(empty($input_cat_abcp)){
			$cat_abcp_err = "Veuillez entrer la catégorie d'ABCP";
	} else{
			$cat_abcp = $input_cat_abcp;
	}

	// Validate caisse bleu
	$input_bal_c_bleu = trim($_POST["bal_c_bleu"]);
	if(empty($input_bal_c_bleu)){
			$bal_c_bleu_err = "Veuillez entrer la balance de la caisse bleu";
	} else{
			$bal_c_bleu = $input_bal_c_bleu;
	}

	// Validate caisse vert
	$input_bal_c_vert = trim($_POST["bal_c_vert"]);
	if(empty($input_bal_c_vert)){
			$bal_c_vert_err = "Veuillez entrer la balance de la caisse vert";
	} else{
			$bal_c_vert = $input_bal_c_vert;
	}


	// Validate caisse rouge
	$input_bal_c_rouge = trim($_POST["bal_c_rouge"]);
	if(empty($input_bal_c_rouge)){
			$bal_c_rouge_err = "Veuillez entrer la balance de la caisse rouge";
	} else{
			$bal_c_rouge = $input_bal_c_rouge;
	}



$req = $bdd->prepare('UPDATE muso SET muso = :muso, email = :email, telephone = :telephone, representant = :representant, date_creation = :date_creation, adresse = :adresse, localite = :localite, ville = :ville, dep = :dep, pays = :pays, code_postal = :code_postal, reseaux = :reseaux, org = :org, cat_abcp = :cat_abcp, bal_c_bleu = :bal_c_bleu, bal_c_vert = :bal_c_vert, bal_c_rouge = :bal_c_rouge WHERE id = :id')  or die(print_r($bdd->errorInfo()));
$req->execute(array(
	'muso' => $muso,
	'email' => $email,
	'telephone' => $telephone,
	'representant' => $representant,
	'date_creation' => $date_creation,
  'adresse' => $adresse,
	'localite' => $localite,
  'ville' => $ville,
	'dep' => $dep,
  'pays' => $pays,
  'code_postal' => $code_postal,
	'reseaux' => $reseaux,
	'org' => $org,
	'cat_abcp' => $cat_abcp,
  'bal_c_bleu' => $bal_c_bleu,
  'bal_c_vert' => $bal_c_vert,
  'bal_c_rouge' => $bal_c_rouge,
  'id' => $_SESSION['muso_id'],
	));

	echo "Modification des infos de la mutuelle réussit!";

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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modifier les infos de la mutuelle</h1>
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
            <h3 class="card-title">Infos de la mutuelle</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nom de la Mutuelle</label>
                <input type="text" class="form-control" name="muso" id="exampleInputEmail1" placeholder="Nom de la mutuelle" value="<?php echo $donnees['muso']; ?>">
								<span class="help-block"><?php echo $muso_err;?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="text" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" value="<?php echo $donnees['email']; ?>">
								<span class="help-block"><?php echo $email_err;?></span>
							</div>
              <div class="form-group">
                <label for="exampleInputEmail1">Téléphone</label>
                <input type="text" class="form-control" name="telephone" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $donnees['telephone']; ?>">
								<span class="help-block"><?php echo $telephone_err;?></span>
						 </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Représentant</label>
                <input type="text" class="form-control" name="representant" id="exampleInputEmail1" placeholder="Représentant de la mutuelle" value="<?php echo $donnees['representant']; ?>">
								<span class="help-block"><?php echo $representant_err;?></span>
						  </div>
							<div class="form-group">
                <label for="exampleInputEmail1">Date de création de la Mutuelle</label>
                <input type="date" class="form-control" name="date_creation" id="exampleInputEmail1" max="<?php echo $auj; ?>" placeholder="Date de création de la mutuelle" value="<?php echo $donnees['date_creation']; ?>">
								<span class="help-block"><?php echo $date_creation_err;?></span>
							</div>
              <div class="form-group">
                <label for="exampleInputEmail1">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="exampleInputEmail1" placeholder="Adresse" value="<?php echo $donnees['adresse']; ?>">
								<span class="help-block"><?php echo $adresse_err;?></span>
						  </div>

							<div class="form-group">
                <label for="exampleInputEmail1">Localité</label>
                <input type="text" class="form-control" name="localite" id="exampleInputEmail1" placeholder="localité" value="<?php echo $donnees['localite']; ?>">
								<span class="help-block"><?php echo $localite_err;?></span>
						  </div>

							<div class="form-group">
                <label for="exampleInputEmail1">section coummunale</label>
                <input type="text" class="form-control" name="code_postal" id="exampleInputEmail1" placeholder="code postal" value="<?php echo $donnees['code_postal']; ?>">
								<span class="help-block"><?php echo $code_postal_err;?></span>
					    </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Commune ou Ville</label>
                <input type="text" class="form-control" name="ville" id="exampleInputEmail1" placeholder="Ville" value="<?php echo $donnees['ville']; ?>">
								<span class="help-block"><?php echo $ville_err;?></span>
					    </div>
							<div class="form-group">
                <label for="exampleInputEmail1">Département ou Etat</label>
                <input type="text" class="form-control" name="dep" id="exampleInputEmail1" placeholder="dep" value="<?php echo $donnees['dep']; ?>">
								<span class="help-block"><?php echo $dep_err;?></span>
					    </div>
              <div class="form-group">
                <label for="exampleInputEmail1">pays</label>
                <input type="text" class="form-control" name="pays" id="exampleInputEmail1" placeholder="pays" value="<?php echo $donnees['pays']; ?>">
								<span class="help-block"><?php echo $pays_err;?></span>
							</div>

							<div class="form-group">
                <label for="exampleInputEmail1">Réseau(x) Affilié(s)</label>
                <input type="text" class="form-control" name="reseaux" id="exampleInputEmail1" placeholder="Réseaux Affiliés" value="<?php echo $donnees['reseaux']; ?>">
								<span class="help-block"><?php echo $reseau_err;?></span>
					    </div>
							<div class="form-group">
                <label for="exampleInputEmail1">Organisation(s) Affiliée(s)</label>
                <input type="text" class="form-control" name="org" id="exampleInputEmail1" placeholder="Organisations affiliées" value="<?php echo $donnees['org']; ?>">
								<span class="help-block"><?php echo $org_err;?></span>
					    </div>

							<div class="form-group">
								<label for="exampleInputEmail1">Catégorie ABCP</label>
							<select type="text" class="form-control" name="cat_abcp" id="exampleInputEmail1" value="<?php echo $donnees['cat_abcp']; ?>">
								<option value="">-- Choix - Catégorie ABCP --</option>
								<option value="MUSO">MUSO</option>
								<option value="AVEC">AVEC</option>
								<option value="BC">BC - Banque Communautaire</option>
								<option value="BV">BV - Banque Vilageoise</option>
								<option value="AMUSEC">AMUSEC</option>
								<option value="Autre">Autre</option>
							</select>
							<span class="help-block"><?php echo $cat_abcp_err;?></span>
							</div>


              <div class="form-group">
                <label for="exampleInputEmail1">Balance Caise Bleu</label>
                <input type="number" class="form-control" name="bal_c_bleu" id="exampleInputEmail1" placeholder="Balance caisse bleu" value="<?php echo $donnees['bal_c_bleu']; ?>">
								<span class="help-block"><?php echo $bal_c_bleu_err;?></span>
					    </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Balance caisse Verte</label>
                <input type="number" class="form-control" name="bal_c_vert" id="exampleInputEmail1" placeholder="Balance caisse verte" value="<?php echo $donnees['bal_c_vert']; ?>">
								<span class="help-block"><?php echo $bal_c_vert_err;?></span>
						  </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Balance caisse rouge</label>
                <input type="number" class="form-control" name="bal_c_rouge" id="exampleInputEmail1" placeholder="Balance caisse rouge" value="<?php echo $donnees['bal_c_rouge']; ?>">
								<span class="help-block"><?php echo $bal_c_rouge_err;?></span>
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
