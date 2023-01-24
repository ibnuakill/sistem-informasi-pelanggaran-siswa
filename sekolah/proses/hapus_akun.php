<?php
include '../../koneksi_db.php';

$id = $_GET['id'];

$hapus_data = mysqli_query($koneksi, "DELETE FROM USER WHERE id_akun = '$id'"); 

if ($hapus_data) {
	echo "<script>window.alert('Data berhasil dihapus!');
	window.location.href='../data_akun.php';
	</script>";
}
else {
	echo "<script>window.alert('Data gagal dihapus!');
	</script>";
}
?>