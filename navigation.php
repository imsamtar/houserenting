<!DOCTYPE html>
<html>
<head>
	<title></title>	
	
  	<style>
     .nav-link{
      color: #1F386E;
      font-size: 18px;
      font-family: arial;
      letter-spacing: 1px;
     } 
     .nav-item{
      margin-right: 5px;
      text-align: center;
     }
     .nav-link:hover{
      color: red;
     }
     #tollgar{
      width: 50px;
     }
     #logo{
      width: 250px;
      height: 50px;
      margin-right: 50px;
     }
     .navbar-toggler{
      border: 2px solid black;
     }
     .dropdown-menu{
      background-color:silver; 
     }
    </style>
  	
</head>
<body>
<div class="container-fluid">
  <div class="row shadow-lg">
    <div class="col-sm-12">
      <nav class="navbar navbar-expand-xl">
    <a class="navbar-brand" href="home.php"><img src="img/logo.png" id="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <img src="img/tollgar.png" id="tollgar">
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="gallery.php">Gallery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="services.php">Services</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="bidding.php">Bidding</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="contactus.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About Us</a>
      </li>  
      <?php
        $logout="true";
        if (isset($_SESSION["login"])) {
          echo "

        <li class='nav-item'><a href='home.php?logout=$logout' class='nav-link'>Log out</a></li>
                      ";
        }
        else{
          echo "<li class='nav-item'><a href='login.php' class='nav-link'>Log in</a></li>";
        }


        ?>             
    </ul>
  </div>  
</nav>
    </div>
  </div>
</div>
</body>
</html>