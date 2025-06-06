<?php
$conn = mysqli_connect("localhost", "root", "", "ecom");
$sql = "SELECT * FROM categories WHERE group_name='Men' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Men's Product Categories</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    background: linear-gradient(135deg, #dc8929 50%, #0d1936 50%) !important;
    }

    header {
      background-color: #136f63;
      color: #fdf0d5;
      padding: 1rem;
      text-align: center;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      padding: 2rem;
      max-width: 1200px;
      margin: auto;
    }

    .card {
      background: #fdf0d5;
      border-radius: 10px;
      border:rgb(0, 0, 0) 2px solid;
      box-shadow: 3px 3px 15px #e5e5e5;
      overflow: hidden;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-content {
      padding: 1rem;
    }

    .card-content h3 {
      margin: 0 0 10px;
      font-size: 1.2rem;
      color: #333;
    }

    .card-content p {
      color: #666;
      font-size: 0.95rem;
    }
  </style>
</head>

<body>
  <header>
    <h1>Men's Product Categories</h1>
  </header>
  <div class="container">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="card">';
      echo '<a href="category_products.php?cat_id=' . $row['id'] . '">';
      echo '<img src="uploads/categories/' . htmlspecialchars($row['photo']) . '" alt="' . htmlspecialchars($row['name']) . '">';
      echo '</a>';
      echo '<div class="card-content">';
      echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
      echo '<p>' . htmlspecialchars($row['description']) . '</p>';
      echo '</div>';
      echo '</div>';
    }
    ?>

  </div>
</body>

</html>