<!DOCTYPE html>

<html>
    <head>
		<title>Let's Drive | Add A Car</title>
		<link rel="icon" href="car_logo.ico">
        <link rel="stylesheet" href="update.css" type="text/css">
    </head>
    
    <body>
       <?php  
			try
				{
					$db=mysqli_connect("localhost", "root", "", "letsdrive");	
				}catch(PDOException $ex){
					echo "<script>window.alert('db connection errror')</script>";
				}
	
			if(isset($_POST['upload'])) 
			{
				$id=mysql_real_escape_string($_POST['cid']);
					$cname=mysql_real_escape_string($_POST['cname']);
					$type=mysql_real_escape_string($_POST['type']);
					$seats=mysql_real_escape_string($_POST['seats']);
					$price=mysql_real_escape_string($_POST['price']);
					$quantity=mysql_real_escape_string($_POST['quantity']);
					
					$image = $_FILES['image']['name'];
				
				if(empty($_POST['cname']) || empty($_POST['type']) || empty($_POST['seats']) ||  empty($_POST['price']) ||  empty($_POST['quantity']) ||  empty($image))
			   {
					header("location:AddCar.php?Empty= Please Fill in the Blanks");
			   }
			   else
			   {	
					try
					{
						$Usql="Select * FROM cars WHERE CarName='$cname'";
						$result=mysqli_query($db, $Usql);
				
						if(mysqli_num_rows($result)>0)
						{
							header("location:AddCar.php?Available= Car Already Exits");
						}
						
						else
						{
							$sql="INSERT INTO cars (CarId, CarName, Type, Seats, Price, Quantity, Image) VALUES ('$id', '$cname', '$type', '$seats', '$price', '$quantity', '$image')";
							mysqli_query($db, $sql);
							echo "<script>window.alert('Inserted Successfully')</script>";
						}
						
					}catch(PDOException $ex){
						echo "<script>window.alert('db connection errror')</script>";
					}
			   }
			}
		?>
                <h1 align="center">Add A Car</h1>
                <form action='AddCar.php' method="POST" enctype="multipart/form-data">
					<?php 
                        if(@$_GET['Empty']==true)
                        {
                    ?>
                        <p  style="color:red;text-align:center;margin-top:-25px;"><?php echo $_GET['Empty'] ?></p>                               
                    <?php
                        }
                    ?>
					
					<?php 
                        if(@$_GET['Available']==true)
                        {
                    ?>
                        <p style="color:red;text-align:center;margin-top:-25px;"><?php echo $_GET['Available'] ?></p>                               
                    <?php
                        }
                    ?>
				
                    <p>Car ID: <input type="text" name="cid" value=""></p> <br/>

                    <p>Car Name: <input type="text" name="cname"></p> <br/>
					
					<p>Type: <input type="text" name="type"></p> <br/>

                    <p>Seats: <input type="text" name="seats"></p> <br/>

                    <p>Price: <input type="text" name="price"></p> <br/>

                    <p>Quantity: <input type="text" name="quantity"></p> <br/>

                    <p>Image: <input type="file" name="image"> </p> <br/>

					<input class="btn" type="submit" name="upload" value="Add">
                </form>    

    </body>  
</html>