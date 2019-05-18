<?php

require 'function.php';

$alts = query("SELECT * FROM alternatif");

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

  <div id="wrapper">

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php?page=dashboard">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Alternatif</li>
        </ol>

        <!-- Begin Page Content -->
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Alternatif</div>
          <div class="card-body">
            <div class="table-responsive">
            <div>
                <a href="index.php?page=addAlternatif">
                <button class="btn btn-primary" type="button">
                  Tambah Alternatif
                </button>
                </a>
            </div><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama Alternatif</th>
                    <th>Harga</th>
                    <th>Merk</th>
                    <th>Desain</th>
                    <th>Material</th>
                    <th>Harga Asesoris</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <?php
                foreach ($alts as $alt):
                ?>
            
                <tbody>
                  <tr>
                    <td><?php echo $alt['nama_alternatif'] ?></td>
                    <td><?php echo $alt['k1'] ?></td>
                    <td><?php echo $alt['k2'] ?></td>
                    <td><?php echo $alt['k3'] ?></td>
                    <td><?php echo $alt['k4'] ?></td>
                    <td><?php echo $alt['k5'] ?></td>
                    <td><a href="alternatif/ubah.php?id_alternatif=<?php echo $alt['id_alternatif']; ?>"><button class="btn btn-success btn-sm" type="button">Ubah</button></a>
                        <a href="alternatif/hapus.php?id_alternatif=<?php echo $alt['id_alternatif']; ?>" onClick = "return confirm('Apakah Anda ingin menghapus <?php echo $alt['nama_alternatif']; ?>?')"><button class="btn btn-danger btn-sm" type="button">Hapus</button></a>
                    </td>				                 
                  </tr>
                </tbody>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- /.container-fluid -->

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
