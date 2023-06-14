<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"jenis_km","id_jeniskm='$kode'"));
    $a = "Edit Data";

}else{
    $id_jeniskm=KodeOtomatis($mysqli,"jenis_km","id_jeniskm","","","");
    $nama_jeniskm="";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="jenis_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Id Jenis Km</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" value="<?php echo $id_jeniskm; ?>" placeholder="Id Jenis Kamar ..." readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Jenis Km</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" value="<?php echo $nama_jeniskm; ?>" placeholder="Nama Jenis ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=jenis" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		