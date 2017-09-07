<?php
include('connection.php');
if(isset($_POST['withuser']) && isset($_POST['username'])){
    $cwi = $_POST['withuser'];   
    $cbw = $_POST['username'];
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
        //echo $msg."dddd";
        $c.=$sen.":".$msg."\n";
    }
    }
    else{
        $c="Start Conversation now......";
        
    }
        echo $c;
    
}
?>
