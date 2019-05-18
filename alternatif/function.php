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


function hapus($id)
{
	global $conn;

	$result=mysqli_query($conn, "SELECT * FROM alternatif WHERE id_alternatif='$id'");

	$row=mysqli_fetch_assoc($result);

	if(mysqli_num_rows($result)>0){

		mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif='$id'");	
	}

	return mysqli_affected_rows($conn);
}

function tambah($data)
{
	global $conn;

	$nama_alternatif=htmlspecialchars($data["nama_alternatif"]);
	$k1=htmlspecialchars($data["k1"]);
    $k2=htmlspecialchars($data["k2"]);
    $k3=htmlspecialchars($data["k3"]);
    $k4=htmlspecialchars($data["k4"]);
    $k5=htmlspecialchars($data["k5"]);

	$query = "INSERT INTO alternatif VALUES ('','$nama_alternatif','$k1','$k2','$k3','$k4','$k5')";

	mysqli_query($conn, $query);

	//echo $query;

	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;

	//mengambil elemen dari masing masing form
	$id_alternatif=htmlspecialchars($data["id_alternatif"]);
	$nama_alternatif=htmlspecialchars($data["nama_alternatif"]);
	$k1=htmlspecialchars($data["k1"]);
    $k2=htmlspecialchars($data["k2"]);
    $k3=htmlspecialchars($data["k3"]);
    $k4=htmlspecialchars($data["k4"]);
    $k5=htmlspecialchars($data["k5"]);
	

	$query_ubah = "UPDATE alternatif SET
					nama_alternatif='$nama_alternatif',
					k1='$k1',
					k2='$k2',
                    k3='$k3',
                    k4='$k4',
                    k5='$k5'

					WHERE id_alternatif='$id_alternatif'

					";

		mysqli_query($conn, $query_ubah);

	//menampilkan baris yang terpengaruh dari database yang kita pakai apapun itu action nya (CRUD)
	return mysqli_affected_rows($conn);
}

function search($keyword){
	$seacrhQuery = "SELECT * FROM alternatif 
					WHERE nama_alternatif LIKE '%$keyword%'
					
					";

	return query($seacrhQuery);

}

?>