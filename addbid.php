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
		<div class="col-sm-6 shadow-sm">
			
		</div>

		<!-- Bidding Form Details  -->
			<div class="col-sm-6 shadow-sm">
			<div id="error" style="display:none;background:red;color:white;padding: 15px 10px;"></div>
			<form action="" method="post" enctype="multipart/form-data" onsubmit="validate(event)">
			<h2>Post your House for Rent</h2>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<label>House Pic</label>
					<input type="file" name="pic" id="image" class="form-control-file border" accept="image/jpeg,image/x-png" data-req>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<label>House Documents</label>
					<input type="file" name="dpic" id="doc" class="form-control-file border" accept=".pdf,.docx,doc,.txt" data-req>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<input type="number" name="amount" class="form-control" placeholder="Enter Starter Amount" data-req>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-10">
					<div class="input-group">
						<input type="number" name="room" class="form-control" placeholder="How many Bed Rooms?" data-req>&nbsp;
						<input type="number" name="kitchen" class="form-control" placeholder="How many Kitchen Rooms?" data-req>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-10">
					
					<div class="input-group">
						<input type="number" name="bath" class="form-control" placeholder="How many Bath Rooms?" data-req>&nbsp;
						<input type="number" name="area" class="form-control" placeholder="House Area square Foot?" data-req>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-10">
					<textarea class="form-control" placeholder="House Location..." name="address" data-req></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-8">
					<input type="reset" name="" class="btn btn-danger" value="Clear">
					<input type="submit" name="bidnow" class="btn btn-info" value="Upload Bidd">
				</div>
			</div>
			<br><br>
		</div>
		</form>
	</div>
	</div>
	<script>
		function validate(e){
			let error = document.getElementById('error');
			let inputs = document.querySelectorAll('[data-req]');
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
<?php
include 'connection.php';

if (isset($_POST["bidnow"])) {
	$owner=$_SESSION["owner"];
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
    $amount=$_POST["amount"];
    $room=$_POST["room"];
    $bath=$_POST["bath"];
    $kitchen=$_POST["kitchen"];
    $area=$_POST["area"];
    $address=$_POST["address"];
    $time=date("d-m-y H:i:s");
    $sql="insert into bidding_list(room,kitchen,bath,area,approve,startbid,address,image,document,biddingtime,owner) values('$room','$kitchen','$bath','$area','no','$amount','$address','$f_new','$f_dnew','$time','$owner')";
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
<script>
	let pic = document.querySelector('input#image');
	let dpic = document.querySelector('input#doc');
	pic.addEventListener('change', function(e){
		let path = e.target.value.toLocaleLowerCase().split('.');
		if(path[path.length-1]!=='jpg' && path[path.length-1]!=='jpeg' && path[path.length-1]!=='png'){
			alert('Only images are allowed');
			e.target.value = '';
		}
	});
	dpic.addEventListener('change', function(e){
		let path = e.target.value.toLocaleLowerCase().split('.');
		if(path[path.length-1]!=='pdf' && path[path.length-1]!=='docx' && path[path.length-1]!=='doc' && path[path.length-1]!=='txt'){
			alert('Only documents are allowed');
			e.target.value = '';
		}
	});
 </script>
</body>
</html>