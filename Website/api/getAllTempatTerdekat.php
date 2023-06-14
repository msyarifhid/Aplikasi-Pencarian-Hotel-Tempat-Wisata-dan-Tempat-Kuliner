<?php
	
	require_once 'conn.php';
	
	$conn = mysqli_connect(host, name, pass, dbase) or die ('Unable to Connect');
	
	//mnghtung jrk bdsr lat lng 2 tempat
	function hitungJarak($lat1, $lon1, $lat2, $lon2, $unit = "K")
	{
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
		  return ($miles * 1.609344);
		} else if ($unit == "N") {
		  return ($miles * 0.8684);
		} else {
		  return $miles;
		}
	}

	
	
	$jenis = $_GET['jenis'];
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	$response = array();

	// get from hotel
	$query = "SELECT * FROM hotel";
	$hotel = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($hotel)){
		array_push($response,
			array(
				'id' => $row['id_hotel'],
				'nama' => $row['nama_hotel'],
				'jenis' => 'hotel',
				
				'deskripsi' => $row ['deskripsi'],
				'alamat' => $row ['alamat'],
				'gambar' => $row ['gambar'],
				
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude'],
				'jarak' => hitungJarak($lat, $lng, $row['latitude'], $row['longitude'])
			)
		);
	}
		
	// get from tpWisata
	$query = "SELECT * FROM tempat_wisata";
	$tempat_wisata = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($tempat_wisata)){
		array_push($response,
			array(
				'id' => $row['id_tpwisata'],
				'nama' => $row['nama_tpwisata'],
				'jenis' => 'tempat_wisata',
				
				'deskripsi' => $row ['deskripsi'],
				'alamat' => $row ['alamat'],
				'gambar' => $row ['gambar'],
				
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude'],
				'jarak' => hitungJarak($lat, $lng, $row['latitude'], $row['longitude'])
			)
		);
	}
		
	// get from tpKuliner
	$query = "SELECT * FROM tempat_kuliner";
	$tempat_kuliner = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($tempat_kuliner)){
		array_push($response,
			array(
				'id' => $row['id_tpkuliner'],
				'nama' => $row['nama_tpkuliner'],
				'jenis' => 'tempat_kuliner',
				
				'deskripsi' => $row ['deskripsi'],
				'alamat' => $row ['alamat'],
				'gambar' => $row ['gambar'],
				
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude'],
				'jarak' => hitungJarak($lat, $lng, $row['latitude'], $row['longitude'])
			)
		);
	}
	
	/*
	// get from transjogja
	$query = "SELECT * FROM transjogja";
	$transjogja = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($transjogja)){
		array_push($response,
			array(
				'id' => $row['id_transjogja'],
				'nama' => $row['nama_transjogja'],
				'jenis' => 'transjogja',
				
				'alamat' => $row ['alamat'],
				
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude'],
				'jarak' => hitungJarak($lat, $lng, $row['latitude'], $row['longitude'])
			)
		);
	}
	*/
	
		
		//var_dump($response);
	echo json_encode($response);
	
	mysqli_close($conn);

?>