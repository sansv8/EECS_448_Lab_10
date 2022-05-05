<?php
	//Connect to SQL Database
	$mysqli = new mysqli("mysql.eecs.ku.edu", "a008p058", "iMa7ajag","a008p058");

	//Checks connect
	if($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	//Get the ids of each post that must be deleted 
	$ids = $_POST["id"];

	//If ids is empty
	if(empty($ids))
	{
		//Tell the user that no post is delete
		echo "No post is deleted";

		//Close the connection
		$mysqli->close();

		//Exit
		exit();
	}

	//Next, start the query that will delete all rows with an id from ids in Posts
	$query = "DELETE FROM Posts WHERE post_id IN (";


	//For each id in ids
	foreach($ids as $value)
	{
		//Add the value to query
		$query = $query . "$value,";
	}
	
	//Remove the comma
	$query = rtrim($query, ',');

	//Next, end query
	$query = $query . ")";

	//Delete the specific posts from the database
	$mysqli->query($query);

	//Close the connection
	$mysqli->close();

	//Next, tell the user that all posts are deleted
	printf("All checked posts have been deleted\n");
	printf("IDs: ");
	
	//Goes each id in ids
	foreach($ids as $value)
	{
		//Print the id 
		printf("%u ", $value);
	}


?>