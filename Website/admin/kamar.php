

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Olah Data Kamar</h3>
              <div class="box-tools pull-right">
                 <a href="?hal=kamar_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Nama Hotel</th>
                  <th>Nama Jenis Kamar</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT * FROM km_hotel KH JOIN jenis_km J ON KH.id_jeniskm=J.id_jeniskm JOIN hotel H ON KH.id_hotel=H.id_hotel";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td style="width: 160px; text-align: center;"><img width="155px" height="100px" src="../uploaded/kmhotel/small_<?php echo $gamkamar;?>"></td>
                      <td><?php echo $nama_hotel; ?></td>
                      <td><?php echo $nama_jeniskm; ?></td>
                      <td><?php echo $jumlah; ?></td>
                      <td><?php echo $harga; ?></td>
                      <td>
                        <a href="?hal=kamar_olah&id=<?php echo $id_kamar; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="kamar_proses.php?hapus=<?php echo $id_kamar;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $nama_jeniskm;?> di Hotel <?php echo $nama_hotel;?>?')"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
