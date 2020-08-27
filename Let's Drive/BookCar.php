<?php
   session_start();

    if(isset($_SESSION['User']))
    {
		$un=$_SESSION['User'];
		
?>

<!DOCTYPE html>

<html>
    <head>
		<title>Let's Drive | Add A Car</title>
		<link rel="icon" href="car_logo.ico">
        <link rel="stylesheet" type="text/css" href="BookSub.css">
    </head>
    
    <body>
       <div id="popup2" class="overlay" style="display:block; background: black;">
	
	<?php  
			
		$carid=-1;

		if(isset($_GET['cid'])) 
			$carid=$_GET['cid'];
		
		if(isset($_POST['Book'])) 
		{
			$date=mysql_real_escape_string($_POST['date']);
			$time=mysql_real_escape_string($_POST['time']);
			$dur=mysql_real_escape_string($_POST['dur']);
			$phn=mysql_real_escape_string($_POST['phn']);
			$hadd=mysql_real_escape_string($_POST['hadd']);
			$pup=mysql_real_escape_string($_POST['pup']);
			$dop=mysql_real_escape_string($_POST['dop']);
			$price=mysql_real_escape_string($_POST['price']);

			$image = $_FILES['image']['name'];
			
			if(empty($_POST['date']) || empty($_POST['time']) || empty($_POST['dur']) || empty($_POST['phn']) ||  empty($_POST['hadd']) ||  empty($_POST['pup']) ||  empty($_POST['dop']) ||  empty($_POST['price']) ||  empty($image))
		   {
				echo "<script>window.alert('Please Fill in the Blanks')</script>";
		   }
		   
		   else 
		   {
				try
				{
					$db=mysqli_connect("localhost", "root", "", "letsdrive");	
					$sql="INSERT INTO bookcar (D, T, Duration, HomeAddress, Phone, PickUpPoint, DropOffPoint, Price, License_image, CarID, Username) VALUES ('$date', '$time', '$dur', '$hadd', '$phn', '$pup', '$dop', '$price', '$image', '$carid', '$un');";
					mysqli_query($db, $sql);
					
					$q = $db->query("Select Quantity FROM cars WHERE CarId='$carid'")->fetch_object()->Quantity;
					$q-=$q;
					$updatequery="UPDATE cars SET Quantity='".$q."' WHERE CarId=".$carid;
					
					if(isset($_POST['pay']))
					{
						$cardno=mysql_real_escape_string($_POST['cardno']);
						$pin=mysql_real_escape_string($_POST['pin']);
						$amount=mysql_real_escape_string($_POST['amount']);
						
						
					   if(empty($_POST['cardno']) || empty($_POST['pin']) || empty($_POST['amount']))
					   {
							echo "<script>window.alert('Please Fill In The Blanks')</script>";
					   }
					   else
					   {
					
					   }
					}
				?>
					<div id="popup1" class="overlay" style="display:block; padding-top:80px;">
					
					<a href='BookCar.php?cid=<?php echo $carid?>' style="padding-right:20px;" class="closeBtn"button onclick="document.getElementById('popup1').style.display='none'">&times;</a>
					
					<form class="pay" action="BookCar.php?cid=<?php echo $carid?>" method="POST">
						<p class="payP" style="text-align:center; font-size:20px;">Payment Form</p>
						<p class="payP">Credit Card No.:</p>
						<input class="payI" type="text" name="cardno">
						<p class="payP">PIN No:</p>
						<input class="payI" type="password" name="pin">
						<p class="payP">Amount(TK):</p>
						<?php $result = $db->query("Select Price FROM cars WHERE CarId='$carid'")->fetch_object()->Price;?>
						<input class="payI" type="text" name="amount" value="  <?php  echo $result ?> Tk" readonly><br>
						<input class="payI" type="submit" name="pay" value="Confirm">
					</form>
					</div>
					
				<?php				
				}catch(PDOException $ex){
					echo "<script>window.alert('db connection errror')</script>";
				}	   
		   }		
		}		
	?>

    <div class="title"><h2 style="color: white;">Car Book Form</h2></div>
    <div class="con">

            <a href="CarsLI.php" class="closeBtn"button onclick="document.getElementById('popup2').style.display='none'">&times;</a>

                <div class="left">
				</div>
                <div class="right">
                    <div class="formbox">
                        <form action='BookCar.php?cid=<?php echo $carid?>' method="POST" enctype="multipart/form-data">
                            <p>Date: <input type="text" name="date"></p></br>
                            <p>Time: <input type="text" name="time"></p></br>                           
                            <p>Duration In Hours: <input type="text" name="dur"></p></br>                            
							<p>Phone No:  <input type="text" name="phn"></p></br>                            
                            <p>Home Address:  <input type="text" name="hadd"></p></br>                           
                            <p>Pick-Up-Point: <input type="text" name="pup"></p></br>                          
                            <p>Drop-Off-Point: <input type="text" name="dop"></p></br> 
                            <?php 
								$db=mysqli_connect("localhost", "root", "", "letsdrive");
								$result = $db->query("Select Price FROM cars WHERE CarId='$carid'")->fetch_object()->Price;
							?>
                            <p>Price: <input type="text" name="price" value="  <?php  echo $result ?> Tk" readonly></p>    
                            <p>License Image:  <input type="file" name="image"></p>
							</br></br>
                            <input type="submit" name="Book" value="Submit" id="popbtn">
                        </form>
                    </div>
                </div>
    </div>
</div>
    </body>  
</html>

<?php
	}
	
    else
    {
        header("location:LogIn.php");
    }

?>