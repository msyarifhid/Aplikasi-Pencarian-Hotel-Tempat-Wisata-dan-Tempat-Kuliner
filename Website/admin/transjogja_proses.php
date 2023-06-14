<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO transjogja 
		(id_transjogja,nama_transjogja,latitude,longitude,alamat) 
		VALUES (?, ?, ?, ?, ?)");

	$stmt->bind_param("sssss",
		$_POST['kode'], 
		$_POST['nama'],
		$_POST['lat'],
		$_POST['long'],
		$_POST['ala']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Trans Jogja Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=transjogja';</script>";	
	} else {
		echo "<script>alert('Data Trans Jogja Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

	$stmt = $mysqli->prepare("UPDATE transjogja set nama_transjogja = ?, latitude = ?, longitude = ?, alamat = ?
		WHERE id_transjogja=?");
	$stmt->bind_param("sssss",
		$_POST['nama'],
		$_POST['lat'],
		$_POST['long'],
		$_POST['ala'],
		$_POST['kode']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Trans Jogja Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=transjogja';</script>";	
	} else {
		echo "<script>alert('Data Trans Jogja Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){
	$stmt = $mysqli->prepare("DELETE FROM transjogja WHERE id_transjogja=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Trans Jogja Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=transjogja';</script>";	
	} else {
		echo "<script>alert('Data Transjogja Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>