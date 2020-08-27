<?php

$searchval="";
if(isset($_GET['search'])) $searchval=$_GET['search'];

try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive",'root','');

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo "<script>window.alert('db connection errror')</script>";
}

$searchquery="SELECT * FROM cars WHERE CarName LIKE '%$searchval%'";
try{
    $object=$conn->query($searchquery);
    if($object->rowCount() == 0){
        echo 
			"
			<tr>
				<td>
					<h4 style='color: darkorange; text-align:center; font-size:30px;'>No Results Found!</h4>
				</td>
			</tr>
			";
    }
    else{
        $tablecode="";
        $table=$object->fetchAll();
		$count=0;
        foreach($table as $rows){
			
			if($count%3==0){
				$tablecode.="<tr style='width:100%;'>";
			}
			
            $tablecode.="
				<td style='width:32%;'>
					<div class='container' style='width:80%;'>
						<div class='car'>
							<div class='carImg'>
								<img src='$rows[6]'>
							</div>
							<div class='details'>
								<div class='content'>
									<h4 style='color: darkorange'>$rows[1]</h4>
									<p >Type: $rows[2]</p>
									<p >$rows[3] Seater</p>
									<p >Per Day: $rows[4]Tk</p>
									<p >Quantity: $rows[5]</p>
									<input type='button' value='Book Now' onClick='document.location.href='LogIn.php''>
									<input type='button' value='Subscribe' onClick='document.location.href='LogIn.php''>
								</div>
							</div>
						</div>
					</div>
				</td>
				";
				
			if($count%3==2){
				$tablecode.="</tr>";
			}
			
			$count+=1;
			///echo $count;
        }
		
        echo $tablecode;
    }
}
catch(PDOException $ex1){
    echo "<script>console.log('search error')</script>";
}

?>