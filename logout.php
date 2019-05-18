<?php
session_start();
session_unset();
session_destroy();

setcookie('remember_id', '', time()-3600);

setcookie('remember_key', '', time()-3600);

echo "<script> alert('Anda sudah logout!');document.location.href='login.php';</script>";

?>