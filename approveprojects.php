<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/jquery.js"></script>
  	<script src="bootstrap/popper.js"></script>
  	<script src="bootstrap/js/bootstrap.min.js"></script>
  	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  	<style>
  		
      #wrapper{
			background: #f6f6f6;
			padding: 1vw;
		}
		h2{
			color: #A1CE3E;
			text-align: center;
		}
		.btn{
			float: right;
			margin: 5px;
		}
		.container{
			background-color: white;
		}
  	</style>
</head>
<body>
<?php
session_start();
if (isset($_GET["logout"])) {
  
  session_destroy();
  header("location:home.php");
}
if (isset($_SESSION["admin"])) {
  include 'admin.php';
}
else if(isset($_SESSION["owner"])){
  include 'owner.php';
}
include 'navigation.php';
?>
<div class="container-fluid" id="wrapper">
	<?php
	include 'connection.php';
	$sql="select * from adspost where approve='no'";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0) {
		while ($data=mysqli_fetch_assoc($result)) {
			echo "
			<div class='container shadow-sm'>
			<div class='row'>
			<div class='col-sm-8'>
			<video src='uploads/$data[image]' autoplay></video>
			</div>
			<div class='col-sm-4'>
			<h2>Renting Project Verification</h2>
			<table class='table table-striped'>
			<tr>
			<td><i class='fa fa-home' aria-hidden='true'></i> Bed Rooms</td>
			<td>$data[room]</td>
			</tr>
			<tr>
			<td><i class='fa fa-bath' aria-hidden='true'></i> Bath Rooms</td>
			<td>$data[bath]</td>
			</tr>
			<tr>
			<td><i class='fa fa-cutlery' aria-hidden='true'></i> Kitchen Rooms</td>
			<td>$data[bath]</td>
			</tr>
			</table>
			<h6><b>Description</b></h6>
			<p><i class='fa fa-area-chart' aria-hidden='true'></i> House Area &nbsp $data[area] square feet</p>
			<p><i class='fa fa-map-marker' aria-hidden='true'></i> $data[address]</p>
			<form action='' method='post'>
			<input type='hidden' value='$data[id]' name='id'>
			<input type='submit' value='Approve' name='approve' class='btn btn-success btn-sm'>
			<input type='submit' value='Delete' name='delete' class='btn btn-danger btn-sm'>
			</form>
			</div>
			</div>
    		</div>

			";
		}
	}

	//bidding products

	$sql="select * from bidding_list where approve='no'";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0) {
		while ($data=mysqli_fetch_assoc($result)) {
			echo "
			<div class='container shadow-sm'>
			<div class='row'>
			<div class='col-sm-8'>
			<video src='uploads/$data[image]' autoplay></video>
			</div>
			<div class='col-sm-4'>
			<h2>Bidding Project Verification</h2>
			<table class='table table-striped'>
			<tr>
			<td><i class='fa fa-home' aria-hidden='true'></i> Bed Rooms</td>
			<td>$data[room]</td>
			</tr>
			<tr>
			<td><i class='fa fa-bath' aria-hidden='true'></i> Bath Rooms</td>
			<td>$data[bath]</td>
			</tr>
			<tr>
			<td><i class='fa fa-cutlery' aria-hidden='true'></i> Kitchen Rooms</td>
			<td>$data[bath]</td>
			</tr>
			</table>
			<h6><b>Description</b></h6>
			<p><i class='fa fa-money' aria-hidden='true'></i>
 			Starter Amount &nbsp; $data[startbid]</p>
			<p><i class='fa fa-area-chart' aria-hidden='true'></i> House Area &nbsp $data[area] square feet</p>
			<p><i class='fa fa-map-marker' aria-hidden='true'></i> $data[address]</p>
			<form action='' method='post'>
			<input type='hidden' value='$data[id]' name='id'>
			<input type='submit' value='Approve' name='approveb' class='btn btn-success btn-sm'>
			<input type='submit' value='Delete' name='deleteb' class='btn btn-danger btn-sm'>
			</form>
			</div>
			</div>
    		</div>

			";
		}
	}
	?>
</div>
<?php
include 'connection.php';
if (isset($_POST["approve"])) {
	$id=$_POST["id"];
	$sql="update adspost set approve='yes' where id='$id'";
	if (mysqli_query($conn,$sql)) {
		$url="approveprojects.php";
	echo "<script>window.location.href='{$url}';</script>";
	}
}
if (isset($_POST["approveb"])) {
	$id=$_POST["id"];
	$sql="update bidding_list set approve='yes' where id='$id'";
	if (mysqli_query($conn,$sql)) {
		$url="approveprojects.php";
	echo "<script>window.location.href='{$url}';</script>";
	}
}
if (isset($_POST["delete"])) {
	$id=$_POST["id"];
	$sql="delete from adspost where id='$id'";
	if (mysqli_query($conn,$sql)) {
		$url="approveprojects.php";
	echo "<script>window.location.href='{$url}';</script>";
	}
}
if (isset($_POST["deleteb"])) {
	$id=$_POST["id"];
	$sql="delete from bidding_list where id='$id'";
	if (mysqli_query($conn,$sql)) {
		$url="approveprojects.php";
	echo "<script>window.location.href='{$url}';</script>";
	}
}
include 'footer.php';
?>
</body>
</html>