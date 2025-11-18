<?php
include 'conn.php'; //ngambil koneksi db
session_start(); //start session untuk nyimpen session 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //pengkondisian kalo form diinput dengan method post
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $validation_query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'"; //query untuk validasi login
    $result = mysqli_query($conn, $validation_query);
    if (mysqli_num_rows($result) > 0) { //kalo hasil query lebih dari 0 atau ada datanya
        $user = mysqli_fetch_array($result); //ngambil data user sesuai query tadi
        $roles_query = "SELECT roles FROM user_roles WHERE id_user = " . $user['id']; //ngambil data roles buat ditaruh di url link dengan method get, dan naruh di session
        $roles_result = mysqli_query($conn, $roles_query);
        $roles_data = mysqli_fetch_array($roles_result);
        $roles = $roles_data['roles'];

        $_SESSION['username'] = $user['username']; //mengisi session username dengan username login saat ini
        $_SESSION['roles'] = $roles; //mengisi session roles dengan roles user saat ini
        header("Location: dashboard.php?roles=$roles"); //mengarahkan ke dashboard dengan tambahan method get roles untuk validator di dashboard nanti
        exit();
    } else { //error handling kalo result dari query validasi tadi 0
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
