<?php 
// стартиране на сесия ( ще трябва по-долу )
session_start();


$servername = "127.0.0.1";
	$username = "root";
	$password = "veselin7";
	$database = "beauty_schema";

try {
  $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if ( isset( $_POST['submit'] ) ) {

	// записване на данните от полетата в променливи за по-удобно

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// зареждане от базата на потребител с въведените от формата име и парола
	
	$stmt = $connection->prepare("SELECT * FROM users WHERE username = ? AND password = ?"); 
	$stmt->execute([ $username, $password ]); 
	$user = $stmt->fetch();
	
	if ( $user ) {
	
		// ако са въведени правилни име и парола се задава масива user в сесията
		
		$_SESSION['user'] = $user;
		
		// пренасочване към страница admin.php
		
		header("location: admin.php");
		exit;
		
	} else {
		
		echo "<b style='color:red;'>Невалидни потребителски данни</b><br><br>";
	}
}
	
?>	

<html>
<head></head>
<body>

	<form method="post">
	<label>Потребителско име:</label><br>
	<input type="text" name="username"><br><br>
	<label>Парола:</label><br>
	<input type="password" name="password"><br><br>
	<input type="submit" name="submit" value="Вход">
	</form>

</body>
</html>
