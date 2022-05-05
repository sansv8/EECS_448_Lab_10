<?php
	//Connect to SQL Database
	$mysqli = new mysqli("mysql.eecs.ku.edu", "a008p058", "iMa7ajag","a008p058");

	//Checks connect
	if($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	//Gets the user and post 
	$user = $_POST["user"];
	$post = $_POST["post"];

	//Next, check if the post is empty
	//If the post is empty, reject 
	if($post == "")
	{
		//Tell the user that the post cannot be empty
		printf("The post is empty. A post cannot be empty");

		//Close the connect
		$mysqli->close();

		//Exit the program
		exit();
	}

	//Next, check if user is in the database
	$query = "SELECT user_id FROM Users WHERE user_id='$user'";

	//If the user is in the database
	if($result = $mysqli->query($query))
	{
		//If the number of row from result is 1
		//then the user does exist in users
		if($result->num_rows)
		{
			//Insert the post into Posts with the user as the author_id
			$insert = "INSERT INTO Posts (content,author_id) VALUES ('$post', '$user')";
			$mysqli->query($insert);

			//Tell the user that post is made
			printf("The post has been made.");
		}
		//Otherwise if the number of rows is 0
		//Then the user does not exist in the database
		else
		{
			//Tell the user that the post cannot be made
			printf("The post cannot be made. The user does not exist.");

		}

		//Free the result
		$result->free();

		//Close the connect
		$mysqli->close();

		//Exit the program
		exit();
	}
	//Otherwise, if there is not result
	else
	{
		//Close the connect
		$mysqli->close();

		//Exit the program
		exit();
	}
?>