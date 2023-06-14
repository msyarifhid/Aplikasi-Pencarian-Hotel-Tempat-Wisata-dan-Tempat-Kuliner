<?php
    $kode=$_SESSION['kln_adm'];
    extract(ArrayData($mysqli,"admin","id_admin='$kode'"));
    $a = "Edit Profil";
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="profil_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">ID Admin</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" value="<?php echo $id_admin; ?>" placeholder="NIP Pegawai ..." readonly>
	        </div>
	        <!-- <div class="col-sm-4"></div> -->
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Admin</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" value="<?php echo $nama_admin; ?>" placeholder="Nama Admin ..." required>
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
		        	<a href="?hal=beranda" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="ubah" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		