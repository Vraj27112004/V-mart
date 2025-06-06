<?php
$conn = mysqli_connect("localhost", "root", "", "ecom");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $payment  = mysqli_real_escape_string($conn, $_POST['payment_method']);

    $sql = "INSERT INTO orders1 (customer_name, email, phone, address, payment_method)
            VALUES ('$name', '$email', '$phone', '$address', '$payment')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<div class='success'>
                <h2>Order Placed Successfully!</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Address:</strong> $address</p>
                <p><strong>Payment Method:</strong> $payment</p>
              </div>";
    } else {
        echo "<div class='error'>
                <h2>Something went wrong!</h2>
                <p>" . mysqli_error($conn) . "</p>
              </div>";
    }

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00b09b, #96c93d);
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        .checkout-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            margin-top: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #fff;
            color: #00b09b;
            font-weight: bold;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #00b09b;
            color: #fff;
        }

        .success, .error {
            background: white;
            color: #333;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            margin: 40px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .success h2 {
            color: green;
        }

        .error h2 {
            color: red;
        }

        @media (max-width: 600px) {
            .checkout-container, .success, .error {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <h2>Checkout</h2>
    <form method="POST" action="">
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone</label>
        <input type="text" name="phone" required>

        <label>Address</label>
        <textarea name="address" required></textarea>

        <label>Payment Method</label>
        <select name="payment_method" required>
            <option value="">-- Select --</option>
            <option value="Card">Card</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
        </select>

        <input type="submit" value="Place Order">
    </form>
</div>

</body>
</html>
