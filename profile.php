<?php
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);
$fname="";
    $lname="";
    $email="";
    $password="";
$uid=$_SESSION['user_id'];
$ql="select * from user where user_id=$uid;";
//echo $ql;
$result=mysqli_query($_SESSION['con'],$ql);
while($row=mysqli_fetch_assoc($result)){
    $fname=$row['f_name'];
    $lname=$row['l_name'];
    $email=$row['email'];
    $password=$row['password'];
}


if(isset($_POST['buyhistory'])){
$sql="select * from market where sellerid=$uid;";
$result=mysqli_query($_SESSION['con'],$sql);
$prin="";
while($row=mysqli_fetch_assoc($_SESSION['con'],$result)){
    $product_id=$row['product_id'];
    $cat=$row['Category'];
    $x=substr($cat,0,1)."_id";
    $sql1='select * from '.$cat.' where '.$x.'='.$productid.';';
    $res=mysqli_query($_SESSION['con'],$sql1);
    while($row1=mysqli_fetch_assoc($_SESSION['con'],$res)){
        if($category=='books'){
    $name=$row['b_name'];
    $img=$row['b_image'];
    $price=$row['b_price'];
    $prin.="";
        }
        else{
    $name=$row['e_name'];
    $img=$row['e_image'];
    $price=$row['e_price'];
    $prin.="";
        }   
    }
}
    echo $prin;
}

if(isset($_POST['sellhistory'])){
$sql="select * from market where buyerid=$uid;";
$result=mysqli_query($_SESSION['con'],$sql);
$prin="";
while($row=mysqli_fetch_assoc($_SESSION['con'],$result)){
    $product_id=$row['product_id'];
    $cat=$row['Category'];
    $x=substr($cat,0,1)."_id";
    $sql1='select * from '.$cat.' where '.$x.'='.$productid.';';
    $res=mysqli_query($_SESSION['con'],$sql1);
    while($row1=mysqli_fetch_assoc($res)){
        if($category=='books'){
    $name=$row['b_name'];
    $img=$row['b_image'];
    $price=$row['b_price'];
    $prin.="";
        }
        else{
    $name=$row['e_name'];
    $img=$row['e_image'];
    $price=$row['e_price'];
    $prin.="";
        }   
    }
}
echo $prin;
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
	<link rel="stylesheet" href="profile.css">
</head>
<body id="body">
<header>
	<div id="mySidenav" class="main clearfix sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	    <a href="search.html">Search Product</a>
	    <a href="sell.html">Sell on E-mart</a>
		<a href="feedback.html">Feedback</a>
		<a href="#">About us</a>
		<a href="profile.php">My Account</a>
		<a href="cart.php">My Cart</a>
	</div>
	<i class="fa fa-bars bttn" onclick="openNav()" aria-hidden="true"></i>
	<h3>V-mart</h3>
	<script src="search.js"></script>
	<input type="text" id="search" placeholder="Search by name" onkeyup="search()">
	<i class="fa fa-user" aria-hidden="true" id="circle"></i>
	<h4 class="username"><?php echo $fname." ".$lname; ?></h4>
</header>
<i class="fa fa-user" aria-hidden="true" id="maincircle"></i>
<br>
        <h2 class="username2">Username: <?php echo $fname." ".$lname; ?></h2>
			<button class="cd-item-button">EDIT   <i class="fa fa-pencil" aria-hidden="true"></i></button>
<br>
        <h2 class="username2">E-mail: <?php echo $email; ?></h2>
			<button class="cd-item-button">EDIT   <i class="fa fa-pencil" aria-hidden="true"></i></button>
			<br>
			<button class="cd-item-bu">CHANGE PASSWORD  <i class="fa fa-key" aria-hidden="true"></i></button>
			<button class="cd-item-but yolo"><i class="fa fa-history" aria-hidden="true"> BUYING HISTORY</i></button>
			<button class="cd-item-but"><i class="fa fa-history" aria-hidden="true">SELLING HISTORY</i></button>
</body>
</html>