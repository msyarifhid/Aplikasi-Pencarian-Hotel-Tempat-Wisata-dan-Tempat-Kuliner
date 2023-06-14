<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$s=1;
	$kode = $_POST['kode'];
	//upload
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GMK'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/mnkuliner"))
			{
				$tempat_gambar = "../uploaded/mnkuliner";
			}else{
				mkdir("../uploaded/mnkuliner");
				$tempat_gambar = "../uploaded/mnkuliner";
			}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$nama_file = "default.jpg";
		$s=2;
	}

	if ($s==2) {

		$stmt = $mysqli->prepare("INSERT INTO mk_kuliner 
			(id_mkkuliner,nama_mkkuliner,id_tpkuliner,gambar,harga) 
			VALUES (?, ?, ?, ?, ?)");

		$stmt->bind_param("sssss",
			$_POST['kode'], 
			$_POST['nama'],
			$_POST['tpkuliner'], 
			$nama_file, 
			$_POST['harga']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Menu Kuliner Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=mnkuliner';</script>";	
		} else {
			echo "<script>alert('Data Menu Kuliner Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_POST['ubah'])){
	$s=1;
	$kode = $_POST['kode'];
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GMK'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/mnkuliner"))
			{
				$tempat_gambar = "../uploaded/mnkuliner";
			}else{
				mkdir("../uploaded/mnkuliner");
				$tempat_gambar = "../uploaded/mnkuliner";
			}
			$ambil = caridata($mysqli,"SELECT gambar FROM mk_kuliner WHERE id_mkkuliner = '".$_POST['kode']."'");
			if(is_file("../uploaded/mnkuliner/".$ambil) && $ambil!='default.jpg')
				{
					unlink("../uploaded/mnkuliner/".$ambil);
					unlink("../uploaded/mnkuliner/small_".$ambil);
				}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$s=3;
	}

	if (($s==2) || ($s==3)) {

		$stmt = $mysqli->prepare("UPDATE mk_kuliner  SET 
			nama_mkkuliner=?,
			harga=?,
			id_tpkuliner=?
			WHERE id_mkkuliner=?");
		$stmt->bind_param("ssss",
			$_POST['nama'],
			$_POST['harga'], 
			$_POST['tpkuliner'], 
			$_POST['kode']);	

		if ($stmt->execute()) { 
			if($s==2)
			{
				$sql="UPDATE mk_kuliner SET gambar = '$nama_file' WHERE id_mkkuliner= '".$_POST['kode']."'";
				$mysqli->query($sql);
			}
			echo "<script>alert('Data Menu Kuliner Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=mnkuliner';</script>";	
		} else {
			echo "<script>alert('Data Menu Kuliner Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_GET['hapus'])){
	$ambil = caridata($mysqli,"SELECT gambar FROM mk_kuliner WHERE id_mkkuliner = '".$_GET['hapus']."'");
	$stmt = $mysqli->prepare("DELETE FROM mk_kuliner WHERE id_mkkuliner=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		//HAPUS FILE
		if(is_file("../uploaded/mnkuliner/".$ambil) && $ambil!='default.jpg')
		{
			unlink("../uploaded/mnkuliner/".$ambil);
			unlink("../uploaded/mnkuliner/small_".$ambil);
		}
		echo "<script>alert('Data Menu Kuliner Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=mnkuliner';</script>";	
	} else {
		echo "<script>alert('Data Menu Kuliner Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>