<?php
	
	require_once 'conn.php';
	
	$conn = mysqli_connect(host, name, pass, dbase) or die ('Unable to Connect');
	
	if (isset($_GET['key'])){
		//
		$key = $_GET['key'];
		/*$query = "SELECT * FROM hotel WHERE nama_hotel LIKE '%$key%'";*/
		$query = "select hotel.*, km_hotel.* from hotel join km_hotel on hotel.id_hotel = km_hotel.id_hotel where hotel.nama_hotel LIKE '%$key%'";
		$result = mysqli_query($conn, $query);
			$response = array();
			while ($row = mysqli_fetch_assoc($result)){
				array_push($response,
					array(
						'id_hotel' => $row['id_hotel'],
						'id_kab' => $row['id_kab'],
						'nama_hotel' => $row['nama_hotel'],
						'fasilitas' => $row['fasilitas'],
						'alamat' => $row['alamat'],
						'deskripsi' => $row['deskripsi'],
						'gambar' => $row['gambar'],
						'latitude' => $row['latitude'],
						'longitude' => $row['longitude'],
						'harga' => $row['harga']
					)
				);
			}
			echo json_encode($response);
	
	}else{
		//
		//$key = $_GET['key'];
		$query = "select hotel.*, km_hotel.* from hotel join km_hotel on hotel.id_hotel = km_hotel.id_hotel";
		$result = mysqli_query($conn, $query);
			$response = array();
			while ($row = mysqli_fetch_assoc($result)){
				array_push($response,
					array(
						'id_hotel' => $row['id_hotel'],
						'id_kab' => $row['id_kab'],
						'nama_hotel' => $row['nama_hotel'],
						'fasilitas' => $row['fasilitas'],
						'alamat' => $row['alamat'],
						'deskripsi' => $row['deskripsi'],
						'gambar' => $row['gambar'],
						'latitude' => $row['latitude'],
						'longitude' => $row['longitude'],
						'harga' => $row['harga']
					)
				);
			}
			echo json_encode($response);
	
	}
	
	mysqli_close($conn);

?>