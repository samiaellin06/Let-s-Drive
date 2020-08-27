<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <meta charset="UTF-8">
    <title>Let's Drive | Sign Up</title>

    <link rel="stylesheet" href="LogSign.css">
    <link rel="icon" href="car_logo.ico">

</head>
<body style="background-image: url('SignUp.jpg');">



<?php 
	$db=mysqli_connect("localhost", "root", "", "letsdrive");
	
	if(isset($_POST['SignUpBtn'])) 
	{
		session_start();
		$username=mysql_real_escape_string($_POST['username']);
		$email=mysql_real_escape_string($_POST['email']);
		$password=mysql_real_escape_string($_POST['password']);
		
		if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']))
		   {
				header("location:SignUp.php?Empty= Please Fill in the Blanks");
		   }
		  
		else {
			
			$Usql="Select * FROM user WHERE UserName='$username'";
			$result=mysqli_query($db, $Usql);
			
			if(mysqli_num_rows($result)>0)
			{
				header("location:SignUp.php?NAvailable= Username Not Available");
			}
			
			else 
			{
				$password=md5($password);
				$sql="INSERT INTO user(UserName, Email, Pass) VALUES ('$username', '$email', '$password')";
				mysqli_query($db, $sql);
				
				echo '<script language="javascript">';
				echo 'alert("Sign up Sucessful")';
				echo '</script>';
				header("location:LogIn.php");
			}
		}
	}
?>

    <div id= "FA" class="content">
	<form method="POST" action="SignUp.php">
	<table>
		<tr>
        <div class="form-area">
            <div class="img-area">
                <img src="carlogo.png" alt="" >
            </div>
            <h2 style="padding-bottom:-20px;">SignUp Form</h2>
					<?php 
                        if(@$_GET['Empty']==true)
                        {
                    ?>
                        <p  style="color:red;text-align:center;margin-top:-25px;"><?php echo $_GET['Empty'] ?></p>                               
                    <?php
                        }
                    ?>
 
 
                    <?php 
                        if(@$_GET['NAvailable']==true)
                        {
                    ?>
                        <p style="color:red;text-align:center;margin-top:-25px;"><?php echo $_GET['NAvailable'] ?></p>                               
                    <?php
                        }
                    ?>
            <p style="margin-top:0px;">Enter Name:</p>
            <input type="text" name="username">
            <p>Enter Email:</p>
            <input type="email" name="email">
            <p>Enter Password:</p>
            <input type="password" name="password">
			
			<input class="btn" type="submit" name="SignUpBtn" value="Sign Up">
		</div>
		</tr>
	</table>
	</form>
    </div>
</body>
</html>

