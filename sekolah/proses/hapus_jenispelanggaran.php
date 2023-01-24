<?php
include '../../koneksi_db.php';

$id = $_GET['id'];

$hapus_data = mysqli_query($koneksi, "DELETE FROM JENIS_PELANGGARAN WHERE id_jenis = '$id'"); 

if ($hapus_data) {
	echo "<script>window.alert('Data berhasil dihapus!');
	window.location.href='../data_jenispelanggaran.php';
	</script>";
}
else {
	echo "<script>window.alert('Data gagal dihapus!');
	</script>";
}
?>