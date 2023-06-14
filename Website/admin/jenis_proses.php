<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO jenis_km 
		(id_jeniskm,nama_jeniskm) 
		VALUES (?, ?)");

	$stmt->bind_param("ss",
		$_POST['kode'], 
		$_POST['nama']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Jenis Kamar Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=jenis';</script>";	
	} else {
		echo "<script>alert('Data Jenis Kamar Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

	$stmt = $mysqli->prepare("UPDATE jenis_km  SET 
		nama_jeniskm=?
		WHERE id_jeniskm=?");
	$stmt->bind_param("ss",
		$_POST['nama'],
		$_POST['kode']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Jenis Kamar Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=jenis';</script>";	
	} else {
		echo "<script>alert('Data Jenis Kamar Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){
	$stmt = $mysqli->prepare("DELETE FROM jenis_km WHERE id_jeniskm=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Jenis Kamar Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=jenis';</script>";	
	} else {
		echo "<script>alert('Data Jenis Kamar Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>