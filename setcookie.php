<?php

$conn=mysqli_connect("localhost", "root", "", "spk-wp-helm");

if(isset($_COOKIE['remember_id']) && isset($_COOKIE['remember_key']))
{
    $id=$_COOKIE['remember_id'];
    $key=$_COOKIE['remember_key'];

    //get username
    $cekCookieUser=mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
    $res=mysqli_fetch_assoc($cekCookieUser);

    $_SESSION['logged']=true;
    $_SESSION['nama']=$res['nama_user'];
    $_SESSION["username"]=$res['username'];
    
}

?>