<!DOCTYPE html>
<html>
<head>
	<title>house renting place</title>
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
<div class="container-fluid">
	<div class="row" id="header">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<form action="#" class="input-group" id="input-group" onsubmit="(function(event){
        if(!document.getElementById('search-text-field').value){event.preventDefault()}
      })()">
				<input type="text" name="" id="search-text-field" placeholder="Search" class="form-control">
				<input type="submit" name="search" class="btn btn-danger" value="Search">
			</form>
		</div>
	</div>
</div>
<div class="row" id="follow-target">
  <div class="col-sm-1"></div>
  <div class="col-sm-6">
    <h3>Please Fill Form and Get all lates updatest</h3>
    <p class="p">Get started today and complete our form to request your Requirments and share your ideas</p>
  </div>
  <div class="col-sm-1"></div>
  <div class="col-sm-2">
    <a href="#toglar"><button id="btn-follow">Follow Us</button></a>
  </div>
</div>
<div class="container">
    <div class="row">
      
      <div class="col-sm-6 shadow-lg"><img src="img/aboutus.jpg" width="100%"></div>
      <div class="col-sm-6" style="padding:15px;">
        <h3 style="color: #1F386E;">Why You Choose us?</h3>
        <p>We are providing you better services from others!</p>
        <br>
        <div class="row">
      <div class="col-sm-6">
              <ul class="list-style">
                <li>Years of Experience</li>
                <li>Fully Insured</li>
                <li>Cost Control Experts</li>
                <li>100% Satisfaction Guarantee</li>
              </ul>
            </div>
            <div class="col-lg-6 col-sm-6">
              <ul class="list-style">
                <li>Free Consultation</li>
                <li>Satisfied Customers</li>
                <li>Project Management</li>
                <li>Affordable Pricing</li>
              </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
<br><br>
<?php include 'footer.php'; ?>
</body>
</html>