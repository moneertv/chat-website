<?PHP
session_start();

if(isset($_SESSION['userName']))
{
    header('location:chatPlace.php');    
}

include 'init.php';

if($_SERVER['REQUEST_METHOD'] =='POST' && $_GET['page'] == 'login')
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashPassword = sha1($password);

	$stmt = $con->prepare("SELECT * from users where email = ? and password = ? LIMIT 1");
    $stmt->execute(array($email,$hashPassword));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if($count>0)
    {
		$_SESSION['id']=$row['id'];
		$stmt = $con-> prepare("UPDATE `users` SET `whoOn` = 'online' WHERE `id` = ?;");
		$stmt->execute(array($_SESSION['id']));    
		$stmt = $con->prepare("SELECT * from users where email = ? and password = ? LIMIT 1");
		$stmt->execute(array($email,$hashPassword));
		$row = $stmt->fetch();    
        $_SESSION['userName']=$row['userName'];
		$_SESSION['email']=$email;
		$_SESSION['profile_img'] = $row['profile_img'];
		$_SESSION['img_type'] = $row['img_type'];	
		$_SESSION['online'] = $row['whoOn'];
        header('location:chatPlace.php');
        exit();
    }else{
        header('location:index.php');
    }

}

if($_SERVER['REQUEST_METHOD'] =='POST' && $_GET['page'] == 'signup'){
	$userName = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//img handling
	$name = addslashes($_FILES['profile_img']['name']);
	$data = file_get_contents($_FILES['profile_img']['tmp_name']);
	$type = addslashes($_FILES['profile_img']['type']);
	if(substr($type,0,5)=='image')
	{
		$stmt = $con-> prepare("INSERT INTO `users` (`id`, `userName`, `email`, `password`, `profile_img` ,`trustStatus`,`img_type`) VALUES (NULL, ?, ?, SHA1(?), ?, '1000' , ?)");
    	$stmt->execute(array($userName,$email,$password,$data,$type));	
	}	   
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SignUp and Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>
<body>

<div class="container" id="container">
<div class="form-container sign-up-container">

<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=signup' ?>" method="post" id="form1" enctype="multipart/form-data">
	<h3>Create Account</h3>
	<input type="file" id="prof_img" name="profile_img" class="profImg" accept="image/jpeg" required >
	<label for="prof_img">
		<figure >
		<i class="fa fa-user-circle img"></i>
		</figure>
		<span class="caption">Choose a profile pic</span>
	</label>
	<input type="text" name="username" placeholder="Name" required>
	<input type="email" name="email" placeholder="Email" required>
	<input type="password" name="password" placeholder="Password" required>
	<button type="submit" form="form1" value="Submit">SignUp</button>
</form>
</div>
<div class="form-container sign-in-container">
	<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=login' ?>" method="post" id="form2">
	<h3>Sign In</h3>	
	<input type="email" name="email" placeholder="Email">
	<input type="password" name="password" placeholder="Password">
	<a href="#">Forgot Your Password</a>

	<button type="submit" form="form2" value="Submit">Sign In</button>
	</form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Welcome Back!</h1>
			<p>To keep connected with us please login with your personal info</p>
			<button class="ghost" id="signIn">Sign In</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Hello, Friend!</h1>
			<p>Enter your details and start journey with us</p>
			<button class="ghost" id="signUp">Sign Up</button>
		</div>
	</div>
</div>
</div>

<?php include $templates."footer.php";?>