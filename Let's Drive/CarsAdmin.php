
<?php
   session_start();

    if(isset($_SESSION['User']))
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Let's Drive | Cars</title>
    <link rel="icon" href="car_logo.ico">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<!--nav bar-->
<div class='menu'>

  <span class='toggle'>
    <i></i>
    <i></i>
    <i></i>
  </span>

    <div class='menuContent'>
        <ul>
            <li><a href="CarsAdmin.php" class="active">Cars Admin</a></li>
			<li><a href="AdminLogOut.php">Log Out</a></li>
        </ul>
        <div style="margin-right: 1000px;margin-top: -65px;overflow: hidden;"><img src="carlogo.png" id="logo"></div>
    </div>
</div>


<script
        src="https://code.jquery.com/jquery-3.3.1.js"
></script>
<script>
    $('.toggle').on('click', function() {
        $('.menu').toggleClass('active');
    });

</script>

<!--parallex effect-->

<section class="zoom">

    <img src="mountain1.png" id="layer1">
    <img src="mountain2.png" id="layer2">
    <img src="text.png" id="text">

</section>

<script type="text/javascript">
    var layer1 = document.getElementById('layer1')
    scroll = window.pageYOffset;
    document.addEventListener('scroll',
        function (e) {
            var offset = window.pageYOffset;
            scroll = offset;
            layer1.style.width = (100 + scroll/5) +
                '%';

        });

    var text = document.getElementById('text')
    scroll = window.pageYOffset;
    document.addEventListener('scroll',
        function (e) {
            var offset = window.pageYOffset;
            scroll = offset;
            layer2.style.width = (100 + scroll/5) +
                '%';
            text.style.top = - scroll/20 +
                '%';

        });

    var layer2 = document.getElementById('layer2')
    scroll = window.pageYOffset;
    document.addEventListener('scroll',
        function (e) {
            var offset = window.pageYOffset;
            scroll = offset;
            layer2.style.width = (100 + scroll/5) +
                '%';
            layer2.style.left = scroll/50 +
                '%';

        });

</script>

<!--Search-->
<div id="searchpanel">
	<br>
    <h3 align="center" style="font-size: 54px;font-family: 'Arial Rounded MT Bold'; color: darkorange;"><i>Choose Your Preffered Car From <br>Our Vast Range Of Car Collections.</i></h3>
    <div class="box">
	<form action="AddCar.php" method="POST">
        <input type="submit" id="Addbtn" name="ADD" value="Add">
    </form>
	</div>
</div>

<div align="center" style="color:orangered;background-color: rgba(255,165,0,.3)">
    <span style="width:34%;display:inline-block;">
        <img src="zoom1.PNG" style="padding: 2%">
        <p>No peak hour cab blues</p>
    </span>
    <span style="width:33%;display:inline-block;">
        <img src="zoom2.PNG" style="padding: 2%">
        <p>Weather won't ruin your ride </p>
    </span>
    <span style="width:32%;display:inline-block;">
        <img src="zoom3.PNG" style="padding: 2%">
        <p>Car pool to add fun & lower costs</p>
    </span>
</div>

<!--Car list-->
<h1 style="padding-left: 20px;color: darkorange; text-decoration: underline;">Car List:</h1>

<div id="list">
    <table  id="listtable" align="center">
	
        <tbody id="tablebody">
			<?php
				try
				{
					$conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive",'root','');
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				}catch(PDOException $ex){
					echo "<script>window.alert('db connection errror')</script>";
				}
				
				if(isset($_GET['delete'])){
					$id=$_GET['delete'];
				
					try{
						$delquery="DELETE FROM cars WHERE CarId=$id";
						$conn->exec($delquery);
						
						echo "<script>window.alert('deletion successful');</script>";
					}
					catch(PDOException $ex1){
						echo "<script>window.alert('deletion error');</script>";
					}
				}
				
				if($_SERVER['REQUEST_METHOD']=="POST"){
					try{
						if(isset($_POST['cname']) && isset($_POST['type']) && isset($_POST['seats']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['cid'])){
							$updatequery="UPDATE cars SET CarName='".$_POST['cname']."', Type='".$_POST['type']."', Seats='".$_POST['seats']."', Price='".$_POST['price']."', Quantity='".$_POST['quantity']."' WHERE CarId=".$_POST['cid'];

							$conn->exec($updatequery);
							echo "<script>window.alert('Updated Successfully')</script>";
						}
						else{
							echo "<script>window.alert('Invalid update operation.');</script>";
						}
					}
					catch(PDOException $ex){
						echo "<script>window.alert('update error');</script>";
					}
				}
				
				try
				{
                    $sqlquery="Select * FROM cars";
                    $object=$conn->query($sqlquery);
                    
                    if($object->rowCount() == 0)
					{
            ?>
						<tr>
							<td style="text-align:center;">
								No Data Found!!!
							</td>
						</tr>
            <?php  
                    }
					
					else
					{
                        $table=$object->fetchAll();
						$count=0;
						foreach($table as $rows)
						{
			
							if($count%3==0)
							{
			?>
								<tr style="width:100%;">
			<?php
							}
			?>
   
					<td style="width:32%;">
						<div class="container" style="width:80%;">
							<div class="car">
								<div class="carImg">
									<img src="<?php echo $rows["Image"];?>">
								</div>
								<div class="details">
									<div class="content">
										<h4 style="color: darkorange"><?php echo $rows['CarName'];?></h4>
										<p >Type: <?php echo $rows['Type'];?></p>
										<p ><?php echo $rows['Seats'];?> Seater</p>
										<p >Per Day: <?php echo $rows['Price'];?>Tk</p>
										<p >Quantity: <?php echo $rows['Quantity'];?></p>
										<input type="button" value="Update" onclick="updatedata(<?php echo $rows['CarId'] ?>);">
										<input type="button" value="Delete" onclick="deleterow(<?php echo $rows['CarId'] ?>);">
									</div>
								</div>
							</div>
						</div>
					</td>
			<?php
							if($count%3==2)
							{
			?>
								</tr>
			<?php
							}			
							$count+=1;
						}
					}
				} catch(PDOException $ex1)
				{
					echo "<script>console.log('Data show error')</script>";
				}                 
		?>
         </tbody>
    </table>
	
	<script>
            var searchdata=document.getElementById('search');
            
            var searchbtn=document.getElementById('searchbtn');
            searchbtn.addEventListener('click',ajaxfn);
            
            function ajaxfn(){
                var ajaxreq=new XMLHttpRequest();
                ajaxreq.open('GET','ajaxserve.php?search='+searchdata.value);
                
                ajaxreq.onreadystatechange=function (){
                    
                    if(this.readyState===XMLHttpRequest.DONE && this.status==200){
                        var tablebody=document.getElementById('tablebody');
                        tablebody.innerHTML=ajaxreq.responseText;
                    }
                };
                
                ajaxreq.send();    
            }
			
			function deleterow(id){
				///reloading this page again with an extra parameter passed through get method named "delete"
                location.assign('CarsAdmin.php?delete='+id);
            }
            
            function updatedata(id){
				///loading the update.php page to perform the update operation
                location.assign('update.php?uid='+id);
            }
    </script>
</div>

<!--footer-->
<footer >
    <div>
        <h4 style="border-bottom:2px solid white;">Our Services</h4>
        <a href="#">Book A Car</a><br/>
        <a href="#">Subscribe A Car</a><br/>
    </div>
    <div>
        <h4 style="color:floralwhite;border-bottom:2px solid white;">Cities We Are In</h4>
        <span id="branch-1">
                    <a href="#">Dhaka</a><br/>
                    <a href="#">Chittagong</a><br/>
                    <a href="#">Sylhet</a><br/>
                    <a href="#">Rangpur</a><br/>
                </span>
        <span id="branch-2">
                    <a href="#">Khulna</a><br/>
                    <a href="#">Rajshahi</a><br/>
                    <a href="#">Barisal</a><br/>
                </span>
    </div>
    <hr>
    <h3 style="color: white;padding-left: 10px;">Follow Us On:</h3>
    <ul id="FooterUl">
        <li class="footerL">
            <a href="https://www.facebook.com" target="_blank">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
        </li>

        <li class="footerL">
            <a href="https://www.instagram.com" target="_blank">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </li>

        <li class="footerL">
            <a href="https://www.twitter.com" target="_blank">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
        </li>


    </ul>
    <br/>
    <br/>
    <br/>
    <br/>
    <p style="color:white;font-size:15px;padding-left:10px;">© 2019 Let's Drive. All Rights Reserved.</p>
</footer>


</body>
</html>

<?php
	}
	
    else
    {
        header("location:AdminLogIn.php");
    }

?>
