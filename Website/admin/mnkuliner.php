

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Olah Data Menu Kuliner</h3>
    <div class="box-tools pull-right">
       <a href="?hal=mnkuliner_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
    </div> 
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="dt" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Nama Tempat Kuliner</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php
          $no=1;
          $query="SELECT id_mkkuliner, nama_mkkuliner, M.id_tpkuliner, nama_tpkuliner, M.gambar, harga FROM mk_kuliner M JOIN tempat_kuliner K ON M.id_tpkuliner=K.id_tpkuliner";
          $result=$mysqli->query($query);
          $num_result=$result->num_rows;
          if ($num_result > 0 ) { 
              while ($data=mysqli_fetch_assoc($result)) {
              extract($data);
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $nama_mkkuliner; ?></td>
            <td><?php echo $nama_tpkuliner; ?></td>
            <td><?php echo $harga; ?></td>
            <td style="width: 160px; text-align: center;"><img width="155px" height="100px" src="../uploaded/mnkuliner/small_<?php echo $gambar;?>"></td>
            <td style="width: 160px">
              <a href="?hal=mnkuliner_olah&id=<?php echo $id_mkkuliner; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
              <a href="mnkuliner_proses.php?hapus=<?php echo $id_mkkuliner;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $nama_mkkuliner.' Di '.$nama_tpkuliner;?> ?')"><i class="fa fa-trash"></i> Delete</a>
            </td>
          </tr>
      <?php }} ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
