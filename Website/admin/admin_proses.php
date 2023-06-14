<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{
	$sqlcek = "SELECT * FROM admin WHERE username='".$_POST['username']."'";
	if (CekExist($mysqli,$sqlcek)== true){
		echo "<script>window.alert('Username ".$_POST['username']." sudah ada sebelumnya!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}else{

		$stmt = $mysqli->prepare("INSERT INTO admin 
			(id_admin,nama_admin,email,no_tlp,username,password) 
			VALUES (?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("ssssss",
			$_POST['kode'], 
			$_POST['nama'],
			$_POST['email'],
			$_POST['telp'],
			$_POST['username'], 
			$_POST['password']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Admin Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=admin';</script>";	
		} else {
			echo "<script>alert('Data Admin Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}
}else if(isset($_POST['ubah'])){

	$sqlcek = "SELECT * FROM admin WHERE username='".$_POST['username']."' AND id_admin <>'".$_POST['kode']."'";
	if (CekExist($mysqli,$sqlcek)== true){
		echo "<script>window.alert('Username ".$_POST['username']." sudah ada sebelumnya!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}else{

		$stmt = $mysqli->prepare("UPDATE admin  SET 
			nama_admin=?,
			email=?,
			no_tlp=?,
			username=?,
			password=?
			WHERE id_admin=?");
		$stmt->bind_param("ssssss",
			$_POST['nama'],
			$_POST['email'],
			$_POST['telp'],
			$_POST['username'], 
			$_POST['password'], 
			$_POST['kode']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Admin Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=admin';</script>";	
		} else {
			echo "<script>alert('Data Admin Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}
}else if(isset($_GET['hapus'])){
	$stmt = $mysqli->prepare("DELETE FROM admin WHERE id_admin=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Admin Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=admin';</script>";	
	} else {
		echo "<script>alert('Data Admin Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>