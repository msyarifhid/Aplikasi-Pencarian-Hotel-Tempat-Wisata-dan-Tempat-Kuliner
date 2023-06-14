

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Olah Trans Jogja</h3>
    <div class="box-tools pull-right">
       <a href="?hal=transjogja_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
    </div> 
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="dt" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Halte</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php
          $no=1;
          $query="SELECT * FROM transjogja";
          $result=$mysqli->query($query);
          $num_result=$result->num_rows;
          if ($num_result > 0 ) { 
              while ($data=mysqli_fetch_assoc($result)) {
              extract($data);
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $nama_transjogja; ?></td>
            <td><?php echo $latitude; ?></td>
            <td><?php echo $longitude; ?></td>
            <td><?php echo limit_text($alamat, 150);  ?></td>
            <td style="width: 160px">
              <a href="?hal=transjogja_olah&id=<?php echo $id_transjogja; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
              <a href="transjogja_proses.php?hapus=<?php echo $id_transjogja;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $nama_transjogja;?> ?')"><i class="fa fa-trash"></i> Delete</a>
            </td>
          </tr>
      <?php }} ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
