<?php
session_start();

$server="localhost";
$username="root";
$pass="";
$db="emart";
$_SESSION['con']=mysqli_connect($server,$username,$pass,$db);
$movestatus=0;
$_SESSION['userid']=1;

function filecheck($x){
    $target_dir="upload/";
	$GLOBALS['target_file'] = $target_dir .basename($_SESSION['userid']."_".$_REQUEST["name"]."_".$x["name"]);
	$GLOBALS['uploadOk']=1;
	$imageFileType=pathinfo($GLOBALS['target_file'], PATHINFO_EXTENSION);	
	if (file_exists($GLOBALS['target_file']))
	 {echo "Sorry, file already exists.";
		$GLOBALS['uploadOk'] = 0;}
		if ($x["size"] > 20000000)
		{echo "Sorry, your file is too large.";
		$GLOBALS['uploadOk'] = 0;}
		
		if($imageFileType != "jpg" && $imageFileType != "png")
		{echo "Sorry, only JPG & PNG files are allowed.";
		$GLOBALS['uploadOk'] = 0;}
}
function filemove($x){
    if ($GLOBALS['uploadOk'] == 0) {echo "<script>alert('Sorry, your file was not uploaded.');</script>";}
		else
		{
			if (move_uploaded_file($x["tmp_name"], $GLOBALS['target_file'])) 
			{
                $GLOBALS['movestatus']=1;
				echo "<script>alert('The file ". basename( $x["name"]). " has been uploaded.');</script>";
			} 
			else
			{
				echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                header('location:sell.html');
			}
        }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$userid=$_SESSION['userid'];
filecheck($_FILES["files"]);
filemove($_FILES["files"]);
$image=$GLOBALS['target_file'];
//File upload method need to be applied

$category=$_REQUEST["category"];
$name=$_REQUEST["name"];
$price=$_REQUEST["price"];
$mnumber=$_REQUEST["number"];
$description=$_REQUEST["description"];

    
if($movestatus==1){
if($category=="book"){
    $author=$_REQUEST["author"];
    $editon=$_REQUEST["edition"];
    $sql="INSERT INTO `books`(`userid`,`b_id`, `b_name`, `b_author`, `b_image`, `b_edition`, `b_desc`, `b_price`, `b_mobile`) VALUES ($userid,NULL,'".$name."','".$author."','".$GLOBALS['target_file']."','".$editon."','".$description."',".$price.",".$mnumber.");
insert into market (sellerid,product_id,category) SELECT userid, b_id,'books' from books order by books.b_id desc limit 1;";
}
else{
    $sql="INSERT INTO `electronics`(`userid`,`e_id`, `e_name`, `e_desc`, `e_mobile`,`e_image`, `e_price`) VALUES ($userid,NULL,'".$name."','".$description."',".$mnumber.",'".$GLOBALS['target_file']."',".$price.");
    insert into market (sellerid,product_id,category) SELECT userid, e_id,'electronics' from electronics order by electronics.e_id desc limit 1; 
    ";
}
if( mysqli_multi_query($_SESSION['con'],$sql)){
    echo "<script>alert('Product Is Successfully Registered.')</script>";
    header('location:search.html');
}
else{
    echo "<script>alert('Something went wrong please try again....Wait while we transfer you back....')</script>";
    header('location:sell.html');
}
}
}
?>