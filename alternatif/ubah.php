<?php
session_start();

if(!isset($_SESSION["logged"]) && !isset($_COOKIE['remember_id']) && !isset($_COOKIE['remember_key']))
{
	header("Location:login.php");
	exit;
}
else if(isset($_COOKIE['remember_id']) && isset($_COOKIE['remember_key']))
{
	include "setcookie.php";
}

?>


<?php

require 'function.php';

//untuk mengambil ID dari keywoard yang dikirim melalui url
$getID=$_GET['id_alternatif'];

//untuk menampilkan data pada form sesuai ID
$getData=query("SELECT * FROM alternatif WHERE id_alternatif='$getID'");


if(isset($_POST["ubah"]))
{
	if(ubah($_POST)>0)
	{
		//echo "Berhasil!";
		echo "<script> alert('Data Berhasil Diubah!');document.location.href='../index.php?page=alternatif';</script>";
	}
	else
	{
		//echo "Gagal!";
		echo "<script> alert('Data Gagal Diubah!');document.location.href='../index.php?page=alternatif';</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Penunjang Keputusan</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php?page=dashboard">SPK WP</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-brand mr-5">
      <li>
        <?php echo $_SESSION['nama'];?>
         <a href="logout.php" onClick = "return confirm('Apakah Anda yakin ingin logout?')"> | Logout</a>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php?page=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.php?page=alternatif">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Alternatif</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.php?page=kriteria">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Kriteria</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.php?page=perhitungan">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Perhitungan</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Begin Page Content -->
        <form action="" method="post" enctype="multipart/form-data">
                <h3>Tambah Alternatif</h3>
                <div class="form-group">
                <input type="hidden" name="id_alternatif" value="<?= $getData[0]["id_alternatif"];?>">
                  Nama Alternatif
                  <input type="text" name="nama_alternatif" id="editNamaAlternatif" class="form-control" value="<?= $getData[0]["nama_alternatif"];?>">
                </div>
                <div class="form-group">
                  Harga
                   <select name="k1" class="form-control" id="k1">
                    <option selected="selected">Pilih Tingkat Kepentingan</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group">                
                  Merk
                  <select name="k2" class="form-control" id="k2">
                    <option selected="selected">Pilih Tingkat Kepentingan</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group">
                  Desain
                  <select name="k3" class="form-control" id="k3">
                    <option selected="selected">Pilih Tingkat Kepentingan</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group">
                  Material
                  <select name="k4" class="form-control" id="k4">
                    <option selected="selected">Pilih Tingkat Kepentingan</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group">
                  Harga Asesoris
                  <select name="k5" class="form-control" id="k5">
                    <option selected="selected">Pilih Tingkat Kepentingan</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <button class="btn btn-primary" type="submit" name="ubah">Ubah</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </form>
        <!-- /.container-fluid -->

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Muhamad Arief Budiman - 2015141665</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
