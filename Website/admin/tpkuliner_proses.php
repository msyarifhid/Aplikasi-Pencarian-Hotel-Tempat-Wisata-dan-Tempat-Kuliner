<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$s=1;
	$kode = $_POST['kode'];
	//upload
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GTK'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/tpkuliner"))
			{
				$tempat_gambar = "../uploaded/tpkuliner";
			}else{
				mkdir("../uploaded/tpkuliner");
				$tempat_gambar = "../uploaded/tpkuliner";
			}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$nama_file = "default.jpg";
		$s=2;
	}

	if ($s==2) {

		$stmt = $mysqli->prepare("INSERT INTO tempat_kuliner 
			(id_tpkuliner,nama_tpkuliner,latitude,longitude,deskripsi,alamat,id_kab,jam_buka,jam_tutup,gambar) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("ssssssssss",
			$_POST['kode'], 
			$_POST['nama'],
			$_POST['lat'], 
			$_POST['long'], 
			$_POST['des'],
			$_POST['alamat'], 
			$_POST['kab'], 
			$_POST['jb'], 
			$_POST['jt'], 
			$nama_file);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Tempat Kuliner Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=tpkuliner';</script>";	
		} else {
			echo "<script>alert('Data Tempat Kuliner Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_POST['ubah'])){
	$s=1;
	$kode = $_POST['kode'];
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GTK'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/tpkuliner"))
			{
				$tempat_gambar = "../uploaded/tpkuliner";
			}else{
				mkdir("../uploaded/tpkuliner");
				$tempat_gambar = "../uploaded/tpkuliner";
			}
			$ambil = caridata($mysqli,"SELECT gambar FROM tempat_kuliner WHERE id_tpkuliner = '".$_POST['kode']."'");
			if(is_file("../uploaded/tpkuliner/".$ambil) && $ambil!='default.jpg')
				{
					unlink("../uploaded/tpkuliner/".$ambil);
					unlink("../uploaded/tpkuliner/small_".$ambil);
				}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$s=3;
	}

	if (($s==2) || ($s==3)) {

		$stmt = $mysqli->prepare("UPDATE tempat_kuliner  SET 
			nama_tpkuliner=?,
			latitude=?,
			longitude=?,
			deskripsi=?,
			alamat=?,
			id_kab=?,
			jam_buka=?,
			jam_tutup=?
			WHERE id_tpkuliner=?");
		$stmt->bind_param("sssssssss",
			$_POST['nama'],
			$_POST['lat'], 
			$_POST['long'], 
			$_POST['des'], 
			$_POST['ala'],
			$_POST['kab'], 
			$_POST['jb'],
			$_POST['jt'],
			$_POST['kode']);	

		if ($stmt->execute()) { 
			if($s==2)
			{
				$sql="UPDATE tempat_kuliner SET gambar = '$nama_file' WHERE id_tpkuliner= '".$_POST['kode']."'";
				$mysqli->query($sql);
			}
			echo "<script>alert('Data Tempat Kuliner Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=tpkuliner';</script>";	
		} else {
			echo "<script>alert('Data Tempat Kuliner Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_GET['hapus'])){
	$ambil = caridata($mysqli,"SELECT gambar FROM tempat_kuliner WHERE id_tpkuliner = '".$_GET['hapus']."'");
	$stmt = $mysqli->prepare("DELETE FROM tempat_kuliner WHERE id_tpkuliner=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		//HAPUS FILE
		if(is_file("../uploaded/tpkuliner/".$ambil) && $ambil!='default.jpg')
		{
			unlink("../uploaded/tpkuliner/".$ambil);
			unlink("../uploaded/tpkuliner/small_".$ambil);
		}
		echo "<script>alert('Data Tempat Kuliner Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=tpkuliner';</script>";	
	} else {
		echo "<script>alert('Data Tempat Kuliner Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>