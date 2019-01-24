<html>

<head>

	<title>Unit 2 Demo</title>
	
</head>

<body>

	<font size="6">SQLI</font></br>
	<font size="4">Demo 2</font></br></br>

	<form action="demo2.php" method="POST">
		<select name="contactLastName">
			<option value="Schmitt">Schmitt</option>
			<option value="King">King</option>
			<option value="Nelson">Nelson</option>
		</select>
	<input type="submit" value="Submit">
	</form>

</body>

</html>


<?php

	if(isset($_POST['contactLastName'])){

		$contactLastName = $_POST['contactLastName'];

		try {
			 $pdo = new PDO('mysql:host=localhost;dbname=classicmodels', 'root', '');
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
			
		$test = $pdo->query("	SELECT contactFirstName, contactLastName 
								FROM customers 
								WHERE contactLastName = '$contactLastName' LIMIT 10;");

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