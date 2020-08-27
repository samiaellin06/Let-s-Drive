<?php
//GET
if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["cid"]))
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    $cid=$_GET['cid'];
    
    $sqlquery="SELECT * FROM cars ";
    if($cid!="all")
	{
        $sqlquery.=" WHERE CarId=$cid";
    }
    
    ///db connection
    try
	{
        $conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive;",'root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pdostmt=$conn->query($sqlquery);
        if($pdostmt->rowCount()==0){
            http_response_code(400);
        
            $arr=array("message"=>"Invalid Car Id");
            echo json_encode($arr);
        }
        else
		{
            $table=$pdostmt->fetchAll();
            echo json_encode($table);
        }    
    }
    catch(PDOException $ex)
	{
        http_response_code(503);
        
        $arr=array("message"=>"Service Unavailable");
        echo json_encode($arr);
    }
}

//POST
if($_SERVER['REQUEST_METHOD']=='POST')
{
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$jsonstring=file_get_contents("php://input");
	$phparray=json_decode($jsonstring,true);
	
	///db connection
	try
	{
		$conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive",'root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$maxidquery="SELECT MAX(CarId) FROM cars";
		$table=$conn->query($maxidquery)->fetchAll();
		
		$newid=$table[0][0]+1;
		$cname=$phparray['CarName'];
		$type=$phparray['Type'];
		$seats=$phparray['Seats'];
		$price=$phparray['Price'];
		$quantity=$phparray['Quantity'];
		
		$insertquery="INSERT INTO cars (CarId, CarName, Type, Seats, Price, Quantity) VALUES ('$newid','$cname','$type','$seats','$price', '$quantity')";
		$conn->exec($insertquery);
		
		http_response_code(201);
		echo json_encode(array("message"=>"Car added successfully", "CarId"=>$newid));
		
	}
	catch(PDOException $ex)
	{
		http_response_code(503);
		echo json_encode(array("message"=>"Service Unavailable"));
	}
}

//PUT
if($_SERVER['REQUEST_METHOD']=="PUT")
{
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		
	
		$jsonstring=file_get_contents("php://input");
		$phparray=json_decode($jsonstring,true);

		///db connection
		try
		{
			$conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$cname=$phparray['CarName'];
			$type=$phparray['Type'];
			$seats=$phparray['Seats'];
			$price=$phparray['Price'];
			$quantity=$phparray['Quantity'];

			$updatequery="UPDATE cars SET CarName='$cname', Type='$type', Seats='$seats', Price='$price', Quantity='$quantity' WHERE CarId='$id'";
			
			$no_rows=$conn->exec($updatequery);
			
			http_response_code(200);

			echo json_encode(array("message"=>"$no_rows rows have been updated"));
			
		}
		catch(PDOException $ex)
		{
			http_response_code(503);		
			echo json_encode(array("message"=>"Service Unavailable"));
		}
	}
	else
	{
		http_response_code(404);		
		echo json_encode(array("message"=>"id parameter not found"));
	}
}

//DELETE
if($_SERVER['REQUEST_METHOD']=="DELETE")
{
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		
		///db connection
		try
		{
			$conn=new PDO("mysql:host=localhost:3306;dbname=letsdrive",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$deletequery="DELETE FROM cars WHERE CarId=$id ";
			
			$no_rows=$conn->exec($deletequery);
			
			http_response_code(200);
			echo json_encode(array("message"=>"$no_rows rows have been deleted"));
			
		}
		catch(PDOException $ex)
		{
			http_response_code(503);			
			echo json_encode(array("message"=>"Service Unavailable"));
		}
	}
	else
	{
		http_response_code(404);			
		echo json_encode(array("message"=>"id parameter not found"));
	}
}
?>