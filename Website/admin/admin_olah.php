<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"admin","id_admin='$kode'"));
    $a = "Edit Data";

}else{
    $id_admin=KodeOtomatis($mysqli,"admin","id_admin","","","");
    $nama_admin="";
    $email="";
    $no_tlp="";
    $username="";    
    $password="";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="admin_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Id Admin</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" value="<?php echo $id_admin; ?>" placeholder="Id Admin ..." readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Admin</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" value="<?php echo $nama_admin; ?>" placeholder="Nama Admin ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Email</label>
	        <div class="col-sm-4">
	          <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email Admin ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">No Telp</label>
	        <div class="col-sm-4">
	          <input type="text" name="telp" class="form-control" value="<?php echo $no_tlp; ?>" placeholder="Telp Admin ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Username</label>
	        <div class="col-sm-4">
	          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username ..." >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Password</label>
	        <div class="col-sm-4">
	          <input type="text" name="password" class="form-control"  value="<?php echo $password; ?>" placeholder="Password ..." required>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=admin" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		