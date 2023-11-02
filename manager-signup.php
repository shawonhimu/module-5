<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Sign Up Form</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="./style.css" />
	</head>
	<body>
		<div class="overlay"></div>
		<div class="glass-container">
			<div class="glass-login-form">
				<h2>Sign up as Manager</h2>
				<form action="" method="POST">
					<div class="input-container">
						<label for="username">Username</label>
						<input type="text" id="username" name="username" placeholder="Enter your username" required />
					</div>
                    <div class="input-container">
						<label for="email">Email</label>
						<input type="text" id="email" name="email" placeholder="Enter your email" required />
                        <input type="hidden" name="status" value="manager">
					</div>
					<div class="input-container">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" placeholder="Enter your password" required />
					</div>
					<button type="submit" class="btn-login">Sign Up</button>

						<?php

$file_paths = "/Users/Lenovo/Desktop/php practice/module-5/login-form/data.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $status = $_POST["status"];
    $password = $_POST["password"];

    $data = [
        'username' => $username,
        'email' => $email,
        'status' => $status,
        'password' => $password,
    ];
    // print_r($data);

    $existing_data = [];

    if (file_exists($file_paths)) {
        $existing_data = json_decode(file_get_contents($file_paths), true);
    }
    // Append the new JSON data to the existing data
    $existing_data[] = $data;

    // Write the updated data structure back to the file
    file_put_contents($file_paths, json_encode($existing_data, JSON_PRETTY_PRINT));

}

?>
				</form>
                <hr>
				<a class="btn btn-success" href="./admin-signup.php">Admin Sign Up</a>
				<a class="btn btn-secondary" href="./user-signup.php">User Sign Up</a>
				<hr>
				<p>Already have account ? </p>
				<a class=" btn btn-login" href="./index.php">Sign in</a>
			</div>
		</div>
	</body>
</html>

