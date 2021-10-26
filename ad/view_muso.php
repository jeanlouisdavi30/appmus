<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/Chicago");
session_start();

if(!isset($_SESSION['email']) AND !isset($_SESSION['username'])){
	header('Location: ../login.php');
	exit();
}

try
{
  //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso;charset=utf8', 'enartsht_david', 'Wendy30');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query("SELECT * FROM muso WHERE id='".$_SESSION['muso_id']."' ");

$req_m = $bdd->query("SELECT COUNT(id) as count_membres FROM membres where id_muso='".$_SESSION['muso_id']."' ");
$donnees_m = $req_m->fetch();
// On affiche chaque entrée une à une

$req_h = $bdd->query("SELECT COUNT(id) as count_membres FROM membres where id_muso='".$_SESSION['muso_id']."' AND sexe='M' ");
$donnees_h = $req_h->fetch();

$req_f = $bdd->query("SELECT COUNT(id) as count_membres FROM membres where id_muso='".$_SESSION['muso_id']."' AND sexe='F' ");
$donnees_f = $req_f->fetch();

$req_jeune = $bdd->query("SELECT COUNT(id) as count_jeunes FROM membres where id_muso='".$_SESSION['muso_id']."' AND tranche_age='jeune' ");
$donnees_jeune = $req_jeune->fetch();

$req_adulte = $bdd->query("SELECT COUNT(id) as count_adultes FROM membres where id_muso='".$_SESSION['muso_id']."' AND tranche_age='adulte' ");
$donnees_adulte = $req_adulte->fetch();

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
          <h1 class="m-0 text-dark"><?php echo $_SESSION['username'];?></h1>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $_SESSION['bal_c_bleu']?> Gdes</h3>

              <p><h4>CAISSE BLEU</h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $_SESSION['bal_c_vert']?> Gdes<sup style="font-size: 20px"></sup></h3>

              <p><h4>CAISSE VERTE</h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">

          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $_SESSION['bal_c_rouge']?> Gdes</h3>

              <p><h4>CAISSE ROUGE </h4></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>

</section>



<section>

	<!-- /.content-header -->
	<!-- About Me Box -->
	<div class="card-body box-profile">

		<?php
		$donnees = $reponse->fetch();

		?>

		<ul class="list-group list-group-unbordered mb-3">
			<li class="list-group-item">
				<b>Catégorie ABCP</b> <a class="float-right"><td><?php echo $donnees['cat_abcp']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Email</b> <a class="float-right"><td><?php echo $donnees['email']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Téléphone</b> <a class="float-right"><td><?php echo $donnees['telephone']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Représentant</b> <a class="float-right"><td><?php echo $donnees['representant']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Date de Création </b> <a class="float-right"><td><?php echo $donnees['date_creation']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Adresse</b> <a class="float-right"><td><?php echo $donnees['adresse']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Localité</b> <a class="float-right"><td><?php echo $donnees['localite']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Section Communale</b> <a class="float-right"><td><?php echo $donnees['code_postal']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>commune</b> <a class="float-right"><td><?php echo $donnees['ville']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Département</b> <a class="float-right"><td><?php echo $donnees['dep']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Pays</b> <a class="float-right"><td><?php echo $donnees['pays']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Réseaux Affiliés</b> <a class="float-right"><td><?php echo $donnees['reseaux']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Organisations affiliées</b> <a class="float-right"><td><?php echo $donnees['org']; ?></td></a>
			</li>
			<li class="list-group-item">
				<b>Nombre de membre</b> <a class="float-right"><td><?php echo $donnees_m['count_membres']; ?></a>
			</li>
			<li class="list-group-item">
				<b>Nombre de Femmes</b> <a class="float-right"><td><?php echo $donnees_f['count_membres']; ?></a>
			</li>
			<li class="list-group-item">
				<b>Nombre d'Hommes</b> <a class="float-right"><td><?php echo $donnees_h['count_membres']; ?></a>
			</li>
			<li class="list-group-item">
				<b>Nombre de jeunes</b> <a class="float-right"><td><?php echo $donnees_jeune['count_jeunes']; ?></a>
			</li>
			<li class="list-group-item">
				<b>Nombre d'adultes</b> <a class="float-right"><td><?php echo $donnees_adulte['count_adultes']; ?></a>
			</li>
	</ul>
	<a href="modifier_mutuelle.php" class="btn btn-primary btn-block"><b>Modifier Mutuelle</b></a>
	</div>

</section>

</div>

<?php
$reponse->closeCursor(); // Termine le traitement de la requête
?>

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
