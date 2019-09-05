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
		
		.container{
			background-color: white;
			border-radius: 5px;
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
	
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<a href="addbid.php"><button class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> ADD Bidd</button></a>
			</div>
		</div>
	<br>
	<?php
	include 'connection.php';
	$sql="select * from adspost where approve='yes'";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0) {
		while ($data=mysqli_fetch_assoc($result)) {
			echo "
			<div class='container shadow-sm'>
			<div class='row'>
			<div class='col-sm-8'>
			<video src='uploads/$data[image]'>
			</div>
			<div class='col-sm-4'>
			<h2>Apply Bidd on Project</h2>
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
			<br>
			<form action='' method='post'>
			<input type='hidden' value='$data[id]' name='id'>
			<div class='input-group'>
			<input type='number' name='amount' placeholder='Starter Amount for Bidd' class='form-control' required>
			<input type='submit' value='Apply Bid' name='bidd' class='btn btn-success btn-sm'>
			</div>
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
if (isset($_POST["bidd"])) {
	$id=$_POST["id"];
	$amount=$_POST["amount"];
	$owner=$_SESSION["owner"];
	$time=date("d-m-y H:i:s");
	$sql="select * from adspost where id='$id'";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0) {
		$data=mysqli_fetch_assoc($result);
		$sql1="insert into bidding_list(room,kitchen,bath,area,approve,startbid,address,image,document,biddingtime,owner) values('$data[room]','$data[kitchen]','$data[bath]','$data[area]','no','$amount','$data[address]','$data[image]','$data[document]','$time','$owner')";
		if (mysqli_query($conn,$sql1)) {
		$sql3="delete from adspost where id='$id'";
		mysqli_query($conn,$sql3);
		$url="bid.php";
	echo "<script>window.location.href='{$url}';</script>";
		}
	
		
	}
	
}

include 'footer.php';
?>
</body>
</html>