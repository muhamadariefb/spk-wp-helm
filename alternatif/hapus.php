<?php

require 'function.php';

$id_alternatif	= $_GET['id_alternatif'];

if(hapus($id_alternatif)>0)
{
	echo "<script>alert('Berhasil!'); document.location.href='../index.php?page=alternatif'</script>\n";	
}
else 
{
	echo "<script>alert('Gagal!'); document.location.href='../index.php?page=alternatif'</script>\n";
}

?>