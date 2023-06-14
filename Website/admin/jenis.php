

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Olah Data Jenis kamar</h3>
              <div class="box-tools pull-right">
                 <a href="?hal=jenis_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jenis Kamar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT * FROM jenis_km";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <!-- <td><?php echo $no++ ?></td> -->
                      <td><?php echo $id_jeniskm; ?></td>
                      <td><?php echo $nama_jeniskm; ?></td>
                      <td>
                        <a href="?hal=jenis_olah&id=<?php echo $id_jeniskm; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="jenis_proses.php?hapus=<?php echo $id_jeniskm;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $nama_jeniskm;?> ?')"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
