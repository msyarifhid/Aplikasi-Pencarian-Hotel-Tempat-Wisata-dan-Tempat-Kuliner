<?php
require_once 'crud.php';
require_once 'tanggal.php';
require_once 'fungsi.php';
//error_reporting(0);
//set koneksi ke basis data
$host = "localhost"; //Berjalan di local
$username = "id10232308_mshid";
$password = "mshid09";
$db_name = "id10232308_jogja_easytrip"; //Nama database

//koneksi ke basis data
$mysqli = new mysqli($host, $username, $password, $db_name);

//Cek koneksi basis data
if(mysqli_connect_errno()) {
	echo "Error: Tidak terhubung ke database";
	exit;
	}
?>