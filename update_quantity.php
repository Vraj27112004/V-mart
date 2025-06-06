<?php
$conn = mysqli_connect("localhost", "root", "", "ecom");

$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];

if ($cart_id && $quantity > 0) {
    $stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $quantity, $cart_id);
    mysqli_stmt_execute($stmt);
    echo "Updated";
}
?>
