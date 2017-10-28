<?php
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);

$uid=$_SESSION['user_id'];
$sql="select * from user where user_id=$uid;"
$result=mysqli_query($_SESSION['con'],$sql);
while($row=mysqli_fetch_assoc($result)){
    $fname=$row['f_name'];
    $lname=$row['l_name'];
    $email=$row['email'];
    $password=$row['password'];
}


if(isset($_POST['buyhistory'])){
$sql="select * from market where sellerid=$uid;"
$result=mysqli_query($_SESSION['con'],$sql);
$prin="";
while($row=mysqli_fetch_assoc($result)){
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

if(isset($_POST['sellhistory'])){
$sql="select * from market where buyerid=$uid;"
$result=mysqli_query($_SESSION['con'],$sql);
$prin="";
while($row=mysqli_fetch_assoc($result)){
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