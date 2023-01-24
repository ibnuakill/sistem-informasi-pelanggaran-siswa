<?php
include "../koneksi_db.php";
session_start();
$get_id = $_SESSION['id_akun']; 
$get_nis = mysqli_fetch_array(mysqli_query($koneksi,"SELECT NIS FROM SISWA WHERE id_akun = '$get_id'"));
$nis = $get_nis['NIS'];
$pelanggaran = mysqli_query($koneksi,"SELECT * FROM PELANGGARAN_SISWA WHERE NIS = '$nis'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>SIPS Siswa &rsaquo; Rincian Pelanggaran</title>
  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/bootstrap/css/select2.min.css">
  <link rel="stylesheet" href="../dist/modules/bootstrap/css/select2-bootstrap.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../dist/modules/summernote/summernote-lite.css">
  <link rel="stylesheet" href="../dist/modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../dist/css/style.css">
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                <i class="ion ion-navicon-round"></i>
              </a>
            </li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <i class="ion ion-android-person d-lg-none"></i>
            <div class="d-sm-none d-lg-inline-block">Hi, Siswa</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="proses_logout.php" class="dropdown-item has-icon">
                <i class="ion ion-log-out"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">SIPS</a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="../dist/img/avatar/avatar.png">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name">Almira Najah</div>
              <div class="user-role">
                Siswa
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li data-toggle="tooltip" data-placement="right" title="" data-original-title="Halaman Utama">
              <a href="index.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>
            <li data-toggle="tooltip" data-placement="right" data-original-title="Profil Siswa">
              <a href="data_profil.php"><i class="ion ion-ios-people"></i> Profil</a>
            </li>
            <li class="active" data-toggle="tooltip" data-placement="right" data-original-title="Data Rincian Pelanggaran">
              <a href="data_rincian.php"><i class="ion ion-university"></i> Rincian Pelanggaran</a>
            </li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Rincian Pelanggaran</div>
          </h1>
          <div class="card">
            <div class="card-header">
              <div class="float-right">
              </div>
              <h4>Tabel Rincian Pelanggaran Siswa</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Jenis Pelanggaran</th>
                      <th>Poin</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    while($data = mysqli_fetch_array($pelanggaran)){
                      echo "<tr>
                      <td>".$no."</td>
                      <td>".$data['jenis_pelanggaran']."</td>
                      <td>".$data['poin']."</td>
                      <td>".date("d/m/Y", strtotime($data['tanggal']))."</td>
                      <td>".$data['keterangan']."</td>";
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">Kelompok RPL SIPS</div>
      </footer>
    </section>
  </div>
  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/bootstrap/js/select2.full.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  <script src="../dist/modules/chart.min.js"></script> 
  <script src="../dist/js/jquery.dataTables.min.js"></script>
  <script src="../dist/js/dataTables.buttons.min.js"></script>
  <script src="../dist/js/buttons.colVis.min.js"></script>
  <script src="../dist/js/buttons.html5.min.js"></script>
  <script src="../dist/js/buttons.print.min.js"></script>
  <script src="../dist/js/dataTables.bootstrap.min.js"></script>
  <script src="../dist/js/buttons.bootstrap.min.js"></script>
  <script src="../dist/js/jszip.min.js"></script>
  <script src="../dist/js/vfs_fonts.js"></script>     
  <script src="../dist/js/pdfmake.min.js"></script>
  <script src="../dist/modules/summernote/summernote-lite.js"></script>
  <script src="../dist/js/scripts.js"></script>  
  <script src="../dist/js/custom.js"></script>
</body>
</html>