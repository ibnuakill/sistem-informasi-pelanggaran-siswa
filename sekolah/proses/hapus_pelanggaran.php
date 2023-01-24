<?php
include '../../koneksi_db.php';

$id = $_GET['id'];

$hapus_data = mysqli_query($koneksi, "DELETE FROM PELANGGARAN_SISWA WHERE id_pelanggaran = '$id'"); 

if ($hapus_data) {
	echo "<script>window.alert('Data berhasil dihapus!');
	window.location.href='../data_pelanggaran.php';
	</script>";
}
else {
	echo "<script>window.alert('Data gagal dihapus!');
	</script>";
}
?>