<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = mysqli_connect("localhost", "root", "", "ecom");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  // Optional: Validate email and phone
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email address!');</script>";
    exit;
  }
  if (!preg_match('/^[0-9\-\+\s\(\)]+$/', $phone)) {
    echo "<script>alert('Invalid phone number!');</script>";
    exit;
  }

  $sql = "INSERT INTO contact_messages (first_name, last_name, email, phone, message)
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$message')";
  if (mysqli_query($conn, $sql)) {
    // Set a flag to show a thank you message after redirect
    session_start();
    $_SESSION['contact_success'] = true;
  } else {
    session_start();
    $_SESSION['contact_error'] = true;
  }
  mysqli_close($conn);
  // Redirect to the same page to prevent resubmission
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>V-mart</title>
  <link rel="stylesheet" href="home.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

</head>

<body class="bg-black">
  <!-- navebar -->
  <nav class="navbar navbar-expand-lg  navbar-glass fixed-top" data-bs-theme="blue">
    <div class="container-fluid">
      <a class="navbar-brand"><i class="bi bi-shop"></i> V-mart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active me-4 " style="font-weight: bolder" aria-current="page" href="#go to home">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active me-4" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="font-weight: bolder">
              Category
            </a>
            <ul class="dropdown-menu custom-dropdown-bg">

              <li><a class="dropdown-item" href="categoryofmen.php"> <i class="bi bi-gender-male"></i> Mens</a></li>
              <li><a class="dropdown-item" href="categoryofwomen.php"> <i class="bi bi-gender-female"></i> Women</a></li>
              <li><a class="dropdown-item" href="categoryofchild.php"><i class="bi bi-balloon"></i> Childrens</a></li>
            </ul>
          </li>


          <li class="nav-item">
            <a class="nav-link active me-4" style="font-weight: bolder" aria-current="page" href="#our-services">Our
              services</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active me-4" style="font-weight: bolder" aria-current="page" href="#contact-us">Contact
              us</a>
          </li>
          <li class="nav-item me-3">
            <a href="view_cart.php" class="btn btn-outline-warning btn-m mt-1">
              <i class="bi bi-cart3"></i> View Cart
            </a>
          </li>

          <li class="nav-item">
            <a class="btn btn-outline-warning btn-m ms-2 mt-1" href="login.php">Login</a>


        </ul>
      </div>
    </div>
  </nav>
  <!-- carousel -->
  <section id="go to home">

    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators ">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active "
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner ">
        <div class="carousel-item active">
          <img src="uploads/8.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>welcome to the E-mart</h5>
            <p>world's No.1 market place.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="uploads/7.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>purchase anything you want</h5>
            <p>world's No.1 market place.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="uploads/9.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>you purchase a products and we sells trust</h5>
            <p>world's No.1 market place.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </section>
  <!-- category -->
  <section id="our-category">
    <div class="container border border-warning-subtle mt-5">
      <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-bold text-warning">Category</h1>

        <p class="fs-5 text-light">This is the category table for potential customers. Here the all pricing
          categories for your products,
          which can help you.</p>
      </div>
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 text-bg-primary border-primary">
              <h4 class="my-0 fw-bold">Men</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">FOR MEN'S PRODUCTS
              </h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>
                  < Men's affortable products>
                </li>
                <li>
                  < Unique style products>
                    </unique>
                </li>
                <li>
                  < Easy return process>
                </li>
                <li>
                  < Product quality>
                </li>
              </ul> <a href="categoryofmen.php"><button type="button" class="w-100 btn btn-lg btn-warning">Go to
                  products</button> </a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 text-bg-primary border-primary">
              <h4 class="my-0 fw-bold">Women</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">FOR WOMEN'S PRODUCTS
              </h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>
                  < Women's affortable products>
                </li>
                <li>
                  < Unique style products>
                    </unique>
                </li>
                <li>
                  < Easy return process>
                </li>
                <li>
                  < Product quality>
                </li>
              </ul> <a href="categoryofwomen.php"><button type="button" class="w-100 btn btn-lg btn-warning">Go to
                  products</button></a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm ">
            <div class="card-header py-3 text-bg-primary border-primary">
              <h4 class="my-0 fw-bold ">Children</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">FOR CHILD'S PRODUCTS
              </h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>
                  < Children's affortable products>
                </li>
                <li>
                  < Unique style products>
                    </unique>
                </li>
                <li>
                  < Easy return process>
                </li>
                <li>
                  < Product quality>
                </li>
              </ul>
              <a href="categoryofchild.php"><button type="button" class="w-100 btn btn-lg btn-warning">Go to
                  products</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- our services -->
  <section id="our-services">
    <h1 class="display-4 fw-bold text-warning text-center mt-5">Services</h1>
    <!-- cards -->
    <div class="container">
      <div class="row mb-2 mt-5">
        <!-- Shipping & Delivery -->
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-warning">V-mart known for speed </strong>
              <h3 class="mb-0 text-white">Fast & Free Delivery</h3>
              <p class="card-text mb-auto text-light">Enjoy fast and secure delivery on all your fashion orders. Free shipping available on eligible purchases.</p>
              <a href="service1.php" class="icon-link gap-1 icon-link-hover stretched-link text-warning text-decoration-none">
                Learn more
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src="uploads/11.jpg" alt="Fast Delivery" class="bd-placeholder-img" height="250" width="230">
            </div>
          </div>
        </div>
        <!-- Easy Returns -->
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-warning">V-mart Easy Returns</strong>
              <h3 class="mb-0 text-white">Easy Returns & Exchanges</h3>
              <p class="card-text mb-auto text-light">Not satisfied? Return or exchange any clothing, bag, or shoes within 30 days. No questions asked.</p>
              <a href="service2.php" class="icon-link gap-1 icon-link-hover stretched-link text-warning text-decoration-none">
                Learn more
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src="uploads/22.jpg" alt="Returns and Exchanges" class="bd-placeholder-img" height="250" width="230">
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2 mt-5">
        <!-- Secure Payment -->
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-warning">V-mart Secure Payments</strong>
              <h3 class="mb-0 text-white">Secure & Flexible Payments</h3>
              <p class="card-text mb-auto text-light">Pay safely using cards, UPI, wallets, and even Buy Now, Pay Later. All payments are encrypted and secure.</p>
              <a href="service3.php" class="icon-link gap-1 icon-link-hover stretched-link text-warning text-decoration-none">
                Learn more
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src="uploads/55.jpg" alt="Secure Payment" class="bd-placeholder-img" height="250" width="230">
            </div>
          </div>
        </div>
        <!-- Special offers -->
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-warning">V-mart Limited offers</strong>
              <h3 class="mb-0 text-white">Special offers</h3>
              <p class="card-text mb-auto text-light">this is the platform, where you can enjoing your benifits as
                special offers.</p> <a href="service4.php" class="icon-link gap-1 icon-link-hover stretched-link text-warning text-decoration-none">
                Learn more
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg> </a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src="uploads/44.jpg" alt="special offers" class="bd-placeholder-img " height="250" width="230">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- contact us -->

  <section id="contact-us">
    <div class="container border border-warning-subtle">
      <h1 class="display-4 fw-bold  text-warning text-center mt-5">Contact us</h1>
      <form class="p-5" method="POST" action="">
        <div class="row mb-3">
          <div class="col">
            <label for="firstName" class="form-label text-light">First Name</label>
            <input type="text" class="form-control" name="first_name" id="firstName" required>
          </div>
          <div class="col">
            <label for="lastName" class="form-label text-light">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="lastName" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label text-light">Email address</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" required>
        </div>
        <div class="mb-3">
          <label for="phoneNumber" class="form-label text-light">Phone Number</label>
          <input type="tel" class="form-control" name="phone" id="phoneNumber" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label text-light">Message</label>
          <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Submit</button>
      </form>
    </div>
  </section>
  <!-- foot -->
  <footer class="py-5 text-center text-body-secondary  mt-5">
    <p class="text-white">share your opinion on <a href="#contact-us"> Message </a> by <a href="#">V-mart</a>.
    </p>
    <div>
      <p class="end"> "Mulakat BDL Aabhar" </p>
    </div>
    <p class="mb-0"> <a href="#">Back to home</a>
    </p>


<img src="uploads/10.jpg" alt="Logo" />
<img src="uploads/9.jpg" alt="Logo" />
<img src="uploads/8.jpg" alt="Logo" />
<img src="uploads/7.jpg" alt="Logo" />
    <p class="text-white mt-3">© 2025 V-mart. All rights reserved.</p>
<div class="social-icons">
   <a href="#"><i class="fab fa-facebook-f"></i></a>
  <a href="#"><i class="fab fa-whatsapp"></i></a>
  <a href="#"><i class="fab fa-twitter"></i></a>
  <a href="#"><i class="fab fa-instagram"></i></a>
</div>


  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>