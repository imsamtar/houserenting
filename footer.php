<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
  	<style>
  		.footer{
  			background-color: #1F386E;
  			color: white;
  			padding-top: 10px;
  		}
  		hr{background-color: gray;}
  		#btn-follow{
  			padding: 10px;
  			background-color:#1F386E;
  			font-family: arial;
  			font-size: 22px; 
  			color: white;
  			border: 1px solid white;
  			border-radius: 5px;
  			letter-spacing: 2px;
  			transition: .5s;
  		}
  		#btn-follow:hover{
  			background-color: white;
  			color: #1F386E;
  			
  		}
  		.social-icon{
  			width: 100%;
  		}
  		#credit{
  			text-align: center;
  			color: gray;
  		}
  		.p{
  			color: silver;
  		}
  	</style>
</head>
<body>
<div class="container-fluid">
	<div class="row footer" id="toglar">
		<div class="col-sm-2"></div>
		<form action="#" class="col-sm-5" onsubmit="validateFooter(event)">
			<h2>Get in Touch</h2>
			<hr>
			<p class="p">Please fill out the form below to end we will get back to you as soon as possible</p>
			<br>
			<div id="footer-error" style="display:none;background:red;color:white;padding: 5px 10px;">Both fields are required</div>
			<div class="input-group">
			<input type="text" name="name" placeholder="Name" class="form-control" data-req-footer>&nbsp
			<input type="email" name="email" placeholder="Email" class="form-control" data-req-footer>	
			</div>
			<br><br>
			<input type="submit" name="submit" value="Follow us" id="btn-follow">
		</form>
		<div class="col-sm-1"></div>
		<div class="col-sm-2">
			<h2>Contact info</h2>
			<hr>
			<br><br>
			<h4>Address</h4>
			<p class="p">University of gujrat sialkot sub campus</p>
		
			<h4>Phone</h4>
			<p class="p">03034222054</p>
		
			<h4>Email</h4>
			<p class="p">balumian007@gmail.com</p>
		</div>
	</div>
	<script>
		function validateFooter(e){
			let error = document.getElementById('footer-error');
			let inputs = document.querySelectorAll('[data-req-footer]');
			for(let i=0;i<inputs.length;i++){
				if(!inputs[i].value){
					e.preventDefault();
					error.innerText = (inputs[i].name=='pic'?'Picture':(inputs[i].name=='dpic'?'Document':inputs[i].name))+' is required';
					error.style.display='block';
					break;
				}
			}
		}
	</script>
	<div class="row footer">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<hr>
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-1">
						<a href=""><img src="img/f.png" class="social-icon"></a>
					</div>
					<div class="col-sm-1">
						<a href=""><img src="img/t.png" class="social-icon"></a>
					</div>
					<div class="col-sm-1">
						<a href=""><img src="img/y.png" class="social-icon"></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12" id="credit">
				<p>@2019 House Renting Design by Ume Farwa | Aneeza Zunaira | Shazmina</p>
				<br>
			</div>
		</div>
</div>
</body>
</html>