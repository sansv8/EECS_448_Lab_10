<?php
	//Connect to the User database
	$mysqli = new mysqli("mysql.eecs.ku.edu", "a008p058", "iMa7ajag","a008p058");

	//Checks connect
	if($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	//Next, get the user from the frontend
	$user = $_POST["user"];

	//Next, qeuery Posts for where the author of the post is the user
	$query = "SELECT content FROM Posts WHERE author_id='$user'";

	//Query the database
	//Next, check for the query
	//If the results exists
	if($result = $mysqli->query($query))
	{
		//If the number of rows from result is not 0
		if($result->num_rows != 0)
		{
			//Create a new table
			echo "<table style=\"border:solid 1px;\"><tbody><th style=\"border:solid 1px;\">Posts</th>";

			//Loop through each row of Users
			while($row = $result->fetch_assoc())
			{
				//Get the content from the row
				$content = $row["content"];

				//Add the content to the table
				echo "<tr><td style=\"border:solid 1px;\">$content</td></tr>";
			}

			//End the table
			echo "</tbody></table>";
		}
		//Otheriwse, then the user has no posts
		else
		{
			//Tell the user that there are no posts
			printf("The user did not made any posts");
		}

		//Empty the result
		$result->free();
	}

	//Close the connection
	$mysqli->close();
?>