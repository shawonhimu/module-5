<?php
session_start();
$file_paths = "/Users/Lenovo/Desktop/php practice/module-5/login-form/data.json";
$json_data = file_get_contents($file_paths);
$data = json_decode($json_data, true);

if ($data === null) {
    die("Error parsing JSON data.");
}
if (!($_SESSION['status'] == 'manager' && $_SESSION['email'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style2.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="adminSidebar sidebar">
            <ul class="nav flex-column">
                <div class="role">
                    <i class="fas fa-user"></i>
                    <h4 class="my-3">
                    <?php

if ($_SESSION['status'] == 'admin') {
    echo "Admin";
} else if ($_SESSION['status'] == 'manager') {
    echo "Manager";
} else {
    echo "User";
}
?>
                    </h4>
                </div>
                <hr>
				<li class="nav-item"><a class="nav-link active" href="dashboard.php">Home</a></li>
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
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div>
                    <h6 class="btn btn-warning" >All details </h6>
                </div>
                <hr>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key => $person): ?>
                            <tr>
                                <td><?php echo $person['username']; ?></td>
                                <td><?php echo $person['email']; ?></td>
                                <td><?php echo $person['status']; ?></td>
                                <td>
                                    <a class='btn btn-success' href='edit-user.php?data=<?php echo urlencode($key); ?>'>Edit</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
            </div>
        </div>

    </div>

    <!-- Script -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

</body>
</html>
