<?php
include "../koneksi_db.php";
$get_id = $_SESSION['id_akun']; 
$get_nis = mysqli_fetch_array(mysqli_query($koneksi,"SELECT NIS FROM SISWA WHERE id_akun = '$get_id'"));
$poin = mysqli_fetch_array(mysqli_query($koneksi,"SELECT total_poin FROM SISWA WHERE id_akun = '$get_id'"));
$top5siswa = mysqli_query($koneksi,"SELECT * FROM SISWA ORDER BY total_poin ASC");
$sanksi = mysqli_query($koneksi,"SELECT * FROM SANKSI");
$nis = $get_nis['NIS'];
$pelanggaran = mysqli_fetch_array(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM PELANGGARAN_SISWA WHERE NIS = '$nis'"));
?>

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
            <div class="user-name"><?php echo $_SESSION['nama_pengguna']; ?></div>
            <div class="user-role">
              <?php echo $nis ?>
            </div>
          </div>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-header">Menu</li>
          <li class="active" data-toggle="tooltip" data-placement="right" title="" data-original-title="Halaman Utama">
            <a href="index.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
          </li>
          <li data-toggle="tooltip" data-placement="right" data-original-title="Profil Siswa">
            <a href="data_profil.php"><i class="ion ion-ios-people"></i> Profil</a>
          </li>
          <li data-toggle="tooltip" data-placement="right" data-original-title="Data Rincian Pelanggaran">
            <a href="data_rincian.php"><i class="ion ion-university"></i> Rincian Pelanggaran</a>
          </li>
        </ul>
      </aside>
    </div>
    <div class="main-content">
      <section class="section">
        <h1 class="section-header">
          <div>Dashboard</div>
        </h1>
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-6">
            <div class="card card-sm-4">
              <div class="card-icon bg-primary">
                <i class="ion ion-android-calendar"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Poin</h4>
                </div>
                <div class="card-body">
                  <?php echo $poin['total_poin']; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-lg-6">
            <div class="card card-sm-4">
              <div class="card-icon bg-primary">
                <i class="ion ion-android-alert"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Pelanggaran</h4>
                </div>
                <div class="card-body">
                  <?php echo $pelanggaran['total']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Top 5 Pelanggaran Siswa</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th>No.</th>
                  <th>Nama Siswa</th>
                  <th>Total Poin</th>
                  <th>Kelas</th>
                </tr>
                <tr>
                  <?php
                  $no = 1;
                  while($data = mysqli_fetch_array($top5siswa)){
                    echo "<tr>
                    <td>".$no."</td>
                    <td>".$data['nama_siswa']."</td>
                    <td>".$data['total_poin']."</td>
                    <td>".$data['nama_kelas']."</td>
                    </tr>";
                    $no++;
                  }
                  ?>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Information!</h4>
          </div>
          <div class="card-body">
            <h6><a href="https://bit.ly/TataTertibSiswa2021" target="_blank" class="download">
              <i class="fas fa-file-pdf"></i> Unduh Tata Tertib dan Poin Pelanggaran Tahun 2021/2022</a></h6>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4>Sanksi Pelanggaran</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>

                    <th>No.</th>
                    <th>Rentang</th>
                    <th>Tindakan Sekolah</th>
                    <th>Sanksi</th>
                    <th>Pelaksana</th>
                  </tr>
                  <?php
                  while($data = mysqli_fetch_array($sanksi)){
                    echo "<tr>
                    <td>".$data['no_sanksi']."</td>
                    <td>".$data['rentang']."</td>
                    <td>".$data['tindakan_sekolah']."</td>
                    <td>".$data['sanksi']."</td>
                    <td>".$data['pelaksana']."</td>
                    </tr>";
                  }
                  ?>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">Kelompok RPL SIPS</div>
      </footer>
    </div>
  </div>
  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/bootstrap/js/select2.full.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
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