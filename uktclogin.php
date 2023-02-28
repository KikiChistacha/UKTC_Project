<?php 
// стартиране на сесия ( ще трябва по-долу )
session_start();


$servername = "127.0.0.1";
	$username = "root";
	$password = "veselin7";
	$database = "beauty_schema";


try {
  $connection = new PDO("mysql:host=$servername;dbname=$database", $email, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if ( isset( $_POST['submit'] ) ) {

	// записване на данните от полетата в променливи за по-удобно

	$email = $_POST ['email'];
	$password = $_POST['password'];
	
	// зареждане от базата на потребител с въведените от формата име и парола
	
	$stmt = $connection->prepare("SELECT * FROM users WHERE username = ? AND password = ?"); 
	$stmt->execute([ $email, $password ]); 
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            text-align: center;
        }
    </style>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="/Users/macbookpro/Downloads/af5f998b-d97f-4fc5-9b56-8cb0490bc9e7.jpg.webp"
                class="img-fluid" alt="Phone image" width="2500" height="2500">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <form>
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form1Example13" class="form-control form-control-lg" name="email"/>
                  <label class="form-label" for="form1Example13">Email address</label>
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" />
                  <label class="form-label" for="form1Example23">Password</label>
                </div>
      
                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                  
                </div>
                  <a href="#!">Forgot password?</a>
                </div>
                
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                <p>Don't have an account? <a href="http://127.0.0.1/btylog.php" class="link-info">Register here</a></p>
      
                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                </div>
      
                <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                  role="button">
                  <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                </a>
                <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                  role="button">
                  <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>
                  <a class="btn btn-primary btn-lg btn-block" style="background-color: #08090a" href="#!"
                  role="button">
                  <i class="fab fa-apple"></i>Continue with Apple</a>
                  
      
              </form>
            </div>
          </div>
        </div>
      </section>
      
</body>
</html>