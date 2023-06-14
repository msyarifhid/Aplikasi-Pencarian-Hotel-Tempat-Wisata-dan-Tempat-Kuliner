<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"mk_kuliner","id_mkkuliner='$kode'"));
    $a = "Edit Data";

}else{
    $id_mkkuliner=KodeOtomatis($mysqli,"mk_kuliner","id_mkkuliner","","","");
    $nama_mkkuliner="";
    $id_tpkuliner="";
    $harga="";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="mnkuliner_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Id Menu Kuliner</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" value="<?php echo $id_mkkuliner; ?>" placeholder="Id Menu ..." readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Menu</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" value="<?php echo $nama_mkkuliner; ?>" placeholder="Nama Menu ..." >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Harga</label>
	        <div class="col-sm-4">
	          <input type="number" name="harga" class="form-control" value="<?php echo $harga; ?>" placeholder="Harga Menu ..." >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Tempat Kuliner</label>
	        <div class="col-sm-4">
	          <select class="form-control select2" name="tpkuliner">
	            <?php
                $query="SELECT * FROM tempat_kuliner";
                $result=$mysqli->query($query);
                while ($data=mysqli_fetch_assoc($result)) {
                	echo '<option value='.$data['id_tpkuliner'].' '.pilihselect($id_tpkuliner,$data['id_tpkuliner']).'>'.$data['id_tpkuliner'].' | '.$data['nama_tpkuliner'].'</option>';
                }
	            ?>
	          </select>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Gambar Menu</label>
	        <div class="col-sm-4">
	        	<?php 
	        	if(isset($_GET['id'])){
	        	?>
        			<img width="155px" height="100px" src="../uploaded/mnkuliner/small_<?php echo $gambar;?>"><br><br>
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
		        	<a href="?hal=mnkuliner" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		