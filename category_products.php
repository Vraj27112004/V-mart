<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ecom");

$cart_count = $_SESSION['cart_count'] ?? 0;
$cat_id = $_GET['cat_id'] ?? 0;
$search = $_GET['search'] ?? '';

// Fetch category info
$cat_sql = "SELECT * FROM categories WHERE id = $cat_id";
$cat_result = mysqli_query($conn, $cat_sql);
$category = mysqli_fetch_assoc($cat_result);

// Fetch products for this category
$sql = "SELECT * FROM products WHERE category_id = $cat_id";
if ($search !== '') {
    $search_escaped = mysqli_real_escape_string($conn, $search);
    $sql .= " AND product_name LIKE '%$search_escaped%'";
}
$sql .= " ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #dc8929 50%, #0d1936 50%) !important;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 0 0 20px 0;
            font-size: 2rem;
            color: #fdf0d5;
            margin-top: 0px;
            margin-bottom: 20px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-weight: bold;
        }

        header {
            background-color: #136f63;
            color: #fdf0d5;
            padding: 2.5rem;
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto 40px;
            padding: 0 20px;
            align-items: stretch;
        }

        .card {
            width: 277px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 450px;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            padding: 10px;
            background-color: #fdf0d5;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: rgb(255, 255, 255);
        }

        .card-content {
            padding: 1rem;
            flex: 1;
        }

        .card-content h3 {
            margin: 0 0 10px;
            font-size: 1.1rem;
            color: #333;
        }

        .card-content p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .buy-now-btn,
        .add-to-cart-btn {
            background-color: rgb(0, 123, 255);
            color: #fff;
            border: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-top: 10px;
        }

        .add-to-cart-btn:hover,
        .buy-now-btn:hover {
            background-color: rgb(0, 165, 33);
        }

        .search-container {
            max-width: 300px;
            margin: 20px auto 0;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin-bottom: 60px;
            padding: 7px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            position: relative;
            top: 20px;
            left: 30%;
        }

        .search-container input[type="text"] {
            flex: 1;
            padding: 8px 12px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            color: black;
            width: 100%;
        }

        .search-container button {
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            background-color: rgb(47, 0, 237);
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .search-container button:hover {
            background-color: rgb(0, 91, 18);
        }

        .cart-icon {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
        }
        @media only screen and (max-width: 564px)
        {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
                margin-bottom: 20px;
            }

            .search-container {
                width: 90%;
                left: 10%;
            }

            header h1 {
                font-size: 1.5rem;
            }
            .cart-icon {
                position: flex;
                margin-top: 50px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div style="position: absolute; top: 20px; right: 30px;">
            <a href="view_cart.php" style="text-decoration: none; color: white; position: relative;">
                <i class="bi bi-cart3" style="font-size: 24px; display: block;"></i>
                <?php if ($cart_count > 0): ?>
                    <span class="cart-count"><?= $cart_count ?></span>
                <?php endif; ?>
            </a>
        </div>
        <h1>
            <i class="bi bi-box-seam"></i>
            <?= $category ? htmlspecialchars($category['name']) : "Products" ?>
            <i class="bi bi-box-seam"></i>
        </h1>
    </header>

    <form method="GET" action="" class="search-container">
        <input type="hidden" name="cat_id" value="<?= htmlspecialchars($cat_id) ?>" />
        <input type="text" name="search" placeholder="Search product name..." value="<?= htmlspecialchars($search) ?>" />
        <button type="submit">Search</button>
    </form>

    <div class="container">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '  <img src="uploads/products/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['product_name']) . '">';
                echo '  <div class="card-content">';
                echo '    <h3>' . htmlspecialchars($row['product_name']) . '</h3>';
                echo '    <p>' . htmlspecialchars($row['description']) . '</p>';
                echo '    <p style="font-weight:bold; color:#007bff;">Price: ₹' . htmlspecialchars($row['price']) . '</p>';
                echo '    <p>Available Stock: ' . htmlspecialchars($row['stock']) . '</p>';
                echo '    <button class="buy-now-btn">Buy Now</button>';
                echo '    <button class="add-to-cart-btn" onclick="addToCart(' . $row['id'] . ', ' . $cat_id . ')">Add to Cart</button>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center; color:white;'>No products found.</p>";
        }
        ?>
    </div>

    <script>
function addToCart(productId, catId) {
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `product_id=${productId}&cat_id=${catId}`
    })
    .then(response => {
        if (!response.ok) throw new Error("Request failed.");
        return response.text();
    })
    .then(() => {
        // Update cart count by fetching session value or increasing manually
        fetch('get_cart_count.php')
            .then(res => res.json())
            .then(data => {
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    cartCount.textContent = data.count;
                } else {
                    const icon = document.querySelector('.bi-cart3');
                    const span = document.createElement('span');
                    span.className = 'cart-count';
                    span.textContent = data.count;
                    icon.parentNode.appendChild(span);
                }
            });
    })
    .catch(err => console.error("Error:", err));
}
</script>

</body>

</html>