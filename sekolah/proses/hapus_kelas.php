<?php
include '../../koneksi_db.php';

$id = $_GET['id'];

$hapus_data = mysqli_query($koneksi, "DELETE FROM KELAS WHERE id_kelas = '$id'"); 

if ($hapus_data) {
	echo "<script>window.alert('Data berhasil dihapus!');
	window.location.href='../data_kelas.php';
	</script>";
}
else {
	echo "<script>window.alert('Data gagal dihapus!');
	</script>";
}
?>