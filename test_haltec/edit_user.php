<?php
include 'conn.php';

$userId = $_GET['id'] ?? '';
$user_data = mysqli_query($conn, "SELECT * FROM user WHERE id = $userId");
$user_data = mysqli_fetch_array($user_data);
$roles_data = mysqli_query($conn, "SELECT roles FROM user_roles WHERE id_user = $userId");
$roles_data = mysqli_fetch_array($roles_data);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $roles = $_POST['roles'] ?? '';

    $updateUserQuery = "UPDATE user SET username='$username', password='$password' WHERE id=$userId";
    if (mysqli_query($conn, $updateUserQuery)) {
        $updateRoleQuery = "UPDATE user_roles SET roles='$roles' WHERE id_user = $userId";
        if (mysqli_query($conn, $updateRoleQuery)) {
            header("Location: dashboard.php?roles=admin");
            exit();
        } else {
            header("Location: edit_user.php?id=$userId");
            exit();
        }
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit user</title>
</head>
<body>
    <h1 style="text-align:center">Dashboard</h1>
    <form action="" method="post">
        <label for="username">username : </label>
        <input type="text" id="username" name="username" value="<?= $user_data['username'] ?>" ><br>
        <label for="password">password : </label>
        <input type="password" id="password" name="password" value="<?= $user_data['password'] ?>"><br>
        <label for="roles">roles : </label>
        <select id="roles" name="roles" value="<?= $roles_data['roles'] ?>">
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select><br>
        <input type="submit" value="Edit User">
    </form>
</body>
</html>