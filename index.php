<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Login Form</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="./style.css" />
	</head>
	<body>
		<div class="overlay"></div>
		<div class="glass-container">
			<div class="glass-login-form">
				<h2>Login</h2>
				<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    session_start();

    $file_paths = "/Users/Lenovo/Desktop/php practice/module-5/login-form/data.json";

    $existing_data = [];

    if (file_exists($file_paths)) {
        $existing_data = json_decode(file_get_contents($file_paths), true);
    }

    foreach ($existing_data as $item) {
        if ($item['email'] == $email && $item['password'] == $password) {
            // echo $item['email'];
            // echo $item['email'];

            $_SESSION['email'] = $email;
            $_SESSION['status'] = $item['status'];
            $_SESSION['password'] = md5($password);
            echo $_SESSION['status'];
            if ($_SESSION['email'] == $email && $_SESSION['password'] == md5($password) && $_SESSION['status'] == 'admin') {
                header('location:dashboard.php');
                echo "Login success !";
                $_SESSION['loggedin'] = true;
            } else if ($_SESSION['email'] == $email && $_SESSION['password'] == md5($password) && $_SESSION['status'] == 'manager') {
                header('location:manager.php');
                echo "Login success !";
                $_SESSION['loggedin'] = true;
            } else if ($_SESSION['email'] == $email && $_SESSION['password'] == md5($password) && $_SESSION['status'] == 'user') {
                header('location:user.php');
                echo "Login success !";
                $_SESSION['loggedin'] = true;
            } else {
                $_SESSION['loggedin'] = false;
                header('location:index.php');
            }
            exit;
        }
    }
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>Error!</strong> Something went wrong. Login failed !
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>
				<form action="" method="POST">
					<div class="input-container">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" placeholder="Enter your email" required />
					</div>
					<div class="input-container">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" placeholder="Enter your password" required />
					</div>
					<button type="submit" class="btn-login">Login</button>
				</form>
				<hr>
				<p class="my-3">Don't have account ? </p>

				<a class="btn btn-success" href="./admin-signup.php">Admin Sign Up</a>
				<a class="btn btn-primary" href="./manager-signup.php">Manager Sign Up</a>
				<a class="btn btn-secondary" href="./user-signup.php">User Sign Up</a>
			</div>
		</div>


		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
	</body>
</html>

