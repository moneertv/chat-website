<?php 
session_start();
$title = 'home';
include 'includes/functions/function.php';
include 'connect.php';
if(isset($_SESSION['userName']))
{
    echo $_SESSION['userName'];    
    echo $_SESSION['id'];
    echo $_SESSION['userName'];
    echo $_SESSION['email'];    
    echo $_SESSION['img_type'];
    echo $_SESSION['online'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title><?php getTitle() ?></title>    
    <link rel="stylesheet" href="layout/css/chatplace.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="inner">
            <div class="sidebar">
                <div id="friends">  
                    <?php include 'friends_data.php'; ?>
                </div>
                <div class="myProf">                       
                    <img src="showProfileImage.php"  alt="profile pic" class="profileImg ">                                 
                    <div class="txt">
                        <h3 class="usernameName"><?php echo $_SESSION['userName'] ?></h3>
                        <h5 class="<?php echo $_SESSION['online']?>"><?php echo $_SESSION['online']?></h5>
                    </div>
                    <a href="logout.php" class="logout_btn">logout</a>
                </div>
            </div>
            <form class="chat-space" action="<?php echo $_SERVER['PHP_SELF'] . '?page=send' ?>" method="POST">   
            
                                 
                    <input type="text" name="send" id="send" placeholder="message .. " autocomplete="off" required autofocus>
                    <button type="submit" id="submit" >
                        <i class="fa fa-paper-plane"></i> 
                    </button>                                             
                   
             
            </form>     
            <div class="space">
                <div class="fixed">
                <button id="scrollDownBtn" onclick="goDownFunction()"><i class="fa fa-angle-double-down"></i></button>
                </div>    
                <div id="space">
                <ul class="msg-list">
                <?php 
                    
                    if(isset($_GET['friendname']))
                    {
                        $username_to=$_GET['friendname'];                        
                        $_SESSION['username_to']=$username_to;
                        $username = $_SESSION['userName'];
                        $stmt =$con-> prepare("SELECT * FROM massages where (sender = ? and receiver = ?) or (sender = ? and receiver = ?) ORDER BY 1 ASC;");   
                        $stmt->execute(array($username,$username_to,$username_to,$username));
                        while ($row = $stmt->fetch()){
    
                            $msg_id=$row['msg_id'];
                            $sender=$row['sender'];
                            $receiver=$row['receiver'];
                            $msg_date=$row['msg_date'];
                            $msg_content=$row['msg_content'];
                           
                            if(($username == $sender )and ($username_to == $receiver)){
                                echo" <li class='msg right-side'><p>".$msg_content."</p><span class='date'>".$msg_date."</span>"."</li>";                                
                            }
                            if(($username == $receiver )and ($username_to == $sender)){
                                echo" <li class='msg left-side'><p>".$msg_content."</p><span class='date'>".$msg_date."</span>"."</li>";                               
                            }
    
                        }    
                    }
                                               
                ?>
                </ul>
                </div>                
            </div>
        </div>                
    </div>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] =='POST' && $_GET['page'] == 'send'){
    $msg = $_POST['send'];
    $username=$_SESSION['userName'];
    $username_to=$_SESSION['username_to'];
    echo $msg;
    $stmt= $con->prepare("INSERT INTO massages (msg_id,sender,receiver,msg_date,msg_content) VALUES (NULL, ?,?,NOW(),?);");
    $stmt->execute(array($username,$username_to,$msg));    
    header("location:chatplace.php?friendname=".$username_to );
}
?>
  <script type="text/javascript">  
    function myFunction(element) {   
    'use strict'; 
        
        var elem=document.element;
        var liArray = document.getElementById("friends").getElementsByTagName("li");     
        
            liArray[1].classList.remove("current");  //to remove the current class from all <i>
               
        elem.classList.add("current");  //to add the current class to the selected <i>
    }
    function goDownFunction() {  
        var target = document.getElementById("space");
        target.scrollTop = target.scrollHeight;
    }
    var target = document.getElementById("space");
    target.scrollTop = target.scrollHeight;
    var mybutton = document.getElementById("scrollDownBtn");
    target.onscroll = function() {scrollFunction()};
    function scrollFunction() {
      if (target.scrollTop < (target.scrollHeight - 1000) ) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }        
    </script>
    <script src="layout/js/jquery_dev.js"></script>
    <script src="layout/js/backend.js"></script>
<?php
}
else{
    header('location:index.php');
}
?>

