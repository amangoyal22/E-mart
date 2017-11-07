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

$boughtmoney=0;
$sql="select * from market where buyerid=$uid and status=1;";
$result=mysqli_query($_SESSION['con'],$sql);
$prin="";
while($row=mysqli_fetch_assoc($result)){
    $productid=$row['product_id'];
    $cat=$row['Category'];
    $x=substr($cat,0,1)."_id";
    $sql1='select * from '.$cat.' where '.$x.'='.$productid.';';
    $res=mysqli_query($_SESSION['con'],$sql1);
    while($row1=mysqli_fetch_assoc($res)){
        if($cat=='books'){
    $name=$row1['b_name'];
    $img=$row1['b_image'];
    $price=$row1['b_price'];
    $boughtmoney=+$price;
    $prin.="<p><b>Product:</b> $name\n <b>Price:</b> $price \n <b>Category:</b> $cat </p><hr/>";
        }
        else{
    $name=$row1['e_name'];
    $img=$row1['e_image'];
    $price=$row1['e_price'];$boughtmoney=+$price;
    $prin.="<p><b>Product:</b> $name\n <b>Price:</b> $price \n <b>Category:</b> $cat </p><hr/>";
        }   
    }
}

$bought=$prin;
$prin="";
$soldmoney=0;

$sql="select * from market where sellerid=$uid and status=1 ;";
$result=mysqli_query($_SESSION['con'],$sql);
$prin="";
while($row=mysqli_fetch_assoc($result)){
    $productid=$row['product_id'];
    $cat=$row['Category'];
    $x=substr($cat,0,1)."_id";
    $sql1='select * from '.$cat.' where '.$x.'='.$productid.';';
    $res=mysqli_query($_SESSION['con'],$sql1);
    while($row1=mysqli_fetch_assoc($res)){
        if($cat=='books'){
    $name=$row1['b_name'];
    $img=$row1['b_image'];
    $price=$row1['b_price'];
    $soldmoney=+$price;
    $prin.="<p><b>Product:</b> $name\n <b>Price:</b> $price \n <b>Category:</b> $cat </p><hr/>";
        }
        else{
    $name=$row1['e_name'];
    $img=$row1['e_image'];
    $price=$row1['e_price'];$soldmoney=+$price;
    $prin.="<p><b>Product:</b> $name\n <b>Price:</b> $price \n <b>Category:</b> $cat </p><hr/>";
        }   
    }
}
$sold=$prin;

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
		<a href="aboutus.html">About us</a>
		<a href="profile.php">My Account</a>
		<a href="cart.php">My Cart</a>
		<a href="signup.html">Logout</a>
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
			
<br>
        <h2 class="username2">E-mail: <?php echo $email; ?></h2>
<br>
        <h2 class="username2">Money Earned: <?php echo $soldmoney; ?></h2>
<br>
        <h2 class="username2">Money Spent: <?php echo $boughtmoney; ?></h2>
			
			<br>
	<div class="modal-container first">
	  <input id="modal-toggle" type="checkbox">
	  <label class="modal-btn" for="modal-toggle"><i class="fa fa-history" aria-hidden="true"> BUYING HISTORY</i></label> 
	  <label class="modal-backdrop" for="modal-toggle"></label>
	  <div class="modal-content">
		<label class="modal-close" for="modal-toggle">&#x2715;</label>
		<h2>BUYING HISTORY</h2><hr />
		<?php echo $bought;?> 
		<label class="modal-content-btn" for="modal-toggle">OK</label>   
	  </div>          
	</div> 
	
	<div class="mod-container">
	  <input id="mod-toggle" type="checkbox">
	  <label class="mod-btn" for="mod-toggle"><i class="fa fa-history" aria-hidden="true"> SELLING HISTORY</i></label> 
	  <label class="mod-backdrop" for="mod-toggle"></label>
	  <div class="mod-content">
		<label class="mod-close" for="mod-toggle">&#x2715;</label>
		<h2>SELLING HISTORY</h2><hr />
		<?php echo $sold;?>  
		<label class="mod-content-btn" for="mod-toggle">OK</label>   
	  </div>          
	</div>  	
</body>
<script>
var labelID;
$('label').click(function() {
  labelID = $(this).attr('for');
  $('#' + labelID).toggleClass('active');
}); 
</script>

</html>