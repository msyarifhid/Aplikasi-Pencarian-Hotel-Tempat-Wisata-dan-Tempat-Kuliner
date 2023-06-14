<?php
require_once '../setting/koneksi.php';

if(isset($_POST['tambah']))
{

	$s=1;
	$kode = $_POST['kode'];
	//upload
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GW'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/wisata"))
			{
				$tempat_gambar = "../uploaded/wisata";
			}else{
				mkdir("../uploaded/wisata");
				$tempat_gambar = "../uploaded/wisata";
			}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$nama_file = "default.jpg";
		$s=2;
	}

	if ($s==2) {

		$stmt = $mysqli->prepare("INSERT INTO tempat_wisata 
			(id_tpwisata,nama_tpwisata,latitude,longitude,deskripsi,alamat,id_kab,harga_tiket,gambar) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("sssssssss",
			$_POST['kode'], 
			$_POST['nama'],
			$_POST['lat'], 
			$_POST['long'], 
			$_POST['des'], 
			$_POST['ala'],
			$_POST['kab'], 
			$_POST['harga'], 
			$nama_file);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data Wisata Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=wisata';</script>";	
		} else {
			echo "<script>alert('Data Wisata Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_POST['ubah'])){
	$s=1;
	$kode = $_POST['kode'];
	$lokasi_file    = $_FILES['gambar']['tmp_name'];
	$tipe_file      = $_FILES['gambar']['type'];
	$nama_file      = 'GW'.$kode.'.jpg'; 
	// Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){		  
		if ($tipe_file != "image/jpeg" && $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File Foto yang di Upload Bertipe *.JPG')</script>";
			//ARAHKAN
			echo "<script>window.location='javascript:history.go(-1)';</script>";
			$s=1;
		}else {
			//buat folder
			if(is_dir("../uploaded/wisata"))
			{
				$tempat_gambar = "../uploaded/wisata";
			}else{
				mkdir("../uploaded/wisata");
				$tempat_gambar = "../uploaded/wisata";
			}
			$ambil = caridata($mysqli,"SELECT gambar FROM tempat_wisata WHERE id_tpwisata = '".$_POST['kode']."'");
			if(is_file("../uploaded/wisata/".$ambil) && $ambil!='default.jpg')
				{
					unlink("../uploaded/wisata/".$ambil);
					unlink("../uploaded/wisata/small_".$ambil);
				}
			UploadImage($nama_file, $tempat_gambar ,"gambar");
			$s=2;
		}
	}else{
		$s=3;
	}

	if (($s==2) || ($s==3)) {

		$stmt = $mysqli->prepare("UPDATE tempat_wisata  SET 
			nama_tpwisata=?,
			latitude=?,
			longitude=?,
			deskripsi=?,
			alamat=?,
			id_kab=?,
			harga_tiket=?
			WHERE id_tpwisata=?");
		$stmt->bind_param("ssssssss",
			$_POST['nama'],
			$_POST['lat'], 
			$_POST['long'], 
			$_POST['des'], 
			$_POST['ala'],
			$_POST['kab'], 
			$_POST['harga'],
			$_POST['kode']);	

		if ($stmt->execute()) { 
			if($s==2)
			{
				$sql="UPDATE tempat_wisata SET gambar = '$nama_file' WHERE id_tpwisata= '".$_POST['kode']."'";
				$mysqli->query($sql);
			}
			echo "<script>alert('Data Wisata Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=wisata';</script>";	
		} else {
			echo "<script>alert('Data Wisata Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_GET['hapus'])){
	$ambil = caridata($mysqli,"SELECT gambar FROM tempat_wisata WHERE id_tpwisata = '".$_GET['hapus']."'");
	$stmt = $mysqli->prepare("DELETE FROM tempat_wisata WHERE id_tpwisata=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		//HAPUS FILE
		if(is_file("../uploaded/wisata/".$ambil) && $ambil!='default.jpg')
		{
			unlink("../uploaded/wisata/".$ambil);
			unlink("../uploaded/wisata/small_".$ambil);
		}
		echo "<script>alert('Data Wisata Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=wisata';</script>";	
	} else {
		echo "<script>alert('Data Wisata Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>