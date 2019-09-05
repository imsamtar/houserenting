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
  		#msg{
  			text-align: center;
  			background-color: #2C3034;
  			border-radius: 20px;
  			margin: 5cm 0cm 5cm 0cm;
  			color: red;
  			height: 55px;
  			
  		}
  		 #wrapper{
  			padding: 2vw 0 2vw 0;
  			background: #f6f6f6;
  		}
  		.img{
  			width: 100%;
  			border: 5px solid white;
  			height: 20vw;
  		}
  		.btn-size{
  			width: 100%;
  		}
  		.heading{
  			background-color:#2C3034;
  			color: red;
  			text-align: center;
  			border-radius: 5px;
  		}
  		.field{
  			background-color:#2C3034;
  		}
  		#bid{
  			margin-top: 1cm;
  		}
  		h2{
			color: #A1CE3E;
			text-align: center;
		}
		.table-dark{
			border-radius: 10px;
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
		<div class="row">
			<?php
			include 'connection.php';
			if (isset($_GET["id"])) {
			  	$id=$_GET["id"];
			  	$sql="select * from bidding_list where id='$id'";
			  	$result=mysqli_query($conn,$sql);
			  	if (mysqli_num_rows($result)>0) {
			  		while ($data=mysqli_fetch_assoc($result)) {
			  			$img="uploads/".$data["image"];
			  			echo "
			  			<div class='col-sm-6'><img src='$img' class='img'>
			  			</div>
			  			<div class='col-sm-6'>
			  			<h2>Bidding on Project</h2>
			<table class='table table-dark'>
			<tr>
			<td><i class='fa fa-clock-o'></i>
			</i>$data[biddingtime]</td>
			
			<td><i class='fa fa-money' aria-hidden='true'></i> Starter Amount : $data[startbid]</td>
			</tr>
			</table>
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
			<div id='error' style='display:none;background:red;color:white;padding: 15px 10px;'>Please fill the amount</div>
			  	<form action='' method='post' onsubmit='validate(event)' onclick='doument.getElementById(\"error\").style.display=\"none\"'>
			  	<input type='hidden' name='id' value='$data[id]'>
			  	<div class='input-group'>
			  	<div class='col-sm-5'></div>
			  	<input type='number' name='amount' placeholder='Bidding amount' class='form-control col-sm-4' id='amount'>&nbsp;
			  	<input type='submit' value='Bidd Now' name='bid' class='btn btn-info'>
			  	</div>
				  </form>	
				<script>
						function validate(e){
							let amnt = document.getElementById('amount');
							if(!amnt.value){
								document.getElementById('error').style.display='block';
								e.preventDefault();
							}
						}
				</script>
			</div>

			  		";
			  		}
			  		$sql1="select * from bidding where id='$id'";
			  		$result=mysqli_query($conn,$sql1);
			  		if (mysqli_num_rows($result)>0) {
			  			$data="";
			  			while ($data1=mysqli_fetch_assoc($result)) {
			  				$data=$data1;
			  			}
			  			echo "
			  			
			  			<div class='col-sm-2'></div>
			  			<div class='col-sm-8'>
			  			<br>
			  			<h2>Latest Bidd on this project</h2>
			  			<table class='table'>
			  			<tr>
			  			<th>User</th><th>Amount</th><th>Date & Time</th>
			  			</tr>
			  			<tr>
			  			<td><i class='fa fa-user' aria-hidden='true'></i> $data[user]</td>
			  			<td><i class='fa fa-money' aria-hidden='true'></i> $data[amount]</td>
			  			<td><i class='fa fa-clock-o'></i> $data[time]</td>
			  			</tr>
			  			</table>
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
			$sql="select * from bidding_list where status='received' and approve='yes'";
			$result=mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0) {
 			while ($data=mysqli_fetch_assoc($result)) {
 				$img="uploads/".$data["image"];

 				echo "
 					<div class='col-sm-4'><img src='$img' class='img'><a href='bidding.php?id=$data[id]'><button class='btn btn-info btn-size'>Bidding Details</button></a></div>


 				";
 				

 			}
 		}
 		else{

 			echo "
	<div class='container' id='msg'><h1>Bidding Products Not Available</h1></div>

	";
}
if (isset($_POST["bid"])) {
	if (isset($_SESSION["user"])) {
		$user=$_SESSION["user"];
		$id=$_POST["id"];
		$amount=$_POST["amount"];
		$time=date("d-m-y H:i:s");
		$sql="select max(amount) as amount from bidding where id=".$id.";";
		$topamount = (float)mysqli_fetch_assoc(mysqli_query($conn, $sql))['amount'];
		
		$sql="select * from bidding_list where id='$id'";
		$startamount = (float)mysqli_fetch_assoc(mysqli_query($conn, $sql))['startbid'];

		$amount = ($startamount>$topamount?$startamount:$topamount) + $amount;

		$sql="insert into bidding(id,user,amount,time)values('$id','$user','$amount','$time')";
		if (mysqli_query($conn,$sql)) {
			$url="bidding.php";
			echo "<script>window.location.href='{$url}';</script>";
		}
	}
	else{
		$url="login.php";
		echo "<script>window.location.href='{$url}';</script>";
	}
	
}
 			?>
 		
		</div>
	</div>
	</div>
<?php 
include 'footer.php';
 ?>
</body>
</html>