<html>

<head>

	<title>Unit 2 Demo</title>
	
</head>

<body>

	<font size="6">SQLI</font></br>
	<font size="4">Demo 4</font></br></br>

	<form action="demo4.php" method="POST">
	Last name: <input type="text" name="contactLastName"><br>
	<input type="submit" value="Submit">
	</form>

</body>

</html>


<?php

	if(isset($_POST['contactLastName'])){

		$contactLastName = $_POST['contactLastName'];
		
		$clean_input = preg_replace('/[^a-zA-Z]/', '', $contactLastName);

		try {
			 $pdo = new PDO('mysql:host=localhost;dbname=classicmodels', 'root', '');
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
			
		$test = $pdo->query("	SELECT contactFirstName, contactLastName 
								FROM customers 
								WHERE contactLastName = '$clean_input' LIMIT 10;");

		if($test->rowCount() == 0){
			echo "No records found";
		}

		else{
			
			echo "<strong>Full name:</strong><br>";
			
			while($row = $test->fetch()){
				echo $row['contactFirstName'] . " " . $row['contactLastName'] . "</br>";
			}
		}
	}
	
?>