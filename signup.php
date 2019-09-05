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
  			margin-top: 1vh;
  		}
  		#login-head{
  			background-color:rgba(214,214,194,0.3);
  			border-radius: 10px;
  			padding: 7px 0px 1px 3px;
  		}
  		#login-head-icon{
  			border-right: 1px solid gray;
  			padding-right: 5px;
  		}
		#error-msg {
			margin: 0;
			top: 100px;
			background: red;
			color: white;
			padding: 10px 15px;
			border-radius: 3px;
			display: none;
			z-index: 100;
		}
  	</style>
	<script>
		function showMsg(msg){
			let errorElement = document.querySelector('#error-msg');
			errorElement.innerHTML = msg;
			if(!msg){
				errorElement.style.display='none';
			}
			else {
				errorElement.style.display='block';
			}
		}
		function checkEmail(){
			let emailElement = document.querySelector('input[name=email]');
			let submitElement = document.querySelector('input[type=submit][name=signup]');
			let val = emailElement.value.split('@');
			let valid = (val.length==2 && val[1]!='');
			if(!val[0]){
				showMsg('');
				submitElement.disabled = false;
			}
			else if(valid){
				fetch('emailAlreadyUsed.php?email='+val.join('@'))
				.then(res => res.json())
				.then(alreadyUsed => {
					if(alreadyUsed){
						showMsg('An account with this email is alraedy registered!');
						valid=false;
						submitElement.disabled = true;
					}
					else {
						showMsg('');
						submitElement.disabled = false;
					}
				})
				.catch(console.error);
			}
			else {
				showMsg('');
				submitElement.disabled = true;
			}
			return valid;
		}
	</script>
</head>
<body>
<?php include 'navigation.php'; ?>
<div class="container-fluid">
	<div class="row" id="header">
		<div class="col-sm-4"></div>
		<div class="col-sm-4" id="form">
			<div id="error-msg"></div>
			<div id="login-head">
				<h2 style="color: white;"><img src="img/signup.png" width="50" id="login-head-icon">&nbsp create your account</h2>
			</div>
			<br>
			<form action="" method="post" id="signup-form" onsubmit="validate(event)">
				<div class="radio">
					<label><input type="radio" name="type" value="owner"> Owner &nbsp; </label>
					<label><input type="radio" name="type" value="customer"> Customer </label>
				</div>
				<div class="input-group">
					<input type="text" name="f-name" class="form-control" placeholder="First Name">&nbsp
					<input type="text" name="l-name" class="form-control" placeholder="Last Name">
				</div>
				<br>
				<input type="tel" name="contact" class="form-control" placeholder="Contact No" pattern="^[+]?[0-9]{11,12}$"><br>
				<input type="email" name="email" class="form-control" placeholder="Email" onkeyup="checkEmail()"><br>
				<input type="password" name="pass" class="form-control" placeholder="password" minlength="6" maxlength="30"><br>
				<input type="date" name="dob" class="form-control">
				<br>
				<div class="radio">
				<label><input type="radio" name="gender" value="male" checked> Male &nbsp; </label>
				
				<label><input type="radio" name="gender" value="female"> Female </label>
				</div>
				<p><a href="login.php" style="color: yellow;">login your account</a></p>
				<input type="submit" name="signup" class="btn btn-info" value="Sign up">
			</form>

		</div>
	</div>
	<script>
		function displayErrorMsg(msg, e){
			let error = document.getElementById('error-msg');
			let signupForm = document.getElementById('signup-form');
			error.innerText = msg
			error.style.display='block';
			e.preventDefault();
			signupForm.onclick=function(){error.style.display='none';}
		}
		function validate(e){
			let signupForm = document.getElementById('signup-form');
			let ownerRadioBtn = signupForm.querySelector('input[value="owner"]');
			let customerRadioBtn = signupForm.querySelector('input[value="customer"]');
			let fname = signupForm.querySelector('input[name="f-name"]');
			let lname = signupForm.querySelector('input[name="l-name"]');
			let email = signupForm.querySelector('input[type="email"]');
			let password = signupForm.querySelector('input[type="password"]');
			let contact = signupForm.querySelector('input[type="tel"]');
			let date = signupForm.querySelector('input[type="date"]');
			

			console.log(signupForm, ownerRadioBtn, customerRadioBtn, email, password, contact, date, date.value);

			if(ownerRadioBtn.checked || customerRadioBtn.checked){
				if(!fname.value || !lname.value){
					displayErrorMsg('FirstName and LastName are required',e);
				}
				else if(!contact.value){
					displayErrorMsg('Contact no is required',e);
				}
				else if(!email.value || !password.value){
					displayErrorMsg('Email and Password fields can not be empty',e);
				}
				else if(!date.value){
					displayErrorMsg('Date of birth is required',e);
				}
			}else{
				displayErrorMsg('Please choose one from Owner or Customer',e);
			}
		}
	</script>
</div>

<?php 
include 'connection.php';
if (isset($_POST["signup"])) {
$f_name=$_POST["f-name"];
$l_name=$_POST["l-name"];
$email=$_POST["email"];
$pass=$_POST["pass"];
$gender=$_POST["gender"];
$type=$_POST["type"];
$contact=$_POST["contact"];
$sql="insert into signup(type,fname,lname,contactno,email,password,gender) values('$type','$f_name','$l_name','$contact','$email','$pass',
'$gender')";
if (mysqli_query($conn,$sql)) {
	// header("location: login.php"); Shows error so i replaced it with script below
?>
	<script>
		window.location = 'login.php';
	</script>
<?php
}
else{
	echo "<h1>Error</h1>";
}
}


include 'footer.php';
 ?>
</body>
</html>