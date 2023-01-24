<?php
include "../koneksi_db.php";
session_start();
$query = mysqli_query($koneksi,"SELECT * FROM JENIS_PELANGGARAN");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>SIPS &rsaquo; Jenis Pelanggaran</title>
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
            <li class="active" data-toggle="tooltip" data-placement="right" data-original-title="Data Jenis Pelanggaran">
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
            <div>Jenis Pelanggaran</div>
          </h1>
          <?php
          if($_SESSION['role'] == "Admin") { 
            echo '
            <a href="tambah_jenispelanggaran.php" class="btn btn-blue col-sm-12 col-lg-3" style="margin-bottom: 25px">
            <i class="ion ion-plus-round" style="margin-right: 10px"></i>
            Tambah Jenis Pelanggaran
            </a>';
          }
          ?>
          <div class="card">
            <div class="card-header">
              <div class="float-right">
              </div>
              <h4>Tabel Data Jenis Pelanggaran</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Jenis Pelanggaran</th>
                      <th>Poin</th>
                      <?php
                      if($_SESSION['role'] == "Admin") { 
                        echo "<th>Aksi</th>";
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($data = mysqli_fetch_array($query)){
                      $id_jenis = $data['id_jenis'];

                      echo "<tr>
                      <td>".$id_jenis."</td>
                      <td>".$data['jenis_pelanggaran']."</td>
                      <td>".$data['poin']."</td>";

                      if($_SESSION['role'] == "Admin") {
                        echo "<td>
                        <a href='edit_jenispelanggaran.php?id=$id_jenis' class='btn btn-sm btn-blue' style='margin: 5px'>
                        <span class='ion-android-create' aria-hidden='true'></span>
                        </a>
                        <a href='proses/hapus_jenispelanggaran.php?id=$id_jenis' class='btn btn-sm btn-danger' style='margin: 5px'>
                        <span class='ion-trash-a' aria-hidden='true'></span>
                        </a>
                        </td>";
                      }
                      echo "</tr>";
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