<?php
if(isset($_POST['submit'])){
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);
$_SESSION['kart']=array();
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$password=$_POST['password'];
$sql="INSERT INTO `user`(`user_id`, `f_name`, `l_name`, `email`, `password`) VALUES (NULL,'$fname','$lname','$email','$password');";
if(mysqli_query($_SESSION['con'],$sql)){
    
    $sql="select * from user where email='$email' ORDER BY user_id DESC limit 1;";
    echo $sql;
    $result=mysqli_query($_SESSION['con'],$sql);
    while($row=mysqli_fetch_assoc($result)){
      $_SESSION['user_id']=$row['user_id'];
      $_SESSION['username']=$row['f_name']." ".$row['l_name']; 
    }
    echo $_SESSION['user_id'];
    header('location:search.html');
}   
else{
    echo"<script>alert('Sorry Some error has occured.......Please try again');window.location='signup.html';</script>";
}
}
if(isset($_POST['signin'])){
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);
$email=$_POST['email'];
$password=$_POST['password'];
    $sql="select * from user where email='$email' and password='$password';";
    echo $sql;
    $result=mysqli_query($_SESSION['con'],$sql);
    if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
      $_SESSION['kart']=array();
      $_SESSION['user_id']=$row['user_id'];  
      $_SESSION['username']=$row['f_name']." ".$row['l_name'];  
    }
    echo $_SESSION['user_id'];
    echo"<script>window.location='search.html';</script>";
    }
else{
    echo"<script>alert('Sorry Some error has occured.......Please try again');window.location='signup.html';</script>";
}

}
?>