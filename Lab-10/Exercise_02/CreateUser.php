<?php
	//Connect to SQL Database
	$mysqli = new mysqli("mysql.eecs.ku.edu", "a008p058", "iMa7ajag","a008p058");

	//Checks connect
	if($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	//Next, store the input from the form 
	$name = $_POST["username"];

	//Next, check that name is not empty
	//If name is empty
	if($name == "")
	{
		//Tell the user that the name is empty
		printf("Name is empty. Must input a name.");

		//Close the connection
		$mysqli->close();

		//Exit the program
		exit();
	}

	//Next, search for name in the query
	$query = "SELECT user_id FROM Users WHERE user_id='$name'";
	
	//If the result does find a query
	if($result = $mysqli->query($query))
	{
		//If the number of row from the query is 1
		//then the username already exists
		if($result-> num_rows == 1)
		{
			//Tell the user that the result already exists
			printf("User already exists in the database");
		}
		//Otherwise, if the number of rows from the query is 0
		//then the username does not exist
		else
		{
			//Create a command that will insert name into the Users
			$insert = "INSERT INTO Users (user_id) VALUES ('$name')";
			$mysqli->query($insert);

			//Tell the user that user is created
			printf("User is created");
		}
	
		//Empty result
		$result->free();

		//Close the connection
		$mysqli->close();
	}
	else
	{
		//Close the connection 		
		$mysqli->close();
	}
	
?>