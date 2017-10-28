<?php
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
    $sq="select * from user where user_id=$sellerid;";
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
      </div><div class='product-price'><span>Price: $price</span></div>
	<a href='#'><button  class='cart-btn'>BUY NOW</button></a><div class='cd-item-button'><button>REMOVE</button></div></div></main><br>"; 
            
            
        }
        else{
    $name=$row['e_name'];
    $desc=$row['e_desc'];
    $mobile=$row['e_mobile'];
    $img=$row['e_image'];
    $price=$row['e_price'];
    $total+=$price;
     $pri=$pri."<main class='container'><div class='left-column'><img data-image='red' class='active' src='$img' alt='$name' style='width:200px;height:200px;'></div> <div class='right-column'><div class='roduct-description'><h1>$name</h1>
      </div><div class='product-price'><span>Price: $price</span></div>
	<a href='#'><button  class='cart-btn'>BUY NOW</button></a><div class='cd-item-button'><button>REMOVE</button></div></div></main><br>"; 
        }
	
        
	}
}






?>