<?php include "connection.php";
session_start();
?>
<?php
//echo "hello";
if(isset($_POST['submit'])){
$username = $_POST['username'];
$password = $_POST['password'];
echo $username.$password; 
$query="Insert into user values (null,'".$username."','".$password."',1);" ;
$result = mysql_query($query);
if($result){
echo "Successfully Logged IN";
header('Location: home.php ');
$_SESSION['username']=$username;
$_SESSION['password']=$password;
$_SESSION['status']=1;
header('Location:home.php');
}
else{
echo "Something Went Wrong";
}
}



?>