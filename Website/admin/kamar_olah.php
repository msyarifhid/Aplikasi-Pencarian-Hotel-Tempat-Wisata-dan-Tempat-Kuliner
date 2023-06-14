<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"km_hotel","id_kamar='$kode'"));
    $a = "Edit Data";

}else{
    $id_kamar=KodeOtomatis($mysqli,"km_hotel","id_kamar","","","");
    $id_hotel="";
    $id_jeniskm="";
    $jumlah="";
    $harga="";    
    $gamkamar="";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="kamar_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Id Kamar</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" value="<?php echo $id_kamar; ?>" placeholder="Id Kamar ..." readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Hotel</label>
	        <div class="col-sm-4">
	          <select class="form-control select2" name="hotel">
	            <?php
                $query="SELECT * FROM hotel";
                $result=$mysqli->query($query);
                while ($data=mysqli_fetch_assoc($result)) {
                	echo '<option value='.$data['id_hotel'].' '.pilihselect($id_hotel,$data['id_hotel']).'>'.$data['id_hotel'].' | '.$data['nama_hotel'].'</option>';
                }
	            ?>
	          </select>
	        </div>
	      </div>


	      <div class="form-group">
	        <label class="col-sm-3 control-label">Jenis Kamar</label>
	        <div class="col-sm-4">
	          <select class="form-control select2" name="jenis">
	            <?php
                $query="SELECT * FROM jenis_km";
                $result=$mysqli->query($query);
                while ($data=mysqli_fetch_assoc($result)) {
                	echo '<option value='.$data['id_jeniskm'].' '.pilihselect($id_jeniskm,$data['id_jeniskm']).'>'.$data['id_jeniskm'].' | '.$data['nama_jeniskm'].'</option>';
                }
	            ?>
	          </select>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Jumlah</label>
	        <div class="col-sm-4">
	          <input type="number" name="jml" class="form-control" value="<?php echo $jumlah; ?>" placeholder="Jumlah Kamar ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Harga</label>
	        <div class="col-sm-4">
	          <input type="number" name="harga" class="form-control" value="<?php echo $harga; ?>" placeholder="Harga ..." required>
	        </div>
	      </div>
	      
	      <div class="form-group">
	        <label class="col-sm-3 control-label">Gambar Kamar Hotel</label>
	        <div class="col-sm-4">
	        	<?php 
	        	if(isset($_GET['id'])){
	        	?>
        			<img width="155px" height="100px" src="../uploaded/kmhotel/small_<?php echo $gamkamar;?>"><br><br>
	        	<?php 
	        	}?>
	          	<input type="file" name="gamkamar" >
	          	<!-- <div id="image_preview" style="margin-top: 10px; margin-left: 20px;">
                                    <img id="previewing"/>
                                </div> -->
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
		        	<a href="?hal=kamar" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		