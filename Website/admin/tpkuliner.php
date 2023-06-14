

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Olah Data Tempat Kuliner</h3>
    <div class="box-tools pull-right">
       <a href="?hal=tpkuliner_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
    </div> 
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="dt" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama Tempat</th>
        <th>Kabupaten</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Jam Buka</th>
        <th>Deskripsi</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php
          $no=1;
          $query="SELECT * FROM tempat_kuliner W JOIN kabupaten K ON W.id_kab=K.id_kab";
          $result=$mysqli->query($query);
          $num_result=$result->num_rows;
          if ($num_result > 0 ) { 
              while ($data=mysqli_fetch_assoc($result)) {
              extract($data);
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td style="width: 160px; text-align: center;"><img width="155px" height="100px" src="../uploaded/tpkuliner/small_<?php echo $gambar;?>"></td>
            <td><?php echo $nama_tpkuliner; ?></td>
            <td><?php echo $nama_kab; ?></td>
            <td><?php echo $latitude; ?></td>
            <td><?php echo $longitude; ?></td>
            <td><?php echo $jam_buka.'-'.$jam_tutup; ?></td>
            <td><?php echo limit_text($deskripsi, 150) ; ?></td>
            <td><?php echo limit_text($alamat, 150) ; ?></td> 
            <td style="width: 160px">
              <a href="?hal=tpkuliner_olah&id=<?php echo $id_tpkuliner; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
              <a href="tpkuliner_proses.php?hapus=<?php echo $id_tpkuliner;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $nama_tpkuliner;?> ?')"><i class="fa fa-trash"></i> Delete</a>
            </td>
          </tr>
      <?php }} ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
