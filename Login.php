<?php
include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	// username and password sent from Form
		$myusername=addslashes($_POST['uname']);
		$mypassword=addslashes($_POST['pwd']);
		 
		$sql="SELECT uid,name,role FROM users WHERE email='$myusername' and password='$mypassword'";
		$result=mysqli_query($bd,$sql);
		$row=mysqli_fetch_array($result);
		$active=$row['uid'];
		$name = $row['name'];
		$count=mysqli_num_rows($result);	 
		session_start();
		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1)
		{
		//session_register("myusername");
		$_SESSION['login_user']=$active;
		$_SESSION['login_name']= $name;
		$_SESSION['login_role']= $row['role'];
		if($row['role'] == 1){
			header("location: customerOrder.php");
		}
		else if($row['role'] == 2){
			$sql="SELECT fid FROM food_item where available <=0";
			$result=mysqli_query($bd,$sql);
			$row=mysqli_fetch_array($result);
			$count=mysqli_num_rows($result);
			if($count >=1){				
				$message = "Some food items are not available, Please check and Update";
						echo "<script type='text/javascript'>alert('$message');window.location = 'http://localhost/rms/newOrders.php';</script>";
			}
			else{
				header("location: newOrders.php");
			}
		}
	}
	else
	{
		$error="Your Login Name or Password is invalid";
	}
}
?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>
</head>
<body>
<form action= "Login.php" method = "post">
<link href='css/custom.css' rel='stylesheet' type='text/css'>

<form method="post" action="Login.php">
<div id="error" class ="error-login"> <?php if(isset($error)){ echo $error; } ?></div>
<div class="login-box">
<h1>Login </h1>
<div class ="textbox">
<input type="text" id="uname" name="uname" placeholder="User Name"  class="email" /></div>
<div class="textbox" >
<input type="password" id="pwd" name="pwd" placeholder="Password"  class="email" /></div>
  
<input type ="submit" id="save" name ="save" class="btn" value="Login"> <!-- End Btn -->

<a href="createUser.php"><div id="btn2">Sign Up</div></a> <!-- End Btn2 -->
  
</div> <!-- End Box -->
  
</form>

 </form>
</body>
</html>
