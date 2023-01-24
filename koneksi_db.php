<?php
$koneksi = mysqli_connect("localhost","root","");
mysqli_select_db($koneksi,"sips_db");
if (mysqli_connect_errno()) {
	echo "Connection Failed " . mysqli_connect_error;
}
?>