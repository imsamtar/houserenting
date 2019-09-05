<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/jquery.js"></script>
  	<script src="bootstrap/popper.js"></script>
  	<script src="bootstrap/js/bootstrap.min.js"></script>
  	<style>
  		#header{
  			background-image: url("img/intro-bg.jpg");
  			height: 600px;
  			background-size: cover;

  		}
  		#input-group{
  			margin-top: 20vw;
  			padding: 20px;
  			border-radius: 5px;
  			background-color:rgba(61,61,41,0.5);
  		}
      #follow-target{
        background-color: #1F386E;
        color: white;
        padding-top: 10px;
      }
      .p{
        color: silver;
      }
      #btn-follow{
        padding: 5px;
        background-color:#1F386E;
        font-family: arial;
        font-size: 22px; 
        color: white;
        border: 1px solid white;
        border-radius: 5px;
        letter-spacing: 3px;

      }
      #btn-follow:hover{
        background-color: white;
        color: #1F386E;
        
      }
      #wrapper{
			background: #f6f6f6;
			padding-top: 1vw;
		}
		.container{
			min-height: 15vw;
		}
		#box{
			background-color: white;
			border-radius:10px;
			padding:2vw;
		}
		#icon{
			width: 12vw;
			display: block;
			margin: auto;
		}
		h3{
			text-align: center;
			color: #1F386E;
		}
		.btn-info{
			float: right;
		}
		#img{
			width: 100%;
		}
		#heading{
			background-image: linear-gradient(to right,#43B4EE,#3043A3);
			border-radius: 10px 10px 0px 0px;
		}
		h2{
			color: white;
			text-align: center;
		}
		table{
			margin-top: 3vw;
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
if (isset($_POST["edit"])) {
	$id=$_POST["id"];
	$sql="select * from adspost where id='$id'";
	
	$result=mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($result)>0) {
		while ($data=mysqli_fetch_assoc($result)) {
			echo"
			<div class='col-sm-7'>
			<img src='uploads/$data[image]' id='img'>
			</div>
			<div class='col-sm-1'></div>
			<div class='col-sm-4 shadow-sm' id='box'>
			<img src='img/logo.png' id='icon'>
			<h3>Update Information</h3>
			<form action='' method='post' onsubmit='validateUpdate(event)'>
			<div id='update-error' style='display:none;background:red;color:white;padding: 15px 10px;'></div>
			<input type='hidden' value='$data[id]' name='id'>
			<label>How many Bed Rooms?</label>
			<input type='number' data-req-update value='$data[room]' name='room' class='form-control' >
			<label>How many Kitchen Rooms?</label>
			<input type='number' data-req-update value='$data[kitchen]' name='kitchen' class='form-control' >
			<label>How many Bath Rooms?</label>
			<input type='number' data-req-update value='$data[bath]' name='bath' class='form-control' >
			<label>House Area in Square foot?</label>
			<input type='number' data-req-update value='$data[area]' name='area' class='form-control' >
			<label>House Rent Amount</label>
			<input type='number' data-req-update value='$data[rent]' name='rent' class='form-control' >
			<label>House Security Amount</label>
			<input type='number' data-req-update value='$data[advance]' name='advance' class='form-control' >
			<label>House Address</label>
			<input type='text' data-req-update value='$data[address]' name='address' class='form-control' >
			<br>
			<input type='submit' value='Update' name='update' class='btn btn-info' >
			</form>
			<script>
				function validateUpdate(e){
					let error = document.getElementById('update-error');
					let inputs = document.querySelectorAll('[data-req-update]');
					for(let i=0;i<inputs.length;i++){
						if(!inputs[i].value){
							e.preventDefault();
							error.innerText = (inputs[i].name=='advance'?'security amount':(inputs[i].name=='dpic'?'Document':inputs[i].name))+' can not be empty';
							error.style.display='block';
							break;
						}
					}
				}
			</script>
			</div>
			";
		}
	}
}
?>

	<table class="table">
		<tr>
			<th colspan="8" id="heading"><h2>ADS Information</h2></th>
		</tr>
		<tr>
			<th>Room</th><th>Kitchen</th><th>Bath</th><th>Area</th><th>Rent</th><th>Advance</th><th>Address</th><th>Operations</th>
		</tr>
		
	<?php
include 'connection.php';
$sql="select * from adspost";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>0) {
	while ($data=mysqli_fetch_assoc($result)) {
		echo "
		<td>$data[room]</td><td>$data[kitchen]</td><td>$data[bath]</td><td>$data[area]</td><td>$data[rent]</td><td>$data[advance]</td><td>$data[address]</td>
		<td><form action='' method='post'>
		<input type='hidden' value='$data[id]' name='id'>
		<input type='submit' name='delete' value='Delete' class='btn btn-danger btn-sm'>
		<input type='submit' name='edit' value='Edit' class='btn btn-warning btn-sm'>
		</form></td>

		";
	}
}
	?>
	</table>
</div>
</div>
</div>
<?php
include 'connection.php';
if (isset($_POST["delete"])) {
	$id=$_POST["id"];
	$sql="delete from adspost where id='$id'";
	mysqli_query($conn,$sql);
	$url="update.php";
	echo "<script>window.location.href='{$url}';</script>";
}
if (isset($_POST["update"])) {
	$id=$_POST["id"];
	$room=$_POST["room"];
    $bath=$_POST["bath"];
    $kitchen=$_POST["kitchen"];
    $area=$_POST["area"];
    $rent=$_POST["rent"];
    $advance=$_POST["advance"];
    $address=$_POST["address"];
    $sql="update adspost set room='$room',kitchen='$kitchen',bath='$bath',area='$area',rent='$rent',advance='$advance',address='$address' where id='$id'";
    if (mysqli_query($conn,$sql)) {
    	$url="update.php";
	echo "<script>window.location.href='{$url}';</script>";
    }
}
include 'footer.php';
?>
</body>
</html>