<?php
    $host = "localhost"; //setting nama server/hostname
    $db ="perpustakaan_2022";
    $user="root";
    $password=""; 
    $con = mysqli_connect($host, $user, $password);
    mysqli_select_db($con,$db);
    //echo"Koneksi sukses";
    //check connection
    if(mysqli_connect_errno())
    {
        echo"Failed to connect to MySQL: ".mysqli_connect_errno();
    }
?>