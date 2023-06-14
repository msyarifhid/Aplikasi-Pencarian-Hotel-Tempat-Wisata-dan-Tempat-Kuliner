<?php
	
	require_once 'conn.php';
	
	$conn = mysqli_connect(host, name, pass, dbase) or die ('Unable to Connect');
	
	if (isset($_GET['key'])){
		//
		$key = $_GET['key'];
		$query = "SELECT * FROM tempat_wisata WHERE nama_tpwisata LIKE '%$key%'";
		$result = mysqli_query($conn, $query);
			$response = array();
			while ($row = mysqli_fetch_assoc($result)){
				array_push($response,
					array(
						'id_tpwisata' => $row['id_tpwisata'],
						'id_kab' => $row['id_kab'],
						'nama_tpwisata' => $row['nama_tpwisata'],
						'alamat' => $row['alamat'],
						'deskripsi' => $row['deskripsi'],
						'gambar' => $row['gambar'],
						'harga_tiket' => $row['harga_tiket'],
						'latitude' => $row['latitude'],
						'longitude' => $row['longitude']
					)
				);
			}
			echo json_encode($response);
	
	}else{
		//
		//$key = $_GET['key'];
		$query = "SELECT * FROM tempat_wisata";
		$result = mysqli_query($conn, $query);
			$response = array();
			while ($row = mysqli_fetch_assoc($result)){
				array_push($response,
					array(
						'id_tpwisata' => $row['id_tpwisata'],
						'id_kab' => $row['id_kab'],
						'nama_tpwisata' => $row['nama_tpwisata'],
						'alamat' => $row['alamat'],
						'deskripsi' => $row['deskripsi'],
						'gambar' => $row['gambar'],
						'harga_tiket' => $row['harga_tiket'],
						'latitude' => $row['latitude'],
						'longitude' => $row['longitude']
					)
				);
			}
			echo json_encode($response);
	
	}
	
	mysqli_close($conn);

?>