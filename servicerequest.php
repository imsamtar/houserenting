<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/jquery.js"></script>
  	<script src="bootstrap/popper.js"></script>
  	<script src="bootstrap/js/bootstrap.min.js"></script>
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
				<th colspan="7" id="heading"><h2>Service Request Record</h2></th>
			</tr>
			<tr>
				<th>Sr</th>
				<th>Service</th>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Address</th>
				<th>Operation</th>
			</tr>
			<?php
			include "connection.php";
			$sql="select * from services";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
			$count=0;
			while($data=mysqli_fetch_assoc($result)){
			$count++;
			echo"
			<tr>
				<td>$count</td>
				<td>$data[service]</td>
				<td>$data[name]</td>
				<td>$data[email]</td>
				<td>$data[contact]</td>
				<td>$data[address]</td>
				<td>
				<form action='' method='post'>
				<input type='hidden' value='$data[id]' name='id'>
				<input type='submit' value='Delete' class='btn btn-danger' name='delete'>
				</form>
				</td>
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
if (isset($_POST["delete"])) {
	$id=$_POST["id"];
	$sql="delete from services where id='$id'";
	if (mysqli_query($conn,$sql)) {
		$url="servicerequest.php";
		echo "
		<script>window.location.href='{$url}';</script>
		";
	}
}
include 'footer.php';
?>
</body>
</html>