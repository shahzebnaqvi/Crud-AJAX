<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO sample_table (`id`, `name`, `email`, `password`, `image`) VALUES (NULL,'".$_POST["name"]."','".$_POST["email"]."', '".$_POST["password"]."','".$_POST["image"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM sample_table WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name'] = $_POST["name"];
			$output['email'] = $_POST["email"];
			$output['password'] = $_POST["password"];
			$output['image'] = $_POST["image"];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE sample_table 
		SET name = '".$_POST["name"]."', 
		email = '".$_POST["email"]."' , 
		password = '".$_POST["password"]."' , 
		image = '".$_POST["image"]."' 
		WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM sample_table WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>