<?php
include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$email=addslashes($_POST['email']);
		$name=addslashes($_POST['name']);
		$pwd=addslashes($_POST['pwd']);
		$cpwd=addslashes($_POST['cpwd']);
		$phone=addslashes($_POST['phone']);
		$role=addslashes($_POST['role']);
		$address=addslashes($_POST['address']);		
		$sql="SELECT uid,role FROM users WHERE email='$email'";
		$result=mysqli_query($bd,$sql);
		$row=mysqli_fetch_array($result);		
		$count=mysqli_num_rows($result);		
		// If user already registered
		if($count >= 1){
			$error="Email ID is already registered with us";
		}
		else{
			$sql ="INSERT INTO users(email,name,password,confirmPassword,phoneNumber,role,address) VALUES ('$email','$name','$pwd','$cpwd',$phone,$role,'$address')";
			//echo $sql; exit;
			if (mysqli_query($bd, $sql)) {
				header("location: Login.php");
			}
		}
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/custom.css' rel='stylesheet' type='text/css'>
  <title>Sign Up</title>
  
</head>
<body>

  

<form method="post" action="createUser.php">
<div id="error" class ="error-login"> <?php if(isset($error)){ echo $error; } ?></div>
<div class="box">
	<h1>Sign Up </h1>

	<input type="text" id="email" name="email" placeholder="Email"  class="email" />
	  
	<input type="text" id="name" name="name" placeholder="Full Name"  class="email" /> 
	 
	<input type="password" id="pwd" name="pwd" placeholder="Password"  class="email" />

	<input type="password" id="cpwd" name="cpwd" placeholder="Confirm Password"  class="email" />

	<input type="text" id="phone" name="phone" placeholder="Mobile Number"  class="email" />

	<select id="role" name="role" class="email">
		<option value="none">Select Role</option>
		<option value="1">Customer</option>
		<option value="2">Manager</option>
	</select> 

	<textarea id="address" name = "address" class="email" placeholder="Address" ></textarea>
	 
	<input type ="submit" id="save" name ="save" class="btn" value="Sign Up"> <!-- End Btn -->

	<a href="#"><div id="btn2">Cancel</div></a>
  
</div> 
  
</form>

  
</body>
</html>
