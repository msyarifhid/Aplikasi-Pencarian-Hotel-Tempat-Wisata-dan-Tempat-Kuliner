<?php
session_start();
require_once 'setting/koneksi.php';

	$user=$_POST['username'];
	$pass=$_POST['password']; 

	$sqladmin="SELECT * FROM admin WHERE username='$user' AND password='$pass'";
	
	if (CekExist($mysqli,$sqladmin)== true){
		
		$_SESSION['kln_adm']=caridata($mysqli,"SELECT id_admin FROM admin WHERE username='$user' and password='$pass'");
		echo "<script>alert('Anda login sebagai admin')</script>";
		echo "<script>window.location='admin/index.php?hal=beranda';</script>";

	}else{
		
		echo "<script>alert('Username atau password tidak terdaftar!')</script>";
		echo "<script>window.location='login.php';</script>";
	
	}

?>