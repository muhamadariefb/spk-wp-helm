<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
   
  switch ($page) {

  case 'dashboard':
  include "dashboard.php";
  break;


  //alternatif
  case 'alternatif':
  include "alternatif/index.php";
  break;
  case 'addAlternatif':
  include "alternatif/tambah.php";
  break;
  case 'editAlternatif':
  include "alternatif/ubah.php";
  break;


  //kriteria
  case 'kriteria':
  include "kriteria/index.php";
  break;
  case 'editKriteria':
  include "kriteria/ubah.php";
  break;

  //kriteria
  case 'perhitungan':
  include "perhitungan/index.php";
  break;


  //about
  case 'about':
  include "about.php";
  break;


  default:
  echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
  break;
  }
}
 
?>