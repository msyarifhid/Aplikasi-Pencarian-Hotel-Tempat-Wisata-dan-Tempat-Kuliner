<?php
require_once '../setting/koneksi.php';

if(isset($_POST['ubah'])){

	$sqlcek = "SELECT * FROM admin WHERE username='".$_POST['username']."' AND id_admin <>'".$_POST['kode']."'";
	if (CekExist($mysqli,$sqlcek)== true){
		echo "<script>window.alert('Username ".$_POST['username']." sudah ada sebelumnya!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}else{

		$stmt = $mysqli->prepare("UPDATE admin  SET 
			nama_admin=?,
			username=?,
			password=?
			WHERE id_admin=?");
		$stmt->bind_param("ssss",
			$_POST['nama'], 
			$_POST['username'], 
			$_POST['password'], 
			$_POST['kode']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Profil Admin Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=beranda';</script>";	
		} else {
			echo "<script>alert('Data Profil Admin Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}
?>