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
			padding-top: 1vw;
			background: #f6f6f6;
		}
		#bid{
			
		}
  	</style>
</head>
<body>	
	<?php 
	include 'navigation.php';
	session_start();
	if (!isset($_SESSION["login"])) {
		header("location:login.php");
	}
	 
	?>
<div class="container-fluid" id="wrapper">
	<div class="container">
		<div class="row">
		<div class="col-sm-6 shadow-sm">
			
		</div>
		
		<!-- Bidding Form Details  -->
				<div class="col-sm-6 shadow-sm">
			<form action="" method="post" enctype="multipart/form-data">
			<h2>Post your House for Rent</h2>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<label>House Pic</label>
					<input type="file" name="pic" class="form-control-file border" required>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<label>House Documents</label>
					<input type="file" name="dpic" class="form-control-file border" required>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<input type="number" name="advance" class="form-control" placeholder="Enter Starter Amount" required>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-10">
					<div class="input-group">
						<input type="number" name="room" class="form-control" placeholder="How many Bed Rooms?" required>&nbsp;
						<input type="number" name="kitchen" class="form-control" placeholder="How many Kitchen Rooms?" required>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-10">
					
					<div class="input-group">
						<input type="number" name="bath" class="form-control" placeholder="How many Bath Rooms?" required>&nbsp;
						<input type="number" name="area" class="form-control" placeholder="House Area square Foot?" required>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-10">
					<textarea class="form-control" placeholder="House Location..." name="address" required></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-8">
					<input type="reset" name="" class="btn btn-danger" value="Clear">
					<input type="submit" name="adpost" class="btn btn-info" value="Upload">
				</div>
			</div>
			<br><br>
		</div>
		</form>
	</div>
	</div>
</div>
<?php
include 'connection.php';
if (isset($_POST["adpost"])) {
	$f_name=basename($_FILES["pic"]["name"]);
    $f_tmp=$_FILES["pic"]["tmp_name"];
    $f_extension=explode('.',$f_name);
    $f_extension=strtolower(end($f_extension));
    $f_new=uniqid().'.'.$f_extension;
    $store="uploads/".$f_new;
    $f_dname=basename($_FILES["dpic"]["name"]);
    $f_dtmp=$_FILES["dpic"]["tmp_name"];
    $f_dextension=explode('.',$f_dname);
    $f_dextension=strtolower(end($f_dextension));
    $f_dnew=uniqid().'.'.$f_dextension;
    $dstore="uploads/".$f_dnew;
    $rent=$_POST["rent"];
    $advance=$_POST["advance"];
    $address=$_POST["address"];
    $sql="insert into adspost(rent,advance,address,image)
    values('$rent','$advance','$address','$f_new')";
    if (mysqli_query($conn,$sql)){
    	if (move_uploaded_file($f_tmp,$store) && move_uploaded_file($f_dtmp,$dstore)) {
    		echo "<h2>ADS POST SUCCESSFUL</h2>";
    	}
    	else{
    		echo "<h2>storage Error</h2>";
    	}
    }
    else{
    	echo "<h2>Query error</h2>";
    }  
}
/* 

Bidding script Details

 */
if (isset($_POST["bidnow"])) {
	$f_name=basename($_FILES["pic"]["name"]);
    $f_tmp=$_FILES["pic"]["tmp_name"];
    $f_extension=explode('.',$f_name);
    $f_extension=strtolower(end($f_extension));
    $f_new=uniqid().'.'.$f_extension;
    $store="uploads/".$f_new;
    $f_dname=basename($_FILES["dpic"]["name"]);
    $f_dtmp=$_FILES["dpic"]["tmp_name"];
    $f_dextension=explode('.',$f_dname);
    $f_dextension=strtolower(end($f_dextension));
    $f_dnew=uniqid().'.'.$f_dextension;
    $dstore="uploads/".$f_dnew;
    $bamount=$_POST["bamount"];
    $etime=$_POST["etime"];
    $address=$_POST["address"];
    $time=date("d-m-y H:i:s");
    $sql="insert into bidding_list(biddingamount,expirytime,address,house_image,document_image,biddingtime)
    values('$bamount','$etime','$address','$f_new','$f_dnew','$time')";
    if (mysqli_query($conn,$sql)){
    	if (move_uploaded_file($f_tmp,$store) && move_uploaded_file($f_dtmp,$dstore)) {
    		echo "<h2>ADS POST SUCCESSFUL</h2>";
    	}
    	else{
    		echo "<h2>storage Error</h2>";
    	}
    }
    else{
    	echo "<h2>Query error</h2>";
    }  
}

 include 'footer.php'; ?>
</body>
</html>