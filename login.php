<?php
include 'connection.php';
if (isset($_POST["login"])) {
session_start();
$type=$_POST["type"];
$email=$_POST["email"];
$pass=$_POST["pass"];
if ($email=="admin@gmail.com" && $pass=="123456") {
	$_SESSION["admin"]=true;
	$_SESSION["login"]=true;
	$url="home.php";
	header("location:home.php");
}
else{
	$sql="select * from signup where email='$email' and password='$pass'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>0) {

	$data=mysqli_fetch_assoc($result);
	if($type=="owner"){
	$_SESSION["login"]=true;
	$_SESSION["owner"]=$data["email"];
	header("location:home.php");
	}
	else if ($type=="customer") {
	$_SESSION["login"]=true;
	$_SESSION["user"]=$data["email"];
	header("location:home.php");
	}
	else{
		$url="login.php";
		echo"
		<script>window.location.href='{$url}';</script>
		";
	}
	
}


}	}

?>
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
  		#form{
  			margin-top: 5vw;
  		}
  		#login-head{
  			background-color:rgba(214,214,194,0.3);
  			border-radius: 10px;
  			padding: 7px 0px 1px 2px;
  		}
  		#login-head-icon{
  			border-right: 1px solid gray;
  			padding-right: 5px;
  		}
  		span{
  			color: red;
  		}
  		#error{
  			color: red;
  			text-align: center;
  			display: none;
  		}
  	</style>
  	
</head>
<body>
<?php include 'navigation.php'; ?>
<div class="container-fluid">
	<div class="row" id="header">
		
		<div class="col-sm-4"></div>
		<div class="col-sm-4" id="form">
			<h6 id="error">Please enter correct username or password</h6>
			<div id="login-head">
				<h2 style="color: white;"><img src="img/login.png" width="50" id="login-head-icon">&nbsp Login</h2>
			</div>
			<br>
			<form id="login-form" action="#" method="post" name="form" onsubmit="validate(event)">
			<div class="radio">
				<label><input type="radio" name="type" value="owner"> Owner &nbsp; </label>
				<label><input type="radio" name="type" value="customer"> Customer </label>
			</div>
			<input type="email" name="email" class="form-control" placeholder="Email" id="user" ><br>
			<input type="password" name="pass" class="form-control" placeholder="password" minlength="6" maxlength="30">
			<p><a href="signup.php" style="color: green">create an account</a></p>
			<input type="submit" name="login" class="btn btn-info" value="Log in">
			</form>
		</div>
	</div>
	<script>
		function validate(e){
			let error = document.getElementById('error');
			let loginForm = document.getElementById('login-form');
			let ownerRadioBtn = loginForm.querySelector('input[value="owner"]');
			let customerRadioBtn = loginForm.querySelector('input[value="customer"]');
			let email = loginForm.querySelector('input[type="email"]');
			let password = loginForm.querySelector('input[type="password"]');
			if(ownerRadioBtn.checked || customerRadioBtn.checked){
				if(!email.value || !password.value){
					error.innerText = 'Email and Password fields can not be empty';
					error.style.display='block';
					e.preventDefault();
				}
			}else{
				error.innerText = 'Please choose one from Owner or Customer';
				error.style.display='block';
				e.preventDefault();
			}
		}
	</script>
</div>
<?php
 include 'footer.php'; 
 ?>
</body>
</html>