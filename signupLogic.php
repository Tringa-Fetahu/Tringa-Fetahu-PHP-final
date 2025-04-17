
<?php
	include_once 'config.php';

if (isset($_POST['submit'])) {

	$username = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST["password"];

	$passwordHash = password_hash($password, PASSWORD_DEFAULT);


	if( empty($username) || empty($email) || empty($password) ){

		echo "You need to fill all the fields";

		header("refresh:2; url=signupForm.php");
		exit;

	}else{

		$sql = "SELECT email FROM users WHERE email=:email";

		$tempSQL = $pdo -> prepare($sql);
		$tempSQL->bindParam(":email", $email);
		$tempSQL->execute();

		if ($tempSQL->rowCount() > 0){
			echo "This email has already been used to open an acount!";

			header("refresh:2; url=signupForm.php");
			exit;
		}else{

			$sql = "INSERT INTO users(full_name, email, password) VALUES (:username, :email, :password)";


			$sqlQuery = $pdo->prepare($sql);

			$sqlQuery->bindParam(":username", $username);
			$sqlQuery->bindParam(":email", $email);
			$sqlQuery->bindParam(":password", $passwordHash);

			$sqlQuery->execute();

			header("Location:signinForm.php");
			exit;
		}
	}
}

?>
