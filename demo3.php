<html>

<head>

	<title>Unit 2 Demo</title>
	
</head>

<body>

	<font size="6">SQLI</font></br>
	<font size="4">Demo 3</font></br></br>

	<form action="demo3.php" method="POST">
	Username: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
	<input type="submit" value="Submit">
	</form>

</body>

</html>


<?php

	if(isset($_POST['username']) && isset($_POST['password'])){

		$username = $_POST['username'];
		$password = $_POST['password'];
		
		try {
			 $pdo = new PDO('mysql:host=localhost;dbname=login', 'root', '');
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
			
		$test = $pdo->query("	SELECT username, password
								FROM accounts
								WHERE username = '$username' AND password = '$password';");

		if($test->rowCount() == 0){
			echo "Login failed";
		}

		else{
			echo "you're in";
		}
	}
	
?>