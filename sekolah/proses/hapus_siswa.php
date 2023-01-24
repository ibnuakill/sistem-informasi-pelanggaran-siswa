<?php
include '../../koneksi_db.php';

$nis = $_GET['id'];

$hapus_data = mysqli_query($koneksi, "DELETE FROM SISWA WHERE NIS = '$nis'"); 

if ($hapus_data) {
	echo "<script>window.alert('Data berhasil dihapus!');
	window.location.href='../data_siswa.php';
	</script>";
}
else {
	echo "<script>window.alert('Data gagal dihapus!');
	</script>";
}
?>