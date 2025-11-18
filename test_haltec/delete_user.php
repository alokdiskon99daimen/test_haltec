<?php
include 'conn.php';

$userId = $_GET['id'] ?? '';
$deleteUserQuery = "DELETE FROM user WHERE id = $userId";
if (mysqli_query($conn, $deleteUserQuery)) {
    $deleteRoleQuery = "DELETE FROM user_roles WHERE id_user = $userId";
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