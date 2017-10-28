<?php

session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);
$productid=$_GET['id'];
$sellerid=$_GET['seller'];
$cat=$_GET['cat'];
//echo $cat;
$x=substr($cat,0,1)."_id";
$sql='select * from '.$cat.' where '.$x.'='.$productid.';';
//echo $sql;
$result=mysqli_query($_SESSION['con'],$sql);
$name="";
$desc="";
$mobile="";
$img="";
$auth="";
$edi="";
$price="";
function x(){array_push($_SESSION['kart'],array($id,$sellerid));}
while($row=mysqli_fetch_assoc($result)){
if($cat=='books'){
    $name=$row['b_name'];
    $desc=$row['b_desc'];
    $mobile=$row['b_mobile'];
    $img=$row['b_image'];
    $auth=$row['b_author'];
    $edi=$row['b_edition'];
    $price=$row['b_price'];
}
else{
    $name=$row['e_name'];
    $desc=$row['e_desc'];
    $mobile=$row['e_mobile'];
    $img=$row['e_image'];
    $price=$row['e_price'];
}
}


//echo $name;
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="search.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<link rel="stylesheet" href="product.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<header>
	<div id="mySidenav" class="main clearfix sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="search.html">Search Product</a>
	    <a href="sell.html">Sell on E-mart</a>
		<a href="#">Feedback</a>
		<a href="#">About us</a>
		<a href="profile.php">My Account</a>
		<a href="cart.php">My Cart</a>
	</div>
	<i class="fa fa-bars bttn" onclick="openNav()" aria-hidden="true"></i>
	<h4 class="username"><?php $_SESSION['username'] ?></h4>
	<h3>V-mart</h3>
	<script src="search.js"></script>
	<input type="text" id="search" placeholder="Search by name" onkeyup="search()">
</header>

<main class="container">
  <div class="left-column">
    <img data-image="red" class="active" src="<?php echo $img; ?>" alt="<?php echo $name; ?>"  style="width:450px;height:450px;">
  </div>
  <div class="right-column">
    <div class="product-description">
     <h1><?php echo $name; ?></h1>
      <span><?php if ($cat=='electronics'){echo 'Project Material';}else{echo substr($cat,0,4);} ?> </span>
      <p><?php echo $desc; ?></p>
    </div>
    <div class="product-price">
      <span>Price :: <?php echo $price; ?></span>
    </div>
	<a href="buy.php?id=<?php echo $productid ?>&seller=<?php echo $sellerid;?>&cat=<?php echo $cat;?>"><button  class="cart-btn">ADD TO CART</button></a>
	    <div class="cd-item-button">
            <a href="search.html"><button>BACK</button></a>
		</div>
  </div>
</main>
<script src="product.js"></script>
</body>
</html>