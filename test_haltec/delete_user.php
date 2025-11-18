<?php
include 'conn.php'; //ngambil koneksi

$userId = $_GET['id'] ?? ''; //ngambil id dari url link dengan method get
$deleteUserQuery = "DELETE FROM user WHERE id = $userId"; //query delete
if (mysqli_query($conn, $deleteUserQuery)) {
    $deleteRoleQuery = "DELETE FROM user_roles WHERE id_user = $userId"; //query delete roles
    if (mysqli_query($conn, $deleteRoleQuery)) {
        header("Location: dashboard.php?roles=admin");
        exit();
    } else {
        echo "Error deleting user roles: " . mysqli_error($conn);
    }
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}

?>
