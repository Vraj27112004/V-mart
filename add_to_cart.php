<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ecom");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page with a message
    header("Location: login.php?error=login_required");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$cat_id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;

if ($product_id <= 0) {
    header("Location: category_products.php?cat_id=$cat_id&error=invalid_product");
    exit;
}

// Check if product already in cart
$check_sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = mysqli_prepare($conn, $check_sql);
mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Update quantity
    $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "ii", $user_id, $product_id);
    mysqli_stmt_execute($update_stmt);
} else {
    // Insert new item
    $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    $insert_stmt = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($insert_stmt, "ii", $user_id, $product_id);
    mysqli_stmt_execute($insert_stmt);
}

// Update cart count in session
$count_result = mysqli_query($conn, "SELECT SUM(quantity) AS total FROM cart WHERE user_id = $user_id");
$count_row = mysqli_fetch_assoc($count_result);
$_SESSION['cart_count'] = $count_row['total'] ?? 0;

// Redirect back to category_products page
header("Location: category_products.php?cat_id=$cat_id");
exit;
?>
