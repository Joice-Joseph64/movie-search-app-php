<?php
require_once "../config/database.php";

$emailLErr = $passwordLErr = "";
$email =  $password  = "";
$messageLError = "";
$validationOk = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['loginsubmit'])) {

	if (empty($_POST["loginemail"])) {
		$emailLErr = "Email is required";
		$validationOk = 0;
	} else {
		$email = test_input($_POST["loginemail"]);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailLErr = "Invalid email format";
			$validationOk = 0;
		}
	}

	if (empty($_POST["loginpassword"])) {
		$passwordLErr = "Password is required";
		$validationOk = 0;
	} else {
		$password = $_POST["loginpassword"];
	}

    if ($validationOk == 1) {
        
        $query = "SELECT id, password FROM users WHERE email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            
            if (password_verify($password, $data['password'])) {
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['login'] = "1";
                header('location: ../home/home.php');
                exit(); 
            } else {
                $messageLError = "Invalid email or password.";
            }
        } else {
            $messageLError = "Invalid email or password.";
        }
    }
}

?>
