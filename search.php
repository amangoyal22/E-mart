<?php
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);

$books=$_POST['bk'];
$electronics=$_POST['elc'];
$sqle="select * from market where status=0 and category='electronics' and sellerid !=".$_SESSION['user_id'].";";
$sqlb="select * from market where status=0 and category='books' and sellerid !=".$_SESSION['user_id'].";";

if($_POST['ser']==1){
$query=$_POST['que'];
$sqle1="select * from electronics where e_name='$query' e_id=";
$sqlb1="select * from books where b_name='$query' b_id=";        
}

$sqle1="select * from electronics where e_id=";
$sqlb1="select * from books where b_id=";        
$pr="";

function x($s,$s1,$cat){
    $result=mysqli_query($_SESSION['con'],$s);
    if($result){
        $pri="";
        while($row=mysqli_fetch_assoc($result)){
            $productid=$row['product_id'];
            $seller=$row['sellerid'];
            $Category=$row['Category'];
            $y=$s1.$productid.";";
            //echo $y;
            $res=mysqli_query($_SESSION['con'],$y);
            while($row1=mysqli_fetch_assoc($res)){
                if($cat=="books"){
                    $id=$row1['b_id'];
                    $name=$row1['b_name'];
                    $author=$row1['b_author'];
                    $img=$row1['b_image'];
                    $desc=$row1['b_desc'];
                    if($desc=="NULL"){$desc="Description is not available";}
                    $edition=$row1['b_edition'];
                    $price=$row1['b_price'];
                    $mobile=$row1['b_mobile'];
                    if($mobile=="NULL"){$mobile="Mobile Number is not available";}
                        if($_POST['ser']){
                            $er="/".$_POST['que']."/";
                        if(preg_match($er,$name)){
                            $pri.="<li><a href='product.php?id=$id&seller=$seller&cat=$cat'><ul class='cd-item-wrapper'><li class='selected'><img src='$img' alt='Preview image' height='150px' width='150px'></li></ul></a><div class='cd-item-info'>
<b><a href='product.php?id=$id&seller=$seller&cat=$cat'>$name</a></b><em class='cd-price'>$price</em></div><div class='cd-item-button'><button><a href='product.php?id=$id&seller=$seller&cat=$cat'>BUY NOW</a></button></div></li>";
                        }
                    }
                    else{
                    $pri.="<li><a href='product.php?id=$id&seller=$seller&cat=$cat'><ul class='cd-item-wrapper'><li class='selected'><img src='$img' alt='Preview image' height='150px' width='150px'></li></ul></a><div class='cd-item-info'>
<b><a href='product.php?id=$id&seller=$seller&cat=$cat'>$name</a></b><em class='cd-price'>$price</em></div><div class='cd-item-button'><button><a href='product.php?id=$id&seller=$seller&cat=$cat'>BUY NOW</a></button></div></li>";}
                    //link has to be form
                }
                else{
                    
                    $id=$row1['e_id'];
                    $name=$row1['e_name'];
                    $img=$row1['e_image'];
                    $desc=$row1['e_desc'];
                    if($desc=="NULL"){$desc="Description is not available";}
                    $price=$row1['e_price'];
                    $mobile=$row1['e_mobile'];
                    if($mobile=="NULL"){$mobile="Mobile Number is not available";}
                    if($_POST['ser']){
                        $er="/".$_POST['que']."/";
                        if(preg_match($er,$name)){
                            $pri.="<li><a href='product.php?id=$id&seller=$seller&cat=$cat'><ul class='cd-item-wrapper'><li class='selected'><img src='$img' alt='Preview image' height='150px' width='150px'></li></ul></a><div class='cd-item-info'>
<b><a href='product.php?id=$id&seller=$seller&cat=$cat'>$name</a></b><em class='cd-price'>$price</em></div><div class='cd-item-button'><button><a href='product.php?id=$id&seller=$seller&cat=$cat'>BUY NOW</a></button></div></li>";
                        }
                    }
                    else{
                    $pri.="<li><a href='product.php?id=$id&seller=$seller&cat=$cat'><ul class='cd-item-wrapper'><li class='selected'><img src='$img' alt='Preview image' height='150px' width='150px'></li></ul></a><div class='cd-item-info'>
<b><a href='product.php?id=$id&seller=$seller&cat=$cat'>$name</a></b><em class='cd-price'>$price</em></div><div class='cd-item-button'><button><a href='product.php?id=$id&seller=$seller&cat=$cat'>BUY NOW</a></button></div></li>";
                    }
                    //link has to be form
                }
            }
     
        }
        $GLOBALS['pr'].=$pri;
        echo $pri;
        
    }
else{
        echo "No Result Found.";
    }
    
}

if($books==0 && $electronics==0){$cat="books";x($sqlb,$sqlb1,$cat);$cat="electronics";x($sqle,$sqle1,$cat);
                                if(empty($GLOBALS['pr'])){echo "No Result Found.";} }
else if($books==1){$cat="books";x($sqlb,$sqlb1,$cat);if(empty($GLOBALS['pr'])){echo "No Result Found.";}}
else if($electronics==1){$cat="electronics";x($sqle,$sqle1,$cat);if(empty($GLOBALS['pr'])){echo "No Result Found.";}}

?>