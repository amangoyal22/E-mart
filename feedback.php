<?php
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);

$uid=$_SESSION['user_id'];
$feedback=$_SESSION['feedback'];
$sql="Insert into";
?>