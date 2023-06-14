<?php
require_once '../setting/koneksi.php';

session_start();

if (isset($_SESSION['kln_adm'])){
  $hal = @$_GET['hal'];
  $kode=$_SESSION['kln_adm'];
  // extract(ArrayDataQ($mysqli,"SELECT id_pengguna, username, level, P.nip, nm_pegawai, id_jabatan FROM pengguna P JOIN pegawai PG ON P.nip=PG.nip WHERE P.nip='$kode'"));
  extract(ArrayData($mysqli,"admin","id_admin='$kode'"));

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Jogja Easytrip</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">

  <!-- Logo Title -->
  <link rel="shortcut icon" type="image/png" href="../uploaded/logo/f.png">
  <!-- jQuery 3 -->
  <script src="../assets/jquery/dist/jquery.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- <script src="../aset/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../aset/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
  <!-- SlimScroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/skin-purple.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>E</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Jogja Easytrip</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../assets/dist/img/avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $nama_admin; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../assets/dist/img/avatar.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $nama_admin; ?>
                  <small>Level : Admin</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?hal=profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
<!--       <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p> -->
          <!-- Status -->
<!--           <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header text-center"><h5><b>Menu Navigation</b></h5></li>
        <!-- Optionally, you can add icons to the links -->
        <li <?= ($hal=='beranda' || $hal=='')?'class="active"':'' ?>><a href="index.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <li <?= ($hal=='admin' || $hal=='admin_olah')?'class="active"':'' ?>><a href="?hal=admin"><i class="fa fa-user"></i> <span>Olah Admin</span></a></li>
        <li <?= ($hal=='kabupaten' || $hal=='kabupaten_olah')?'class="active"':'' ?>><a href="?hal=kabupaten"><i class="fa fa-database"></i> <span>Olah Kabupaten</span></a></li>
        <li <?= ($hal=='jenis' || $hal=='jenis_olah')?'class="active"':'' ?>><a href="?hal=jenis"><i class="fa fa-briefcase"></i> <span>Olah Jenis Kamar</span></a></li>
        <li <?= ($hal=='hotel' || $hal=='hotel_olah')?'class="active"':'' ?>><a href="?hal=hotel"><i class="fa fa-building"></i> <span>Olah Hotel</span></a></li>
        <li <?= ($hal=='kamar' || $hal=='kamar_olah')?'class="active"':'' ?>><a href="?hal=kamar"><i class="fa fa-hotel"></i> <span>Olah Kamar Hotel</span></a></li>
        <li <?= ($hal=='wisata' || $hal=='wisata_olah')?'class="active"':'' ?>><a href="?hal=wisata"><i class="fa fa-tree"></i> <span>Olah Tempat Wisata</span></a></li>
        <li <?= ($hal=='tpkuliner' || $hal=='tpkuliner_olah')?'class="active"':'' ?>><a href="?hal=tpkuliner"><i class="fa fa-image"></i> <span>Olah Tempat Kuliner</span></a></li>
        <li <?= ($hal=='mnkuliner' || $hal=='mnkuliner_olah')?'class="active"':'' ?>><a href="?hal=mnkuliner"><i class="fa fa-cutlery"></i> <span>Olah Menu Kuliner</span></a></li>
         <li <?= ($hal=='transjogja' || $hal=='transjogja_olah')?'class="active"':'' ?>><a href="?hal=transjogja"><i class="fa fa-bus"></i> <span>Olah Menu Halte</span></a></li> 


        <li ><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= ($hal != '')?ucwords(str_replace("_", " ", $hal)):'Beranda' ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active"><?= ($hal != '')?ucwords(str_replace("_", " ", $hal)):'' ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

                <?php
                $hal = @$_GET['hal'];
                $modul = "";
                $default = $modul."beranda.php";
                if(!$hal){
                    require_once "$default";
                }else{
                    switch($hal){
                        case $hal:
                        if(is_file($modul.$hal.".php")){
                            require_once $modul.$hal.".php";
                        }else{
                            require_once "$default";
                        }
                        break;
                        default:
                        require_once "$default";
                    }
                }

                ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Jogja Easytrip</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Bootstrap 3.3.7 -->
<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../assets/select2/dist/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
  $(function () {
    $('#dt').DataTable({
      scrollX: true
    });
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })

    // Daterange Picker
    $('#tanggal_berangkat').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      format: 'YYYY-MM-DD'
    });

    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
</body>
</html>

<?php
}else{
    echo "<script>window.location='../login.php';</script>";
}
?>