<?php
$conn = mysqli_connect("localhost", "root", "", "ecom");
$user_ip = $_SERVER['REMOTE_ADDR'];

// Fetch cart items
$sql = "SELECT c.id, c.quantity, p.product_name, p.price, p.image 
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_ip = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_ip);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count items in cart
$count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cart WHERE user_ip = '$user_ip'");
$row_count = mysqli_fetch_assoc($count_result);
$cart_count = $row_count['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #0D1936;
            color: #fff;
        }
        img {
            max-width: 60px;
            height: auto;
        }
        button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #c82333;
        }
        input[type='number'] {
            width: 60px;
            padding: 5px;
        }
        .checkout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .checkout-button {
            font-weight: bold;
            text-decoration: none;
            background: #dc8929;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .checkout-button:hover {
            background: #218838;
        }
        @media only screen and (max-width: 564px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                text-align: left;
            }
            img {
                max-width: 100px;
            }
        }
    </style>
</head>
<body>

<h2>Your Cart</h2>
<table>
    <tr>
        <th>Image</th>
        <th>Product</th>
        <th>Price (₹)</th>
        <th>Quantity</th>
        <th>Total (₹)</th>
        <th>Action</th>
    </tr>
    <?php
    $grand_total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total = $row['price'] * $row['quantity'];
        $grand_total += $total;
        echo "<tr>
            <td><img src='uploads/products/" . htmlspecialchars($row['image']) . "' alt='Product'></td>
            <td>" . htmlspecialchars($row['product_name']) . "</td>
            <td>₹" . number_format($row['price'], 2) . "</td>
            <td><input type='number' value='" . $row['quantity'] . "' min='1' onchange='updateQuantity(" . $row['id'] . ", this.value)'></td>
            <td>₹" . number_format($total, 2) . "</td>
            <td><button onclick='removeFromCart(" . $row['id'] . ")'>Remove</button></td>
        </tr>";
    }
    ?>
    <tr>
        <td colspan="4" style="text-align:right;"><strong>Grand Total:</strong></td>
        <td colspan="2"><strong>₹<?= number_format($grand_total, 2) ?></strong></td>
    </tr>
</table>

<div class="checkout-link">
    <button class="checkout-button" onclick="proceedToCheckout()">Proceed to Checkout</button>
</div>

<script>
    function proceedToCheckout() {
        var cartCount = <?php echo $cart_count; ?>;
        if (cartCount == 0) {
            alert("Your cart is empty. Please add products before proceeding to checkout.");
        } else {
            window.location.href = "checkout.php";
        }
    }

    function updateQuantity(cartId, newQty) {
        fetch('update_quantity.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'cart_id=' + cartId + '&quantity=' + newQty
        })
        .then(response => response.text())
        .then(data => location.reload());
    }

    function removeFromCart(cartId) {
        if (confirm("Are you sure you want to remove this item?")) {
            fetch('remove_from_cart.php?id=' + cartId)
            .then(response => response.text())
            .then(data => location.reload());
        }
    }
</script>

</body>
</html>
