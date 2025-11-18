<?php
include 'conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $validation_query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $validation_query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);
        $roles_query = "SELECT roles FROM user_roles WHERE id_user = " . $user['id'];
        $roles_result = mysqli_query($conn, $roles_query);
        $roles_data = mysqli_fetch_array($roles_result);
        $roles = $roles_data['roles'];

        $_SESSION['username'] = $user['username'];
        $_SESSION['roles'] = $roles;
        header("Location: dashboard.php?roles=$roles");
        exit();
    } else {
        echo "Invalid username or password.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">username : </label>
        <input type="text" id="username" name="username"><br>
        <label for="password">password : </label>
        <input type="password" id="password" name="password"><br>
        <input type="submit">
    </form>
</body>
</html>