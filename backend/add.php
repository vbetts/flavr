<?php

if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['categories']) && !empty($_POST['ingred1']) && !empty($_POST['ingred2']) && !empty($_POST['ingred3']) && !empty($_POST['ingred4']))
{
	$dbconn = mysqli_connect('dbhost','username','password', 'dbname', 'dbport');

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$name = $_POST['name'];
	$description = $_POST['description'];
	$categories = $_POST['categories'];
	$ingred1 = $_POST['ingred1'];
	$ingred2 = $_POST['ingred2'];
	$ingred3 = $_POST['ingred3'];
	$ingred4 = $_POST['ingred4'];

	$ingredients = array($ingred1, $ingred2, $ingred3, $ingred4);


	/* create a prepared statement */
	if ($stmt = mysqli_prepare($dbconn, 'INSERT INTO Recipes(name, rText) VALUES(?, ?)')) {
		/* Assumes userid is integer and category is string */
		mysqli_stmt_bind_param($stmt, "ss", $name, $description);  
		/* execute query */
		mysqli_stmt_execute($stmt);
		$lastId = mysqli_stmt_insert_id ($stmt);
		/* close statement */
		mysqli_stmt_close($stmt);
	}
	else
	{
		exit("recipes failed");
	}

	foreach($categories as $category)
	{
		$valid_categories = array("meat", "veg", "flex", "gfree", "breakfast", "lunch", "dinner", "dessert");
		if (in_array($category, $valid_categories)) {
			$query = "UPDATE Recipes SET " . $category . " = '1' WHERE id = " . $lastId; 
			if ($stmt = mysqli_prepare($dbconn, 'UPDATE Recipes SET ' . $category . ' = 1 WHERE id = ?')) {
				mysqli_stmt_bind_param($stmt, "i", $lastId);  
				/* execute query */
				mysqli_stmt_execute($stmt);
			}
			else
			{
				exit("categories failed");
			}
		}
	}

	foreach($ingredients as $ingred)
	{
	if ($stmt = mysqli_prepare($dbconn, 'INSERT INTO LinkIngRec(idIng, idRec) VALUES (?, ?)')) {
				mysqli_stmt_bind_param($stmt, "ii", $ingred, $lastId);  
				/* execute query */
				mysqli_stmt_execute($stmt);
	}
	else
	{
		exit("ingredients failed");
	}
}

	/* close connection */
	mysqli_close($dbconn);
}
else 
{
	exit("invalid parameters");
}

	
?>