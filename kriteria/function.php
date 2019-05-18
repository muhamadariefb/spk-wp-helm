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


function ubah($data)
{
	global $conn;

	//mengambil elemen dari masing masing form
	$id_kriteria=htmlspecialchars($data["id_kriteria"]);
	$nama_kriteria=htmlspecialchars($data["nama_kriteria"]);
	$kepentingan=htmlspecialchars($data["kepentingan"]);
    $cost_benefit=htmlspecialchars($data["cost_benefit"]);

	

	$query_ubah = "UPDATE kriteria SET
					nama_kriteria='$nama_kriteria',
					kepentingan='$kepentingan',
					cost_benefit='$cost_benefit'

					WHERE id_kriteria='$id_kriteria'

					";

		mysqli_query($conn, $query_ubah);

	//menampilkan baris yang terpengaruh dari database yang kita pakai apapun itu action nya (CRUD)
	return mysqli_affected_rows($conn);
}


?>