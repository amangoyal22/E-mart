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
for($i=0;$i<$numberofproduct;$i++){
	$product=$kart[$i];
    //print_r($product);
	$prodid=$product['0'];
	$sellerid=$product['1'];
    
    $sql="select * from user where user_id = $sellerid;";
	$result=mysqli_query($_SESSION['con'],$sql);
    $useremail="";
    $username="";
	while($row=mysqli_fetch_assoc($result)){
        $username=$row['f_name']." ".$row['l_name'];       
        $useremail=$row['email'];       
            }
    
	$category=$product['2'];
	$col=substr($category,0,1)."_id";
    
    $sql="update market set `buyerid`=".$_SESSION['user_id'].",status=1 where `product_id` = $prodid and `Category`= '$category';";
    
    mysqli_query($_SESSION['con'],$sql);
    
	$sql="select * from $category where $col=$prodid;";
	$result=mysqli_query($_SESSION['con'],$sql);
	while($row=mysqli_fetch_assoc($result)){
		if($category=='books'){
    $name=$row['b_name'];
    $mobile=$row['b_mobile'];
    $pri=$pri."<h2>Product: $name</h2><h3>Seller Name: $username</h3><h3>Email: $useremail</h3>";
    if(strcmp($mobile,"NULL")){
        $pri=$pri."<h3>Contact Number: $mobile</h3>";
    }    
        }
        else{
    $name=$row['e_name'];
    $mobile=$row['e_mobile'];
    $pri=$pri."<h2>Product: $name</h2><h3>Seller Name:$username</h3><h3>Email:$useremail</h3>";
    if(strcmp($mobile,"NULL")){
        $pri=$pri."<h3>Contact Number: $mobile</h3>";
    }
    
        }
	}
}
$_SESSION['kart']=array();
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="success.css">
</head>
<body>
<main class="container">
	<div class="left">
		<img src="images/shopping-12-512.png"/>
	</div>
	<div class="right">
		<h1>SUCCESS!</h1>
		<h3>You just confirmed to buy <? echo $numberofproduct;?> products. You may proceed to contact them through email or contact number if provided.</h3>
		<!--Enter the userdetails he need to contact -->
		<?php echo $pri;?>
       <div class="wrapper">
			<a href="search.html" class="button"><i class="fa fa-check" aria-hidden="true"></i>OK!</a>
		</div>
    </div>
</main>
</body>
</html>