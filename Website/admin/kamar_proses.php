<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$s=1;
	$kode = $_POST['kode'];
	//upload
	$lokasi_file    = $_FILES['gamkamar']['tmp_name'];
	$tipe_file      = $_FILES['gamkamar']['type'];
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
			if(is_dir("../uploaded/kmhotel"))
			{
				$tempat_gambar = "../uploaded/kmhotel";
			}else{
				mkdir("../uploaded/kmhotel");
				$tempat_gambar = "../uploaded/kmhotel";
			}
			UploadImage($nama_file, $tempat_gambar ,"gamkamar");
			$s=2;
		}
	}else{
		$nama_file = "default.jpg";
		$s=2;
	}

	if ($s==2) {

		$stmt = $mysqli->prepare("INSERT INTO km_hotel 
		(id_kamar,id_hotel,id_jeniskm,jumlah,harga, gamkamar) 
		VALUES (?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("ssssss",
			$_POST['kode'], 
			$_POST['hotel'],
			$_POST['jenis'],
			$_POST['jml'],
			$_POST['harga'],
			$nama_file);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Menu Kamar Hotel Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=mnkuliner';</script>";	
		} else {
			echo "<script>alert('Data Menu Kamar Hotel Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_POST['ubah'])){
	$s=1;
	$kode = $_POST['kode'];
	$lokasi_file    = $_FILES['gamkamar']['tmp_name'];
	$tipe_file      = $_FILES['gamkamar']['type'];
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
			if(is_dir("../uploaded/kmhotel"))
			{
				$tempat_gambar = "../uploaded/kmhotel";
			}else{
				mkdir("../uploaded/kmhotel");
				$tempat_gambar = "../uploaded/kmhotel";
			}
			$ambil = caridata($mysqli,"SELECT gamkamar FROM km_hotel WHERE id_kamar = '".$_POST['kode']."'");
			if(is_file("../uploaded/kmhotel/".$ambil) && $ambil!='default.jpg')
				{
					unlink("../uploaded/kmhotel/".$ambil);
					unlink("../uploaded/kmhotel/small_".$ambil);
				}
			UploadImage($nama_file, $tempat_gambar ,"gamkamar");
			$s=2;
		}
	}else{
		$s=3;
	}

	if (($s==2) || ($s==3)) {

		$stmt = $mysqli->prepare("UPDATE km_hotel  SET 
		id_hotel=?,
		id_jeniskm=?,
		jumlah=?,
		harga=?
		WHERE id_kamar=?");
		$stmt->bind_param("sssss",
			$_POST['hotel'],
			$_POST['jenis'],
			$_POST['jml'],
			$_POST['harga'], 
			$_POST['kode']);	

		if ($stmt->execute()) { 
			if($s==2)
			{
				$sql="UPDATE km_hotel SET gamkamar = '$nama_file' WHERE id_kamar= '".$_POST['kode']."'";
				$mysqli->query($sql);
			}
			echo "<script>alert('Data Menu Kamar Hotel Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=kmhotel';</script>";	
		} else {
			echo "<script>alert('Data Menu Kamar Hotel Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_GET['hapus'])){
	$ambil = caridata($mysqli,"SELECT gamkamar FROM km_hotel WHERE id_kamar = '".$_GET['hapus']."'");
	$stmt = $mysqli->prepare("DELETE FROM km_hotel WHERE id_kamar=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		//HAPUS FILE
		if(is_file("../uploaded/kmhotel/".$ambil) && $ambil!='default.jpg')
		{
			unlink("../uploaded/kmhotel/".$ambil);
			unlink("../uploaded/kmhotel/small_".$ambil);
		}
		echo "<script>alert('Data Menu Kamar Hotel Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=kmhotel';</script>";	
	} else {
		echo "<script>alert('Data Menu Kamar Hotel Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>