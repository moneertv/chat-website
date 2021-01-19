<?php 
    session_start();    
       	
    header("Content-type: image/jpeg");
    echo $_SESSION['profile_img'];  
                    
?>