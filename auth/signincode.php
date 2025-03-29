<?php

$nameErr = $emailErr = $passwordErr = $fileErr = $confirmPasswordErr = "";
$name = $email = $file = $password  = $confirmPassword = "";
$messageError = $messageSuccess = "";
$validationOk = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['signinbtn'])) {
	if (empty($_POST["signinname"])) {
		$nameErr = "Name is required";
		$validationOk = 0;
	} else {
		$name = test_input($_POST["signinname"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
			$nameErr = "Only letters and white space allowed";
			$validationOk = 0;
		}
	}

	if (empty($_POST["signinemail"])) {
		$emailErr = "Email is required";
		$validationOk = 0;
	} else {
		$email = test_input($_POST["signinemail"]);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			$validationOk = 0;
		}
	}

	if (empty($_POST["signinpassword"])) {
		$passwordErr = "Password is required";
		$validationOk = 0;
	} else {
		$password = $_POST["signinpassword"];
	}

	if (empty($_POST["signinconfirmpassword"])) {
		$confirmPasswordErr = "Confirm Password is required";
		$validationOk = 0;
	} else {
		$confirmPassword = $_POST["signinconfirmpassword"];
	}

	if (!empty($password) && !empty($confirmPassword)) {
		if ($confirmPassword !== $password) {
			$confirmPasswordErr = "Password don't match";
			$validationOk = 0;
		}
	}

	// if ($validationOk == 1) {
	// 	$sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
	// 	if (mysqli_query($conn, $sql)) {
	// 		$messageSuccess = "Account created successfully";
	// 	} else {
	// 		$messageError = "Account creation failed";
	// 	}
	// }

	if ($validationOk == 1) {
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	
		$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $email, $hashedPassword);
	
		if ($stmt->execute()) {
			$messageSuccess = "Account created successfully";
		} else {
			$messageError = "Account creation failed";
		}
		
		$stmt->close();
	}
	
}
