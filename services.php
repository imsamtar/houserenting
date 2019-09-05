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
  		}
  		.size{
  			width: 30%
  		}
  		.list-style{
			list-style-image:url("img/list.png");
			line-height: 30px
		}
		#error{
			color: red;
			
		}
  	</style>
  	<script>
  		function validate(){
  			var service=document.getElementById('service').value;
  			var name= document.forms["form"]["name"].value;
  			var email=document.forms["form"]["email"].value;
  			var contact=document.forms["form"]["contact"].value;
  			var address=document.forms["form"]["address"].value;

  			if (service=="") {
  				document.getElementById('error').innerHTML="Please choose service";
  				return false;
  			}
  			else if(name==""){
  				document.getElementById('error').innerHTML="Please Enter Name";
  				return false;
  			}
  			else if(email==""){
  				document.getElementById('error').innerHTML="Please Enter Email";
  				return false;
  			}
  			else if(contact==""){
  				document.getElementById('error').innerHTML="Please Enter Contact No";
  				return false;
  			}
  			else if(address==""){
  				document.getElementById('error').innerHTML="Please Enter Address";
  				return false;
  			}
  			else{
  				return true;
  			}
  		}
  	</script>
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
	<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/slide1.jpg" alt="Los Angeles" width="100%" height="550">
      <div class="carousel-caption">
        <h3>House Renting</h3>
        <p>thank you</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/slide2.jpg" alt="Chicago" width="100%" height="550">
      <div class="carousel-caption">
        <h3>House Cleaning</h3>
        <p>Thank you</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/slide3.jpg" alt="New York" width="100%" height="550">
      <div class="carousel-caption">
        <h3>Cargo Service</h3>
        <p>Thank you!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/slide4.jpg" alt="New York" width="100%" height="550">
      <div class="carousel-caption">
        <h3>Kitchen Remodule</h3>
        <p>Thank you!</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div class="container" >
	<div class="row">
		<div class="col-sm-7">
			<h2>Services Information</h2>
			<br>
			
			<h4>Fill form to get our services</h4>
			<p>When you fill form we will provide over service!</p>
			<br>
			<ul class="list-style">
                <li>Movers/Cargo</li>
                <li>House Cleaning</li>
                <li>Furnish your House</li>
                <li>Setting your Home</li>
                <li>Electricity Connection</li>
                <li>Kitchen Module</li>
              </ul>
		</div>
		<div class="col-sm-5">
			<h2>Service Request Form</h2>
			<br>
			<span id="error-services"></span>
			<br>
			<form action="PHPmail/servicesEmail.php" method="post" name="form" onsubmit="validate(event)">
				<div class="row">
				<div class="col-sm-7">
					
					<select class="form-control" name="service" id="service" data-req-service>
						<option value="">Choose Service</option>
						<option value="cargo">Movers/Cargo</option>
						<option value="cleaning">House Cleaning</option>
					</select>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="text" name="name" class="form-control" placeholder="Name" data-req-service>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="email" name="email" class="form-control" placeholder="Email" data-req-service>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="text" name="contact" class="form-control" placeholder="Contact No" data-req-service>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<textarea class="form-control" name="address" placeholder="Address" data-req-service></textarea>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-7">
					<input type="submit" name="request" class="btn btn-info" value="Request">
				</div>
				</div>
			</form>
			<br>
		</div>
	</div>
  <script>
    function validate(e){
      let error = document.getElementById('error-services');
      let inputs = document.querySelectorAll('[data-req-service]');
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
if (isset($_POST["request"])) {
$service=$_POST["service"];
$name=$_POST["name"];
$email=$_POST["email"];
$contact=$_POST["contact"];
$address=$_POST["address"];
$sql="insert into services(service,name,email,contact,address) values('$service','$name','$email','$contact','$address')";
if(mysqli_query($conn,$sql)){
	 echo "<h4 id='msg'>Request send successful...!</h4>";
}
}
 include 'footer.php';
  ?>
</body>
</html>