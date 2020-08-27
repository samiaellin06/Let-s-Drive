<!DOCTYPE html>

<html>
    <head>
		<title>Let's Drive | Car Info Update</title>
		<link rel="icon" href="car_logo.ico">
        <link rel="stylesheet" href="update.css" type="text/css">
    </head>
    
    <body>
        <?php
			$updateid=-1;

			if(isset($_GET['uid'])) $updateid=$_GET['uid'];

			try{
				$conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive",'root','');
				echo "<script>console.log('database connected');</script>";

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $ex){
				echo "<script>window.alert('database connection error');</script>";
			}


			try{
				$searchquery="SELECT * FROM cars WHERE Carid=$updateid";
				$object=$conn->query($searchquery);
				
					
				if($object->rowCount() == 1){
					$table=$object->fetchAll();
                ?>
                <h1 align="center">Car Info Update</h1>
                <form action='CarsAdmin.php' method="post">
                    <p>Car ID: <input type="text" name="cid" value="<?php echo $table[0][0] ?>" readonly></p> <br/>

                    <p>Car Name: <input type="text" name="cname" value="<?php echo $table[0][1] ?>"></p> <br/>
					
					<p>Type: <input type="text" name="type" value="<?php echo $table[0][2] ?>"></p> <br/>

                    <p>Seats: <input type="text" name="seats" value="<?php echo $table[0][3] ?>"></p> <br/>

                    <p>Price: <input type="text" name="price" value="<?php echo $table[0][4] ?>"></p> <br/>

                    <p>Quantity: <input type="text" name="quantity" value="<?php echo $table[0][5] ?>"></p> <br/>
					
                    <input  class="btn" type="submit" name="update" value="Update">
                </form>          
                <?php
            }
            else{
				///if no data is found then no update operation is needed and again returning back to showdata.php page 
                echo "<script>location.assign('showdata.php');</script>";
            }

        }
        catch(PDOException $ex){
            echo "<script>location.assign('showdata.php');</script>";
        }
        ?>
    </body>
    
</html>