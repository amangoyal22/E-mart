<?php
session_start();

$id=$_GET['id'];
$sellerid=$_GET['seller'];
$cat=$_GET['cat'];
array_push($_SESSION['kart'],array($id,$sellerid,$cat));
echo "<script>alert('Your Product has been Successfully added in your kart....');window.location='search.html';</script>"
?>