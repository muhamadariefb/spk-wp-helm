<?php

require 'configdb.php';

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
          <li class="breadcrumb-item active">Perhitungan</li>
        </ol>

        <!-- Begin Page Content -->
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-fw fa-chart-area"></i>
            Perhitungan</div>
          <div class="card-body">
          <center>
          <?php
					echo "<b>Matrix Alternatif - Kriteria</b></br>";

					$alt = get_alternatif();
					$alt_name = get_alt_name();
					end($alt_name); $arl2 = key($alt_name)+1; //new
					$kep = get_kepentingan();
					$cb = get_costbenefit();
					$k = jml_kriteria();
					$a = jml_alternatif();
					$tkep = 0;
					$tbkep = 0;

					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> matrix alternatif/kriteria <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th><th>K1</th><th>K2</th><th>K3</th><th>K4</th><th>K5</th></tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>A".($i+1)."</b></td>";
						for($j=0;$j<$k;$j++){
							echo "<td>".$alt[$i][$j]."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> bobot kepentingan <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					echo "<b>Perhitungan Bobot Kepentingan</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th><th>K1</th><th>K2</th><th>K3</th><th>K4</th><th>K5</th><th>Jumlah</th></tr></thead>";
						echo "<tr><td><b>Kepentingan</b></td>";
						for($i=0;$i<$k;$i++){
							$tkep = $tkep + $kep[$i];
							echo "<td>".$kep[$i]."</td>";
						}
						echo "<td>".$tkep."</td></tr>";
						echo "<tr><td><b>Bobot Kepentingan</b></td>";
						for($i=0;$i<$k;$i++){
							$bkep[$i] = ($kep[$i]/$tkep);
							$tbkep = $tbkep + $bkep[$i];
							echo "<td>".round($bkep[$i],6)."</td>";
						}
						echo "<td>".$tbkep."</td></tr>";
					echo "</table><hr>";
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> pangkat <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					echo "<b>Perhitungan Pangkat</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th><th>K1</th><th>K2</th><th>K3</th><th>K4</th><th>K5</th></tr></thead>";
						echo "<tr><td><b>Cost/Benefit</b></td>";
						for($i=0;$i<$k;$i++){
							echo "<td>".ucwords($cb[$i])."</td>";
						}
						echo "</tr>";
						echo "<tr><td><b>Pangkat</b></td>";
						for($i=0;$i<$k;$i++){
							if($cb[$i]=="cost"){
								$pangkat[$i] = (-1) * $bkep[$i];
								echo "<td>".round($pangkat[$i],6)."</td>";
							}
							else{
								$pangkat[$i] = $bkep[$i];
								echo "<td>".round($pangkat[$i],6)."</td>";
							}
						}
						echo "</tr>";
					echo "</table><hr>";
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> vektor S <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					echo "<b>Perhitungan Nilai S</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th><th>S</th></tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>A".($i+1)."</b></td>";
						for($j=0;$j<$k;$j++){
							$s[$i][$j] = pow(($alt[$i][$j]),$pangkat[$j]);
						}
						$ss[$i] = $s[$i][0]*$s[$i][1]*$s[$i][2]*$s[$i][3]*$s[$i][4];
						echo "<td>".round($ss[$i],6)."</td></tr>";
					}
					echo "</table><hr>";
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> vektor S <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					echo "<b>Hasil Akhir</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th><th>V</th></tr></thead>";
					$total = 0;
					for($i=0;$i<$a;$i++){
						$total = $total + $ss[$i];
					}
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".$alt_name[$i]."</b></td>";
						$v[$i] = round($ss[$i]/$total,6);
						echo "<td>".$v[$i]."</td></tr>";
					}
                    echo "</table><hr>";
                    echo "<b>Kesimpulan<b>";
					// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> vektor S <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
					uasort($v,'cmp');
								for($i=0;$i<$arl2;$i++){ //new for 8 lines below
									if($i==0)
										echo "<div class='alert alert-dismissible alert-info'><b><i>Dari tabel tersebut dapat disimpulkan bahwa ".$alt_name[array_search((end($v)), $v)]." mempunyai hasil paling tinggi, yaitu ".current($v);
									elseif($i==($arl2-1))
										echo "</br>Dan terakhir ".$alt_name[array_search((prev($v)), $v)]." dengan nilai ".current($v).".</i></b></div>";
									else
										echo "</br>Lalu diikuti dengan ".$alt_name[array_search((prev($v)), $v)]." dengan nilai ".current($v);
								}

										function jml_kriteria(){
											include 'configdb.php';
											$kriteria = $mysqli->query("SELECT * FROM kriteria");
											return $kriteria->num_rows;
										}

										function jml_alternatif(){
											include 'configdb.php';
											$alternatif = $mysqli->query("SELECT * FROM alternatif");
											return $alternatif->num_rows;
										}

										function get_kepentingan(){
											include 'configdb.php';
											$kepentingan = $mysqli->query("SELECT * FROM kriteria");
											if(!$kepentingan){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kepentingan->fetch_assoc()) {
												@$kep[$i] = $row["kepentingan"];
												$i++;
											}
											return $kep;
										}

										function get_costbenefit(){
											include 'configdb.php';
											$costbenefit = $mysqli->query("SELECT * FROM kriteria");
											if(!$costbenefit){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $costbenefit->fetch_assoc()) {
												@$cb[$i] = $row["cost_benefit"];
												$i++;
											}
											return $cb;
										}

										function get_alt_name(){
											include 'configdb.php';
											$alternatif = $mysqli->query("SELECT * FROM alternatif");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i] = $row["nama_alternatif"];
												$i++;
											}
											return $alt;
										}

										function get_alternatif(){
											include 'configdb.php';
											$alternatif = $mysqli->query("SELECT * FROM alternatif");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i][0] = $row["k1"];
												@$alt[$i][1] = $row["k2"];
												@$alt[$i][2] = $row["k3"];
												@$alt[$i][3] = $row["k4"];
												@$alt[$i][4] = $row["k5"];
												$i++;
											}
											return $alt;
										}

										function cmp($a, $b){
											if ($a == $b) {
												return 0;
											}
											return ($a < $b) ? -1 : 1;
										}

										function print_ar(array $x){	//just for print array
											echo "<pre>";
											print_r($x);
											echo "</pre></br>";
										}
				?>
                </center>

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
