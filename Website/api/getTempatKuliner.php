<?php
	
	require_once 'conn.php';
	
	$conn = mysqli_connect(host, name, pass, dbase) or die ('Unable to Connect');
	
	if (isset($_GET['key'])){
		//
		$key = $_GET['key'];
		$query = "SELECT * FROM tempat_kuliner WHERE nama_tpkuliner LIKE '%$key%'";
		$result = mysqli_query($conn, $query);
			$response = array();
			while ($row = mysqli_fetch_assoc($result)){
				array_push($response,
					array(
						'id_tpkuliner' => $row['id_tpkuliner'],
						'id_kab' => $row['id_kab'],
						'nama_tpkuliner' => $row['nama_tpkuliner'],
						'alamat' => $row['alamat'],
						'jambu_buka' => $row['jam_buka'],
						'jambu_tutup' => $row['jam_tutup'],
						'deskripsi' => $row['deskripsi'],
						'gambar' => $row['gambar'],
						'latitude' => $row['latitude'],
						'longitude' => $row['longitude']
					)
				);
			}
			echo json_encode($response);
	
	}else{
		//
		//$key = $_GET['key'];
		$query = "SELECT * FROM tempat_kuliner WHERE nama_tpkuliner";
		$result = mysqli_query($conn, $query);
			$response = array();
			while ($row = mysqli_fetch_assoc($result)){
				array_push($response,
					array(
						'id_tpkuliner' => $row['id_tpkuliner'],
						'id_kab' => $row['id_kab'],
						'nama_tpkuliner' => $row['nama_tpkuliner'],
						'alamat' => $row['alamat'],
						'jambu_buka' => $row['jam_buka'],
						'jambu_tutup' => $row['jam_tutup'],
						'deskripsi' => $row['deskripsi'],
						'gambar' => $row['gambar'],
						'latitude' => $row['latitude'],
						'longitude' => $row['longitude']
					)
				);
			}
			echo json_encode($response);
	
	}
	
	mysqli_close($conn);

?>