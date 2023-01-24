<?php
include("../../koneksi_db.php");
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($koneksi, "SELECT * FROM user 
	WHERE username = '$username' AND password = '$password'") 
		or die(mysqli_error());
$data = mysqli_fetch_array($query);
$rows = mysqli_num_rows($query);
if($rows > 0){
	$_SESSION['id_akun'] = $data['id_akun'];
	$_SESSION['nama_pengguna'] = $data['nama_pengguna'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['role'] = $data['role'];
	header("Location:../index.php");
}
else { ?>
	<script type="text/javascript">
		alert("Username atau Password Anda Salah!");
		window.location='../login.php';
	</script>
	<?php
}