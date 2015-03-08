<?php

if(!empty($_POST['ingredient']))
{
	$dbconn = mysqli_connect('dbhost','username','password', 'dbname', 'dbport');

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$ingredient = $_POST['ingredient'];

		if ($stmt = mysqli_prepare($dbconn, 'INSERT INTO Ingredients(name) VALUES(?)')) {
		/* Assumes userid is integer and category is string */
		mysqli_stmt_bind_param($stmt, "s", $ingredient);  
		/* execute query */
		mysqli_stmt_execute($stmt);
		$lastId = mysqli_stmt_insert_id ($stmt);
		/* close statement */
		mysqli_stmt_close($stmt);
	}
	/* close connection */
	mysqli_close($dbconn);
}
?>