<?php

include 'connect.php';
if(isset($_SESSION['userName']))
{
    $stmt = $con->prepare('SELECT * FROM friends WHERE user_id = ?;');
    $stmt->execute(array($_SESSION['id']));
    $counter = 1;
    while($row = $stmt->fetch()){
        $friend_id=$row['friend_id'];
        $_SESSION['friend_id']=$friend_id;
        $stmt2 = $con->prepare('SELECT * FROM users WHERE id = ?;');
        $stmt2->execute(array($friend_id));
        $row2 = $stmt2->fetch();
        $friend_name=$row2['userName'];
        $_SESSION['friend_name']=$friend_name;
        $friend_on=$row2['whoOn'];
        $_SESSION['friend_pic']=$row2['profile_img'];
        
        ?>

        <li class="ttt ">
            <a class="<?php echo $friend_name?>" href="chatplace.php?friendname=<?php echo $friend_name ?>" >
                <div class="friend " onclick='myFunction()'>                       
                <img src="showfriendImage.php?imgid=<?php echo $friend_id ?>"  alt="profile pic"        class="profileImg">                        
                <div class="txt">
                    <h3 class="usernameName"><?php echo $friend_name . $counter++ ; ?> </h3>
                    <h5 class="<?php echo $friend_on?>"><?php echo $friend_on?></h5>
                </div>            
                </div> 
            </a>
              
        </li>

<?php
    }
}
else
{
    header('location:index.php');
}


?>