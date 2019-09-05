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
		.list-style{
			list-style-image:url("img/list.png");
			line-height: 30px
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
</div>
<?php include 'footer.php'; ?>
</body>
</html>