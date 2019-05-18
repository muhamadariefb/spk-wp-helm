<?php 

$conn=mysqli_connect("localhost","root","","spk-wp-helm");

function query($query)
{
	global $conn;

	$result = mysqli_query($conn, $query);

	$rows=[];

	while($row = mysqli_fetch_assoc($result))
	{
		$rows[]=$row;
	}

	return $rows;
}


function hapus($id_user)
{
	global $conn;

	$result=mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");

	$row=mysqli_fetch_assoc($result);

	if(mysqli_num_rows($result)>0){

		mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");	
	}

	return mysqli_affected_rows($conn);
}

function register ($data)
{
	global $conn;

	$nama=htmlspecialchars($data['nama_user']);
	$username=strtolower(stripslashes($data['username']));
	$password=mysqli_real_escape_string($conn, $data['password']);
	$konfirmasiPassword=mysqli_real_escape_string($conn, $data['konfirmasiPassword']);

	//cek username sudah ada tau belum
	$cek=mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");

	if(mysqli_fetch_assoc($cek))
	{
		echo"<script>alert('Username sudah ada');alert</script>";
		return false;
	}

	//cek konfirmasi password
	if($password !== $konfirmasiPassword)
	{
		echo"<script>alert('Password tidak sama');alert</script>";
		return false;
	}

	//simpan
	mysqli_query($conn, "INSERT INTO user VALUES ('','$nama','$username','$password')");


	return mysqli_affected_rows($conn);
}


function ubah($data)
{
	global $conn;

	//mengambil elemen dari masing masing form
	$id_user=$data['id_user'];
	$nama_user=htmlspecialchars($data["nama_user"]);
	$username=htmlspecialchars($data["username"]);

	$query_ubah = "UPDATE user SET
					nama_user='$nama_user',
					username='$username',
					password=''

					WHERE id_user='$id_user'

					";

		mysqli_query($conn, $query_ubah);

	//menampilkan baris yang terpengaruh dari database yang kita pakai apapun itu action nya (CRUD)
	return mysqli_affected_rows($conn);
}


function ubahpassword ($data)
{
	global $conn;

	$username=strtolower(stripslashes($data['username']));
	$password_lama=mysqli_real_escape_string($conn, $data['password_lama']);
	$password_baru=mysqli_real_escape_string($conn, $data['password_baru']);
	$konfirmasiPassword=mysqli_real_escape_string($conn, $data['konfirmasiPassword']);

	//cek username sudah ada atau belum
	$cek=mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

	$cekPsw=mysqli_fetch_assoc($cek);

	if(!password_verify($password_lama, $cekPsw['password']))
	{
		echo "<script>alert('Password Lama Tidak Sesuai');</script>";
		return false;
	}

	//cek konfirmasi password
	if($password_baru !== $konfirmasiPassword)
	{
		echo"<script>alert('Password baru tidak sama');alert</script>";
		return false;
	}

	$query_ubah="UPDATE user SET password = '$password' WHERE username = '$username'";

	$returnVar=mysqli_query($conn, $query_ubah);

	return $returnVar;
}

?>
