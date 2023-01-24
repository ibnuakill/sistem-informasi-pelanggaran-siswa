<?php
include "../koneksi_db.php";
$tanggal = date("d/m/Y");
$total_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM SISWA"));
$total_kelas = mysqli_fetch_array(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM KELAS"));
$total_jenis = mysqli_fetch_array(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM JENIS_PELANGGARAN"));
$total_pelanggaran = mysqli_fetch_array(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM PELANGGARAN_SISWA"));
$sanksi = mysqli_query($koneksi,"SELECT * FROM SANKSI");
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
          <div class="d-sm-none d-lg-inline-block">Halo, <?php echo $_SESSION['role']; ?></div></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="proses/proses_logout.php" class="dropdown-item has-icon">
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
              <?php echo $_SESSION['role']; ?>
            </div>
          </div>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-header">Menu</li>
          <li class="active" data-toggle="tooltip" data-placement="right" title="" data-original-title="Halaman Utama">
            <a href="dashboard.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
          </li>
          <li data-toggle="tooltip" data-placement="right" data-original-title="Data Siswa">
            <a href="data_siswa.php"><i class="ion ion-ios-people"></i> Data Siswa</a>
          </li>
          <li data-toggle="tooltip" data-placement="right" data-original-title="Data Jurusan">
            <a href="data_jurusan.php"><i class="ion ion-university"></i> Data Jurusan</a>
          </li>
          <li data-toggle="tooltip" data-placement="right" data-original-title="Data Kelas">
            <a href="data_kelas.php"><i class="ion ion-ios-book"></i> Data Kelas</a>
          </li>
          <li data-toggle="tooltip" data-placement="right" data-original-title="Data Jenis Pelanggaran">
            <a href="data_jenispelanggaran.php"><i class="ion ion-document-text"></i> Jenis Pelanggaran</a>
          </li>
          <?php
          if($_SESSION['role'] == "Admin") { 
            echo "
            <li data-toggle='tooltip' data-placement='right' data-original-title='Data Akun Pengguna'>
            <a href='data_akun.php'><i class='ion ion-key'></i> Manajemen Akun</a>
            </li>";
          }
          else if($_SESSION['role'] == "Pegawai") { 
            echo "
            <li data-toggle='tooltip' data-placement='right' data-original-title='Data Pelanggaran Siswa'>
            <a href='data_pelanggaran.php'><i class='ion ion-android-alert'></i> Pelanggaran Siswa</a>
            </li>";
          }
          ?>
        </ul>
      </aside>
    </div>
    <div class="main-content">
      <section class="section">
        <h1 class="section-header">
          <div>Dashboard</div>
        </h1>
        <div class="row">
          <?php
          if($_SESSION['role'] == "Admin") {
            echo '<div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm-4">
            <div class="card-icon bg-primary">
            <i class="ion ion-android-calendar"></i>
            </div>
            <div class="card-wrap">
            <div class="card-header">
            <h4>Tanggal</h4>
            </div>
            <div class="card-body">';
            echo $tanggal;
            echo '</div>
            </div>
            </div>
            </div>';
          }
          ?>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm-4">
              <div class="card-icon bg-primary">
                <i class="ion ion-ios-people"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Siswa</h4>
                </div>
                <div class="card-body">
                  <?php echo $total_siswa['total']; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm-4">
              <div class="card-icon bg-primary">
                <i class="ion ion-ios-book"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Kelas</h4>
                </div>
                <div class="card-body">
                  <?php echo $total_kelas['total']; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm-4">
              <div class="card-icon bg-primary">
                <i class="ion ion-document-text"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Jenis Pelanggaran</h4>
                </div>
                <div class="card-body">
                  <?php echo $total_jenis['total']; ?>
                </div>
              </div>
            </div>
          </div>
          <?php
          if($_SESSION['role'] == "Pegawai") {
            echo '<div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm-4">
            <div class="card-icon bg-primary">
            <i class="ion ion-android-alert"></i>
            </div>
            <div class="card-wrap">
            <div class="card-header">
            <h4>Pelanggaran Siswa</h4>
            </div>
            <div class="card-body">';
            echo $total_pelanggaran['total'];
            echo '</div>
            </div>
            </div>
            </div>';
          }
          ?>
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
          </div>
        </div>
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
</body>
</html>