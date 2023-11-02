<?php

session_start();

$file_paths = "/Users/Lenovo/Desktop/php practice/module-5/login-form/data.json";
$json_data = file_get_contents($file_paths);
$data = json_decode($json_data, true);

if ($data === null) {
    die("Error parsing JSON data.");
}

if (isset($_GET['data'])) {
    $decoded_value = urldecode($_GET['data']);
}

if (!(($_SESSION['status'] == 'admin' && $_SESSION['email']) || ($_SESSION['status'] == 'manager' && $_SESSION['email']))) {
    header('location:dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="style2.css" />
		<title>Dashboard</title>
	</head>
	<body>
		<div class="dashboard">
			<!-- Sidebar -->
			<div class="adminSidebar sidebar">
				<ul class="nav flex-column">
					<div class="role">
						<i class="fas fa-user"></i>
						<h4 class="my-3">Admin</h4>
					</div>
					<hr />
					<li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
					<li class="nav-item"><a class="nav-link active" href="#">Edit</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
				</ul>
			</div>

			<!-- Content area -->
			<div class="adminContent">
				<!-- Topbar -->
				<div class="topbar px-3 py-3 d-flex justify-content-between">
					<div>
						<h3>Home</h3>
					</div>
					<div>
						<a class="btn btn-danger" href="">Logout</a>
					</div>
				</div>

				<div class="dashboard-card px-5">
                    <h5>Edit this role</h5>
                    <hr>
					<form action="" method="POST" >
						<div class="input-container">
							<label for="username">Username</label>
							<input class="form-control" type="text" id="username" name="username" placeholder="Enter your username" required value="<?php echo ($data[$decoded_value]['username']); ?>" />
						</div>
						<div class="input-container">
							<label for="email">Email</label>
							<input class="form-control" type="text" id="email" name="email" placeholder="Enter your email" required value="<?php echo ($data[$decoded_value]['email']); ?>" />
						</div>
						<div class="input-container">
							<label for="email">Select Role</label>
							<select class="form-select" aria-label="Default select example" name="status" required>
								<option value="admin" <?php $select = $data[$decoded_value]['status'] == 'admin' ? "selected" : "";
echo $select;?> >admin</option>
								<option value="manager" <?php $select = $data[$decoded_value]['status'] == 'manager' ? "selected" : "";
echo $select;?> >manager</option>
								<option value="user" <?php $select = $data[$decoded_value]['status'] == 'user' ? "selected" : "";
echo $select;?> >user</option>
							</select>
						</div>
						<div class="input-container">
							<label for="password">Password</label>
							<input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" required
                            value="<?php echo ($data[$decoded_value]['password']); ?>" />
						</div>
                        <div class="d-flex justify-content-between">

						    <button type="submit" class="btn btn-primary my-4">Save changes</button>
                            <a class="btn btn-secondary my-4" href="dashboard.php">Go Back</a>
                        </div>
					</form>
				</div>
			</div>
		</div>

		<!-- Script -->

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
<?php

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
    //Edit
    $existing_data[$decoded_value] = $data;

    file_put_contents($file_paths, json_encode($existing_data, JSON_PRETTY_PRINT));
    header("location:dashboard.php");

}

?>