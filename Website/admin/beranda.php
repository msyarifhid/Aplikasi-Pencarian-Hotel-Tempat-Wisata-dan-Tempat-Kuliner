
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo JumlahData($mysqli,"tempat_wisata"); ?></h3>

              <p>Tempat Wisata</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list"></i>
            </div>
            <a href="?hal=wisata" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo JumlahData($mysqli,"hotel"); ?></h3>

              <p>Hotel</p>
            </div>
            <div class="icon">
              <i class="ion ion-social-buffer"></i>
            </div>
            <a href="?hal=hotel" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo JumlahData($mysqli,"admin"); ?></h3>

              <p>Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="?hal=admin" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo JumlahData($mysqli,"tempat_kuliner"); ?></h3>

              <p>Tempat Kuliner</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-calendar"></i>
            </div>
            <a href="?hal=tpkuliner" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6"> 
           small box 
           <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo JumlahData($mysqli,"transjogja"); ?></h3>

              <p>Halte Trans Jogja</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bus"></i>
            </div>
            <a href="?hal=transjogja" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> 
      </div>
      <!-- /.row -->
