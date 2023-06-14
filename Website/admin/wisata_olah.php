<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"tempat_wisata","id_tpwisata='$kode'"));
    $a = "Edit Data";

}else{
    $id_tpwisata=KodeOtomatis($mysqli,"tempat_wisata","id_tpwisata","","","");
    $nama_tpwisata="";
    $latitude="-7.791455";
    $longitude="110.374156";
    $id_kab="";
    $deskripsi="";
    $harga_tiket="";
    $a = "Tambah Data";
}
?>

  	<!-- <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBjxO6B1aE-9WVRhnfYA5BrMfTilfUQLsc"></script> -->
    <script type="text/javascript">
      function initMap() {
          //* Fungsi untuk mendapatkan nilai latitude longitude
      function updateMarkerPosition(latLng) {
        document.getElementById('lat').value = [latLng.lat()]
        document.getElementById('long').value = [latLng.lng()]
      }
             
      var map = new google.maps.Map(document.getElementById('map_w'), {
      zoom: 11,
      center: new google.maps.LatLng(<?php echo $latitude; ?>,<?php echo $longitude; ?>),
       mapTypeId: google.maps.MapTypeId.ROADMAP
        });
      //posisi awal marker   
      var latLng = new google.maps.LatLng(<?php echo $latitude; ?>,<?php echo $longitude; ?>);
       
      /* buat marker yang bisa di drag lalu 
        panggil fungsi updateMarkerPosition(latLng)
       dan letakan posisi terakhir di id=latitude dan id=longitude
       */
      var marker = new google.maps.Marker({
          position : latLng,
          title : 'lokasi',
          map : map,
          draggable : true
        });
         
      updateMarkerPosition(latLng);
      google.maps.event.addListener(marker, 'drag', function() {
       // ketika marker di drag, otomatis nilai latitude dan longitude
       //menyesuaikan dengan posisi marker 
          updateMarkerPosition(marker.getPosition());
        });
 	}
    </script>
	<script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWfzKm2hI-mFjdQdHqRzMDFc5svKXBwUg&callback=initMap">
	</script> 

	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="wisata_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
		  	<div class="col-sm-12">
  				<div id="map_w" style="width:100%;height:300px;"></div>
  			</div>
	      </div>



		  <div class="form-group">
	        <label class="col-sm-3 control-label">Id Wisata</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" value="<?php echo $id_tpwisata; ?>" placeholder="Id wisata ..." readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Wisata</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" value="<?php echo $nama_tpwisata; ?>" placeholder="Nama Wisata ..." >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Latitude</label>
	        <div class="col-sm-4">
	          <input type="text" name="lat" id="lat" class="form-control" maxlength="10" value="<?php echo $latitude; ?>" placeholder="Latitude ..." required >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Longitude</label>
	        <div class="col-sm-4">
	          <input type="text" name="long" id="long" class="form-control" maxlength="10" value="<?php echo $longitude; ?>" placeholder="Longitude ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Deskripsi</label>
	        <div class="col-sm-4">
	          <textarea class="form-control" name="des" rows="3" placeholder="Deskripsi ..." required><?php echo $deskripsi; ?></textarea>
	        </div>
		  </div>
		  
		  <div class="form-group">
	        <label class="col-sm-3 control-label">Alamat</label>
	        <div class="col-sm-4">
	          <textarea class="form-control" name="ala" rows="3" placeholder="Alamat ..." required><?php echo $alamat; ?></textarea>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Harga Tiket</label>
	        <div class="col-sm-4">
	          <input type="number" name="harga" class="form-control" value="<?php echo $harga_tiket; ?>" placeholder="Harga Tiket ..." >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Kabupaten</label>
	        <div class="col-sm-4">
	          <select class="form-control select2" name="kab">
	            <?php
                $query="SELECT * FROM kabupaten";
                $result=$mysqli->query($query);
                while ($data=mysqli_fetch_assoc($result)) {
                	echo '<option value='.$data['id_kab'].' '.pilihselect($id_kab,$data['id_kab']).'>'.$data['id_kab'].' | '.$data['nama_kab'].'</option>';
                }
	            ?>
	          </select>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Gambar Wisata</label>
	        <div class="col-sm-4">
	        	<?php 
	        	if(isset($_GET['id'])){
	        	?>
        			<img width="155px" height="100px" src="../uploaded/wisata/small_<?php echo $gambar;?>"><br><br>
	        	<?php 
	        	}?>
	          	<input type="file" name="gambar" >
	          	<?php 
	        	if(isset($_GET['id'])){
	        	?>
	          		<p class="help-block">Kosongkan, Jika tidak diganti..</p>
	          	<?php
	          	}?>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=wisata" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->
