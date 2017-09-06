<?php 
include('connection.php');
session_start();
$username= $_SESSION['username'];
$query="Select * from user where status=1 and user !='".$username."';";
$r=mysql_query($query);
$l="";
if(mysql_num_rows($r) > 0){
    while ($row = mysql_fetch_assoc($r)) {
    $x =$row["userid"];
    $y =$row["user"];
    $z =$row["status"];
        
     $l.= "<input type='radio' name='chat' value ='user_".$x."' onclick='chat(this);'>".$y."</input><br>";
        }
}

?>        

<!DOCTYPE html>
<HTML>
       <head>
       </head>
    <body>
    Welcome<br>
    <?php
     echo $l;
    ?>
    <!--     button tak kam kam hua ab chat karo-->
        <div id="chat">
            <textarea id="all"></textarea><br>
            <input type="text" id="msg"  placeholder="write message">     
            <input type="button" onclick="chats();" value="Send" id="send">       
        </div>
      <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script type='text/javascript'>
          
          document.getElementById("all").style.visibility = "hidden";
          document.getElementById("msg").style.visibility = "hidden";
          document.getElementById("send").style.visibility = "hidden";
            //var i=0;    
function chat(ele){
            document.getElementById("all").style.visibility = "visible";
          document.getElementById("msg").style.visibility = "visible";
          document.getElementById("send").style.visibility = "visible";
           
                var x=ele.value;
                var y=x.indexOf("_");
                var length=x.length;
                var cwu=x.substr(y+1,length);
                //alert(x);
                //window.i+=1;
                $.post("chat.php",{withuser:cwu,username:"<?php echo $username ?>"},function(output){$("#all").html(output);
                    //window.location="chat.php";
                 });
    
}
function chats(ele){
    
    var today=new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
          
    var msg=document.getElementById("msg").value;
    var sender="<?php echo $username ?>";
    var receiver=$("input[type=radio]:checked").val();
    //alert(receiver);
    var y=receiver.indexOf("_");
    var length=receiver.length;
    receiver=receiver.substr(y+1,length);
    //alert(receiver);
    $.post("chats.php",{withuser:receiver,username:sender,msg:msg,time:dateTime},function(output){$("#all").html(output);
    //window.location="chats.php";
                                                                                       })
}
</script>
        <div id="ss"></div>
    </body>
</HTML>