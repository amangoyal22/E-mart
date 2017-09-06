<?php
include('connection.php');
if(isset($_POST['withuser']) && isset($_POST['username']) && isset($_POST['msg']) && isset($_POST['time'])){
    $cwi = $_POST['withuser'];   
    $cbw = $_POST['username'];
    $msg=$_POST['msg'];
    $time=$_POST['time'];
    $query="Select userid from user where user='".$cbw."';";
    //echo $query;
    $r=mysql_query($query);
    $count=mysql_num_rows($r);
    //echo $count;
    while($row=mysql_fetch_assoc($r))
    {
        $cbw=$row['userid'];
    }
    
    ///////////////////////////   cbw has sender id and cwi has receiver id
   // $x = $cbw."->".$cwi;
 //   echo $x;
    $query="Insert into chat values(".$cbw.",".$cwi.",'".$msg."','".$time."')";
    $r=mysql_query($query);
    $query="Select * from chat where (sender =".$cbw." and receiver = ".$cwi.")or(sender =".$cwi." and receiver = ".$cbw.") order by time;" ;
    //echo $query;
    $r=mysql_query($query);
    $c="";
    if(mysql_num_rows($r)>0){
    while($row=mysql_fetch_assoc($r))
    {   
        $sen=$row['sender'];
        $rec=$row['receiver'];
        $msg=$row['message'];
        $time=$row['time'];
        //echo $msg."dddd";
        $c.=$time."\n".$sen.":".$msg."\n";
    
    }
    }
    else{
        $c="Start Conversation now......";
        
    }
        echo $c;
    
}
?>
