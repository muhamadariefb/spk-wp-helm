<?php

require 'function.php';

if(isset($_POST["tambah"]))
{
	if(register($_POST)>0)
	{
		//echo "Berhasil!";
		echo "<script> alert('Data Berhasil Ditambahkan!');document.location.href='../login.php';</script>";
	}
	else
	{
		//echo "Gagal!";
		echo "<script> alert('Data Gagal Ditambahkan!');document.location.href='../login.php';</script>";
	}
}

?>