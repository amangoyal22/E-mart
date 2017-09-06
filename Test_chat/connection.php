<?php
$ser="localhost";
$user="root";
$pass="";
$con=@mysql_connect($ser,$user,$pass);
$db=mysql_select_db("test_chat",$con);
?>