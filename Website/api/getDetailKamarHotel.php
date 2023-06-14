<?php
    require_once 'conn.php';
	
	$conn = mysqli_connect(host, name, pass, dbase) or die ('Unable to Connect');
    if (isset($_GET['key'])) {
        $id = $_GET['key'];
        $query = "SELECT * FROM km_hotel where id_hotel = '$id' and gamkamar <> ''";
		$result = mysqli_query($conn, $query);
		$response = array();
		while ($row = mysqli_fetch_assoc($result)){
    		array_push($response,
    			array(
    				'gamkamar' => $row['gamkamar'],
    			)
    		);
    	}
		
		echo json_encode($response);
    }
    mysqli_close($conn);
?>