<?php
include "../koneksi_db.php";
session_start();
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM PELANGGARAN_SISWA WHERE id_pelanggaran = '$id'");
$nis_siswa = mysqli_query($koneksi, "SELECT NIS FROM SISWA");
$data_siswa = mysqli_query($koneksi, "SELECT nama_siswa FROM SISWA");
$jenis_pelanggaran = mysqli_query($koneksi, "SELECT jenis_pelanggaran FROM JENIS_PELANGGARAN");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>SIPS Pegawai &rsaquo; Edit Pelanggaran Siswa</title>
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
            <div class="d-sm-none d-lg-inline-block">Halo, Pegawai</div></a>
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
                Pegawai
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li data-toggle="tooltip" data-placement="right" title="" data-original-title="Halaman Utama">
              <a href="index.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
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
            <li class="active" data-toggle="tooltip" data-placement="right" data-original-title="Data Pelanggaran Siswa">
              <a href="data_pelanggaran.php"><i class="ion ion-android-alert"></i> Pelanggaran Siswa</a>
            </li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Edit Pelanggaran Siswa</div>
          </h1>
          <div class="card">
            <div class="card-primary">
              <div class="card-body">
                <form method="POST" class="needs-validation">
                  <div class="form-group">
                    <label>ID</label>
                    <h5><?php echo $data['id_pelanggaran']?></h5>
                  </div>
                  <div class="form-group">
                    <label>NIS</label>
                    <select name="nis" class="form-control">
                      <?php
                      $rows = mysqli_num_rows($nis_siswa);
                      if($rows > 0){
                        while($data_nis = mysqli_fetch_array($nis_siswa)){
                          echo "<option>".$data_nis['NIS']."</option>";
                        }
                      }else{
                        echo "<option> Tidak ada data NIS </option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="nama_siswa" class="form-control">
                      <?php
                      $rows = mysqli_num_rows($data_siswa);
                      if($rows > 0){
                        while($data_nama = mysqli_fetch_array($data_siswa)){
                          echo "<option>".$data_nama['nama_siswa']."</option>";
                        }
                      }else{
                        echo "<option> Tidak ada data siswa </option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Pelanggaran</label>
                    <select name="pelanggaran" class="form-control">
                      <?php
                      $rows = mysqli_num_rows($jenis_pelanggaran);
                      if($rows > 0){
                        while($data_jenis = mysqli_fetch_array($jenis_pelanggaran)){
                          echo "<option>".$data_jenis['jenis_pelanggaran']."</option>";
                        }
                      }else{
                        echo "<option> Tidak ada jenis pelanggaran </option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Poin</label>
                    <input type="number" value="<?php echo $data['poin']?>" class="form-control" name="poin" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" value="<?php echo $data['keterangan']?>" class="form-control" name="keterangan" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" value="<?php echo $data['tanggal']?>" class="form-control" name="tanggal" tabindex="1" required>
                  </div><br>
                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-blue" tabindex="1">
                      <i class="ion ion-android-checkbox-outline" style="margin-right: 10px"></i>
                      Simpan
                    </button>
                    <?php
                    include "../koneksi_db.php";
                    if(isset($_POST['submit'])){

                      $nis = $_POST['nis'];
                      $nama_siswa = $_POST['nama_siswa'];
                      $pelanggaran = $_POST['pelanggaran'];
                      $poin = $_POST['poin'];
                      $keterangan = $_POST['keterangan'];
                      $tanggal = date("Y-m-d", strtotime($_POST['tanggal']));

                      $simpan_data = mysqli_query($koneksi, "UPDATE PELANGGARAN_SISWA SET NIS='$nis', nama_siswa='$nama_siswa', jenis_pelanggaran='$pelanggaran', poin='$poin', keterangan='$keterangan', tanggal='$tanggal' WHERE id_pelanggaran='$id'");

                      if ($simpan_data) {
                        echo "<script>window.alert('Data berhasil disimpan!');
                        window.location.href='data_pelanggaran.php';
                        </script>";
                      }
                      else {
                        echo "<script>window.alert('Data gagal disimpan!');
                        </script>";
                      }
                    }
                    ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
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
</body>
</html>