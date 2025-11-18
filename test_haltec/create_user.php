<?php
include 'conn.php'; //ngambil koneksi

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //ketika form mengirim data dengan method post
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $roles = $_POST['roles'] ?? '';

    $insertUserQuery = "INSERT INTO user (username, password) VALUES ('$username', '$password')"; //query insert ke database tabel user
    if (mysqli_query($conn, $insertUserQuery)) {
        $userId = mysqli_insert_id($conn); //ngambil user id untuk dipake ke inser user_roles

        $insertRoleQuery = "INSERT INTO user_roles (id_user, roles) VALUES ($userId, '$roles')"; //query insert ke database tabel user_roles
        if (mysqli_query($conn, $insertRoleQuery)) {
            header("Location: dashboard.php?roles=admin"); //mengarahkan ke halaman dashboard
            exit();
        } else {
            header("Location: create_user.php");
            exit();
        }
    } else {
        echo "Error inserting user: " . mysqli_error($conn); //error handling
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create user</title>
</head>
<body>
    <h1 style="text-align:center">Dashboard</h1>
    <form action="" method="post">
        <label for="username">username : </label>
        <input type="text" id="username" name="username"><br>
        <label for="password">password : </label>
        <input type="password" id="password" name="password"><br>
        <label for="roles">roles : </label>
        <select id="roles" name="roles">
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select><br>
        <input type="submit" value="Create User">
    </form>
</body>

</html>
