<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$s=1;
	$kode = $_POST['kode'];
	//upload
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GH'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/hotel"))
			{
				$tempat_gambar = "../uploaded/hotel";
			}else{
				mkdir("../uploaded/hotel");
				$tempat_gambar = "../uploaded/hotel";
			}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$nama_file = "default.jpg";
		$s=2;
	}

	if ($s==2) {

		$stmt = $mysqli->prepare("INSERT INTO hotel 
			(id_hotel,nama_hotel,id_kab,fasilitas,latitude,longitude,deskripsi,alamat,gambar) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("sssssssss",
			$_POST['kode'], 
			$_POST['nama'],
			$_POST['kab'],
			$_POST['fasilitas'],
			$_POST['lat'], 
			$_POST['long'], 
			$_POST['des'], 
			$_POST['alamat'], 
			$nama_file);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Hotel Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=hotel';</script>";	
		} else {
			echo "<script>alert('Data Hotel Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_POST['ubah'])){
	$s=1;
	$kode = $_POST['kode'];
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GH'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/hotel"))
			{
				$tempat_gambar = "../uploaded/hotel";
			}else{
				mkdir("../uploaded/hotel");
				$tempat_gambar = "../uploaded/hotel";
			}
			$ambil = caridata($mysqli,"SELECT gambar FROM hotel WHERE id_hotel = '".$_POST['kode']."'");
			if(is_file("../uploaded/hotel/".$ambil) && $ambil!='default.jpg')
				{
					unlink("../uploaded/hotel/".$ambil);
					unlink("../uploaded/hotel/small_".$ambil);
				}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$s=3;
	}

	if (($s==2) || ($s==3)) {

		$stmt = $mysqli->prepare("UPDATE hotel  SET 
			nama_hotel=?,
			id_kab=?,
			fasilitas=?,
			latitude=?,
			longitude=?,
			deskripsi=?,
			alamat=?
			WHERE id_hotel=?");
		$stmt->bind_param("ssssssss", 
			$_POST['nama'],
			$_POST['kab'],
			$_POST['fasilitas'],
			$_POST['lat'], 
			$_POST['long'], 
			$_POST['des'], 
			$_POST['alamat'], 
			$_POST['kode']);	

		if ($stmt->execute()) { 
			if($s==2)
			{
				$sql="UPDATE hotel SET gambar = '$nama_file' WHERE id_hotel= '".$_POST['kode']."'";
				$mysqli->query($sql);
			}
			echo "<script>alert('Data Hotel Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=hotel';</script>";	
		} else {
			echo "<script>alert('Data Hotel Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_GET['hapus'])){
	$ambil = caridata($mysqli,"SELECT gambar FROM hotel WHERE id_hotel = '".$_GET['hapus']."'");
	$stmt = $mysqli->prepare("DELETE FROM hotel WHERE id_hotel=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		//HAPUS FILE
		if(is_file("../uploaded/hotel/".$ambil) && $ambil!='default.jpg')
		{
			unlink("../uploaded/hotel/".$ambil);
			unlink("../uploaded/hotel/small_".$ambil);
		}
		echo "<script>alert('Data Hotel Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=hotel';</script>";	
	} else {
		echo "<script>alert('Data Hotel Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>