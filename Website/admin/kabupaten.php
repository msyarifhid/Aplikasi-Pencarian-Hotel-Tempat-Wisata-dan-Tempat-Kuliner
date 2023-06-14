

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Olah Data Kabupaten</h3>
              <div class="box-tools pull-right">
                 <a href="?hal=kabupaten_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kabupaten</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT * FROM kabupaten";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <!-- <td><?php echo $no++ ?></td> -->
                      <td><?php echo $id_kab; ?></td>
                      <td><?php echo $nama_kab; ?></td>
                      <td>
                        <a href="?hal=kabupaten_olah&id=<?php echo $id_kab; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="kabupaten_proses.php?hapus=<?php echo $id_kab;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $nama_kab;?> ?')"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
