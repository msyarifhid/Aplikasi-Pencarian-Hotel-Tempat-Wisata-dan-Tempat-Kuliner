<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{
	$sqlcek = "SELECT * FROM kabupaten WHERE nama_kab='".$_POST['nama']."'";
	if (CekExist($mysqli,$sqlcek)== true){
		echo "<script>window.alert('Kabupaten ".$_POST['nama_kab']." sudah ada sebelumnya!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}else{

		$stmt = $mysqli->prepare("INSERT INTO kabupaten 
			(id_kab,nama_kab) 
			VALUES (?, ?)");

		$stmt->bind_param("ss",
			$_POST['kode'], 
			$_POST['nama']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Kabupaten Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=kabupaten';</script>";	
		} else {
			echo "<script>alert('Data Kabupaten Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}
}else if(isset($_POST['ubah'])){

	$sqlcek = "SELECT * FROM kabupaten WHERE nama_kab='".$_POST['nama']."' AND id_kab <>'".$_POST['kode']."'";
	if (CekExist($mysqli,$sqlcek)== true){
		echo "<script>window.alert('Kabupaten ".$_POST['nama']." sudah ada sebelumnya!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}else{

		$stmt = $mysqli->prepare("UPDATE kabupaten  SET 
			nama_kab=?
			WHERE id_kab=?");
		$stmt->bind_param("ss",
			$_POST['nama'],
			$_POST['kode']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Kabupaten Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=kabupaten';</script>";	
		} else {
			echo "<script>alert('Data Kabupaten Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}
}else if(isset($_GET['hapus'])){
	$stmt = $mysqli->prepare("DELETE FROM kabupaten WHERE id_kab=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kabupaten Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=kabupaten';</script>";	
	} else {
		echo "<script>alert('Data Kabupaten Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>