<?php 
    session_start();    
    include 'connect.php'  ;
    if(isset($_GET['imgid']))
    {
        $stmt3=$con->prepare('SELECT profile_img FROM users where id=?');
        $stmt3->execute(array($_GET['imgid']));
        $row3=$stmt3->fetch();
        $pic=$row3['profile_img'];
        header("Content-type: image/jpeg");
        echo $_SESSION['friend_pic'];        
    }                  
?>