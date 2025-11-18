<?php
include 'conn.php';
session_start();
$roles = $_GET['roles'] ?? '';

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit();
}

if($roles != 'admin' && $roles != 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1 style="text-align:center">Dashboard</h1><br>
    Welcome, <?= $roles ?> <?= $username ?>!<br><br>
    <br>
    <table border="1" style="width:100%; text-align:center">
        <?php if($roles == 'admin') : ?>
        <h1>ADMIN</h1>
        <a href="create_user.php">create</a>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>password</th>
            <th>roles</th>
            <th></th>
        </tr>
        <?php
        $users = mysqli_query($conn, "SELECT * FROM user ORDER BY id ASC");
        foreach ($users as $user_data) {
        ?>
        <tr>
            <td><?= $user_data['id']; ?></td>
            <td><?= $user_data['username']; ?></td>
            <td><?= $user_data['password']; ?></td>

            <?php 
            $roles = mysqli_query($conn, "SELECT roles FROM user_roles WHERE id_user = " . $user_data['id']);
            $roles = mysqli_fetch_array($roles);
            ?>
            <td><?= $roles['roles']; ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user_data['id'] ?>">edit</a>
                <a href="delete_user.php?id=<?= $user_data['id'] ?>">delete</a>
            </td>
        <?php } ?>
    </table>
    <?php endif;

    if($roles == 'user' || $roles == 'admin') : ?>
    <h1>USER</h1>
    <?php endif ?>
</body>

</html>

