<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
	<title>SIPS &rsaquo; Dashboard</title>
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
	<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header("Location:login.php");
	}
	?>
	<?php
	include "dashboard.php";
	?>
</body>
</html>