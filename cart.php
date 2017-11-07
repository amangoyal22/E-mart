<?php
session_start();
$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);
$kart=$_SESSION['kart'];
$numberofproduct=sizeof($kart);
$total=0;
$pri="";
if($numberofproduct > 0){
for($i=0;$i<$numberofproduct;$i++){
	$product=$kart[$i];
    $prodid=$product['0'];
	$sellerid=$product['1'];
	$category=$product['2'];
	$col=substr($category,0,1)."_id";
	$sql="select * from $category where $col=$prodid;";
	$result=mysqli_query($_SESSION['con'],$sql);
	while($row=mysqli_fetch_assoc($result)){
		if($category=='books'){
    $name=$row['b_name'];
    $desc=$row['b_desc'];
    $mobile=$row['b_mobile'];
    $img=$row['b_image'];
    $auth=$row['b_author'];
    $edi=$row['b_edition'];
    $price=$row['b_price'];
    $total+=$price;
    $pri=$pri."<main class='container'><div class='left-column'><img data-image='red' class='active' src='$img' alt='$name' style='width:200px;height:200px;'></div> <div class='right-column'><div class='roduct-description'><h1>$name</h1>
      </div><div class='product-price'><span>Price: $price</span></div></div></main><br>"; 
            
            
        }
        else{
    $name=$row['e_name'];
    $desc=$row['e_desc'];
    $mobile=$row['e_mobile'];
    $img=$row['e_image'];
    $price=$row['e_price'];
    $total+=$price;
     $pri=$pri."<main class='container'><div class='left-column'><img data-image='red' class='active' src='$img' alt='$name' style='width:200px;height:200px;'></div> <div class='right-column'><div class='roduct-description'><h1>$name</h1>
      </div><div class='product-price'><span>Price: $price</span></div></div></main><br>"; 
        }
	
        
	}
}
    $pri=$pri."<div class='product-price total'>
      <span>TOTAL: $total</span>
    </div>
	<button  class='cartbtn' onclick='on()'><i class='fa fa-shopping-cart' aria-hidden='true' id='carticon'></i>BUY ALL</button>
	<div id='overlay' onclick='off()'>
		<img src='images/shopping-12-512.png'/>
	</div>";
}
else{
    $pri = "<main class='container'><div class='right-column'><div class='roduct-description' style='text-align:center;'><h1 align='center'>Sorry Your Cart Is Empty</h1>
      </div></main>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>V-mart</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="search.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<link rel="stylesheet" href="cart.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
</head>
<body id="body">
<header>
	<div id="mySidenav" class="main clearfix sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	    <a href="search.html">Search Product</a>
	    <a href="sell.html">Sell on E-mart</a>
		<a href="feedback.html">Feedback</a>
		<a href="aboutus.html">About us</a>
		<a href="profile.php">My Account</a>
		<a href="cart.php">My Cart</a>
	</div>
	<i class="fa fa-bars bttn" onclick="openNav()" aria-hidden="true"></i>
	<h3>V-mart</h3>
	<script src="search.js"></script>
	<input type="text" id="search" placeholder="Search by name" onkeyup="search()">
	<i class="fa fa-user" aria-hidden="true" id="circle"></i>
	<h4 class="username" id="username"></h4>
</header>

    <?php echo $pri; ?>
	
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.min.js"></script>
<script src="cart.js"></script>
<script>
var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");

$overlay.append($image);

function on() {
    document.getElementById("overlay").style.display = "block";
    window.location.assign('success.php');
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
$.ajax({
        url: 'username.php',
        type: 'POST',
        success: function (response) {
            document.getElementById('username').innerHTML=response
        },
        error: function () {
            alert("Some Error has Occured.....");
        }
    });
</script>
</body>
</html>