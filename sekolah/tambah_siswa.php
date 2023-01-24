<?php
include "../koneksi_db.php";
session_start();
$jurusan = mysqli_query($koneksi, "SELECT nama_jurusan as jurusan FROM JURUSAN");
$kelas = mysqli_query($koneksi, "SELECT nama_kelas as kelas FROM KELAS");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>SIPS &rsaquo; Tambah Data Siswa</title>
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
            <div class="d-sm-none d-lg-inline-block">Halo, Admin</div></a>
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
              <div class="user-role"> Admin </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li data-toggle="tooltip" data-placement="right" title="" data-original-title="Halaman Utama">
              <a href="index.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>
            <li class="active" data-toggle="tooltip" data-placement="right" data-original-title="Data Siswa">
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
            <li data-toggle="tooltip" data-placement="right" data-original-title="Data Akun Pengguna">
              <a href="data_akun.php"><i class="ion ion-key"></i> Manajemen Akun</a>
            </li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Tambah Data Siswa</div>
          </h1>
          <div class="card">
            <div class="card-primary">
              <div class="card-body">
                <form method="POST" class="needs-validation">
                  <div class="form-group">
                    <label>NIS</label>
                    <input type="number" class="form-control" name="nis" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" class="form-control" name="nama_siswa" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Kelas</label>
                    <select name="nama_kelas" class="form-control">
                      <?php
                      $rows = mysqli_num_rows($kelas);
                      if($rows > 0){
                        while($data = mysqli_fetch_array($kelas)){
                          echo "<option>".$data['kelas']."</option>";
                        }
                      }else{
                        echo "<option> Tidak ada data kelas </option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jurusan</label>
                    <select name="nama_jurusan" class="form-control">
                      <?php
                      $rows = mysqli_num_rows($jurusan);
                      if($rows > 0){
                        while($data = mysqli_fetch_array($jurusan)){
                          echo "<option>".$data['jurusan']."</option>";
                        }
                      }else{
                        echo "<option> Nama jurusan tidak tersedia </option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                      <option>Perempuan</option>
                      <option>Laki-laki</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="number" class="form-control" name="no_telepon" tabindex="1" required>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label>ID Akun</label>
                    <input type="text" class="form-control" name="id_akun" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" tabindex="1" required>
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
                      $nama_kelas = $_POST['nama_kelas'];
                      $nama_jurusan = $_POST['nama_jurusan'];
                      $alamat = $_POST['alamat'];
                      $jenis_kelamin = $_POST['jenis_kelamin'];
                      $no_telepon = $_POST['no_telepon'];
                      $id_akun = $_POST['id_akun'];
                      $username = $_POST['username'];
                      $password = $_POST['password'];

                      $simpan_data = mysqli_query($koneksi, "INSERT INTO SISWA VALUES ('$nis', '$nama_siswa', '$nama_kelas', '$nama_jurusan', '$jenis_kelamin', '$alamat', '$no_telepon', '$id_akun', 0)");

                      $simpan_akun = mysqli_query($koneksi, "INSERT INTO USER VALUES ('$id_akun', '$nama_siswa', '$username', '$password', 'Siswa')");

                      if ($simpan_data && $simpan_akun) {
                        echo "<script>window.alert('Data berhasil disimpan!');
                        window.location.href='data_siswa.php';
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