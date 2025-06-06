<?php
$conn = mysqli_connect("localhost", "root", "", "ecom");

$cart_id = $_GET['id'];

if ($cart_id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $cart_id);
    mysqli_stmt_execute($stmt);
    echo "Removed";
}
?>
