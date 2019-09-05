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
		}
		#msg{
			text-align: center;
			color: gray;
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
		<div class="col-sm-7">
			<h2>Contact Information</h2>
			<br>
			
			<h4>Address</h4>
			<p>university of gujrat sialkot sub Campus</p>
			<h4>Phone</h4>
			<p>03034222054</p>
			<h4>Email</h4>
			<p>houserenting@yahoo.com</p>
		</div>
		<div class="col-sm-5">
			<h2>Feedback</h2>
			<br>
			<div id="error-feedback"></div>
			<form action="" method="post" onsubmit="validate(event)">
				<div class="row">
				<div class="col-sm-7">
					<input type="text" name="name" class="form-control" placeholder="Name" data-req-feed>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="email" name="email" class="form-control" placeholder="Email" data-req-feed>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="text" name="subject" class="form-control" placeholder="Subject" data-req-feed>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<textarea class="form-control" name="message" placeholder="Message" data-req-feed></textarea>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="submit" name="feedback" class="btn btn-info" value="Feedback">
				</div>
				</div>
			</form>
			<br>
		</div>
	</div>
	<script>
		function validate(e){
			let error = document.getElementById('error-feedback');
			let inputs = document.querySelectorAll('[data-req-feed]');
			for(let i=0;i<inputs.length;i++){
				if(!inputs[i].value){
					e.preventDefault();
					error.innerText = (inputs[i].name=='pic'?'Picture':(inputs[i].name=='dpic'?'Document':inputs[i].name))+' can not be empty';
					error.style.display='block';
					break;
				}
			}
		}
	</script>
</div>
</div>
<?php
include 'connection.php';
if (isset($_POST["feedback"])) {
$name=$_POST["name"];
$email=$_POST["email"];
$subject=$_POST["subject"];
$message=$_POST["message"];
$sql="insert into feedback(name,email,subject,message) values('$name','$email','$subject','$message')";
if(mysqli_query($conn,$sql)){
	 echo "<h4 id='msg'>Message send successful...!</h4>";
}
else{
	echo "error";
}
} 
include 'footer.php'; ?>
</body>
</html>