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
			padding-top: 1vw;
			padding-bottom: 2vw;
		}
		#heading{
			background-image: linear-gradient(to right,#43B4EE,#3043A3);
			border-radius: 10px 10px 0px 0px;
		}
		h2{
			color: white;
			text-align: center;
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
	<div class="container">
		<table class="table">
			<tr>
				<th colspan="6" id="heading"><h2>Close Bidding Projects</h2></th>
			</tr>
			<tr>
				<th>ID</th>
				<th>Address</th>
				<th>Owner</th>
				<th>Total Bids</th>
				<th>Status</th>
				<th>Operation</th>
			</tr>
			<?php
			include "connection.php";
			$sql="select * from bidding_list where status='received'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
			while($data=mysqli_fetch_assoc($result)){
			$tbid=0;
			$sql1="select * from bidding where id='$data[id]'";
			$result1=mysqli_query($conn,$sql1);
			if (mysqli_num_rows($result1)>0) {
				
				while ($data1=mysqli_fetch_assoc($result1)) {
					$tbid++;
				}
			}
			echo"
			<tr>
				<td>$data[id]</td>
				<td>$data[address]</td>
				<td>$data[owner]</td>
				<td> <i class='fa fa-gavel' aria-hidden='true'></i> $tbid</td>
				<td>$data[status]</td>
				<form action='' method='post'>
				<input type='hidden' value='$data[id]' name='id'>
				<td><input type='submit' value='Close Bidd' name='close' class='btn btn-danger btn-sm'></td>
				</form>
			</tr>
			";
		}
		}
			?>
		</table>
	</div>
</div>

<?php
include 'connection.php';
if (isset($_POST["close"])) {
	$id=$_POST["id"];
	$sql="update bidding_list set status='won' where id='$id'";
	if (mysqli_query($conn,$sql)) {
		$url="closebid.php";
	echo "<script>window.location.href='{$url}';</script>";
	}
}
include 'footer.php';
?>
</body>
</html>