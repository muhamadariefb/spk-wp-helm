<?php

session_start();

if(isset($_SESSION["logged"]))
{
	header("Location:index.php?page=dashboard");
	exit;
}

require "user/function.php";

if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];

	//cek apakah ada user yang diinput
	$cek=mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

	//cek dan harus identik
	if(mysqli_num_rows($cek)===1)
	{
		//cek password
		$cekResult=mysqli_fetch_assoc($cek);
		
			$_SESSION["logged"]=true;
			$_SESSION["nama"]=$cekResult['nama_user'];
			$_SESSION["username"]=$cekResult['username'];

			if(isset($_POST['ingat_saya']))
			{
				setcookie('remember_id', $cekResult['id_user'], time()+3600);

			}

			header("Location:index.php?page=dashboard");
		
			//berhentikan fungsi
			exit;
		

	}
	$error=true;
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
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login<br>Sistem Penunjang Keputusan<br>Pemilihan Helm Terbaik</div>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            Username
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username..." required="required">
          </div>
          <div class="form-group">
             Password
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password..." required="required">
          </div>
          <button class="btn btn-primary" type="submit" name="login">Login</button>
          <?php
          if (isset($error)):?>
          <p style="color:red;font-style:italic;">Incorrect Username / Password</p>
          <?php endif;?>
        </form>
        <hr>
        <div class="text-center">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerUser">
           Register User
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="registerUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <form action="user/register_act.php" method="post" enctype="multipart/form-data">
              <h3>Tambah User</h3>
              <div class="form-group">
                Nama User<input type="text" class="form-control" id="name" placeholder="Name" name="nama_user">
              </div>
              <div class="form-group">
                Username<input type="text" class="form-control" id="username" placeholder="Username" name="username">
              </div>
              <div class="form-group">
                Password<input type="password" class="form-control" id="password" placeholder="Password" name="password">
              </div>
              <div class="form-group">
                Konfirmasi Passowrd<input type="password" class="form-control" id="confirmationPassword" placeholder="Konfirmasi Password" name="konfirmasiPassword">
              </div>
              <button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
              <button class="btn btn-danger" type="reset">Reset</button>
          </form>
        </div>
          <!-- /.container-fluid -->
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>

