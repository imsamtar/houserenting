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
		<div class="row">
			<?php
		if (isset($_POST["reply"])) {
			$email=$_POST["email"];
			echo "
			<br>
			<div class='col-sm-4'></div>
			<div class='col-sm-4'>
			<h2>Reply of Feedbacks</h2>
			<form action='PHPMail/feedbackReply.php' method='post'>
			<textarea rows='5' name='msg' placeholder='Message...' class='form-control'></textarea>
			<input type='hidden' name='email' value='$email'><br>
			<input type='submit' name='send' value='send' class='btn btn-info'>
			</form>
			</div>
			<br>
			";
		}
		?>
		</div>
		<br>
		<table class="table">
			<tr>
				<th colspan="6" id="heading"><h2>Feedbacks Record</h2></th>
			</tr>
			<tr>
				<th>Sr</th>
				<th>Name</th>
				<th>Email</th>
				<th>Subject</th>
				<th>Message</th>
				<th>Operation</th>
			</tr>
			<?php
			include "connection.php";
			$sql="select * from feedback";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
			$count=0;
			while($data=mysqli_fetch_assoc($result)){
				$count++;
				echo"
				<tr>
					<td>$count</td>
					<td>$data[name]</td>
					<td>$data[email]</td>
					<td>$data[subject]</td>
					<td>$data[message]</td>
					<td>
					<form action='' method='post'>
					<input type='hidden' name='email' value='$data[email]'>
					<input type='submit' name='reply' value='Reply' class='btn btn-info'>
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

include 'footer.php';
?>
</body>
</html>