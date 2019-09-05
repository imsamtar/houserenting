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
  			padding: 2vw 0 2vw 0;
  			background: #f6f6f6;
  		}
  		.img{
  			width: 100%;
  			border: 5px solid white;
  		}
  		.btn-size{
  			width: 100%;
  		}
  		.heading{
  			background-color:rgba(61,61,41,0.5);
  			text-align: center;
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

	include 'navigation.php'; ?>
	<div class="container-fluid" id="wrapper">
		<div class="container">
		<div class="row">
			<?php
			include 'connection.php';
			if (isset($_GET["id"])) {
			  	$id=$_GET["id"];
			  	$sql="select * from adspost where id='$id'";
			  	$result=mysqli_query($conn,$sql);
			  	if (mysqli_num_rows($result)>0) {
			  		while ($data=mysqli_fetch_assoc($result)) {
			  			$img="uploads/".$data["image"];
			  			echo "
			  			<div class='col-sm-6'><video src='$img' class='img'autoplay></video></div>
			  			<div class='col-sm-6'>
			  			<h2 class='heading'>House Details</h2>
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
			 <p><i class='fa fa-money' aria-hidden='true'></i> Rent Amount &nbsp $data[rent]</p>
			 <p><i class='fa fa-money' aria-hidden='true'></i> Security  &nbsp $data[advance]</p>
			<p><i class='fa fa-area-chart' aria-hidden='true'></i> House Area &nbsp $data[area] square feet</p>
			<p><i class='fa fa-map-marker' aria-hidden='true'></i> $data[address]</p>
			<form action='' method='post'>
			<input type='hidden' name='id' value='$data[id]'>
			<input type='submit' value='Book Now' name='book' class='btn btn-danger'>
			</form>
			  </div>
			  			
			  		";
			  		}
			  	}
			  }  
			?>
		</div>
		<br>
		<div class="row">
			 <?php
			include 'connection.php';
			$sql="select * from adspost where approve='yes'";
			$result=mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0) {
 			while ($data=mysqli_fetch_assoc($result)) {
 				$img="uploads/".$data["image"];
 				echo "
 					<div class='col-sm-4'><video src='$img' class='img'></video><a href='gallery.php?id=$data[id]'><button class='btn btn-info btn-size'>Details</button></a></div>


 				";

 			}}
 			?>
		</div>
	</div>
	</div>
<?php
include 'connection.php';
if (isset($_POST["book"])) {
	if (isset($_SESSION["user"])) {
		$id=$_POST["id"];
		$user=$_SESSION["user"];
		$sql="insert into booking(id,user) values('$id','$user')";
		mysqli_query($conn,$sql);
	}
	else {
		$url="login.php";
	echo "<script>window.location.href='{$url}';</script>";
	}
}
 include 'footer.php'; ?>
</body>
</html>