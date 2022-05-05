<?php
	//Connect to SQL Database
	$mysqli = new mysqli("mysql.eecs.ku.edu", "a008p058", "iMa7ajag","a008p058");

	//Checks connect
	if($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	//Create a new table
	echo "<table style=\"border:solid 1px;\"><tbody><th style=\"border:solid 1px;\">Users</th>";

	//Get all the user_id from the table
	$query = "SELECT user_id FROM Users";

	//Next, check for the query
	if($result = $mysqli->query($query))
	{
		//Loop through each row of Users
		while($row = $result->fetch_assoc())
		{
			//Get the user user
			$user = $row["user_id"];

			//Add a the user of the row to the table
			echo "<tr><td style=\"border:solid 1px;\">$user<td></tr>";
		}

		//Free the result
		$result->free();
	}
	
	//End the table
	echo "</tbody></table>";

	//Close the connection
	$mysqli->close();
?>