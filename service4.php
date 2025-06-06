<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Special Offers | YourStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .hero {
      background: linear-gradient(to right,rgb(238, 0, 255),rgb(1, 255, 196));
      color: #fdf0d5;
      padding: 60px 0;
      text-align: center;
    }
    .icon-box {
      background: #136f63;
      border-radius: 12px;
      color: #000;
      padding: 30px;
      transition: all 0.3s;
    }
    .icon-box:hover {
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .icon {
      font-size: 40px;
      color:rgb(247, 118, 6);
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="display-4 fw-bold">Exciting Special Offers</h1>
      <p class="lead">Grab the best deals, discounts, and limited-time offers before they’re gone!</p>
    </div>
  </section>

  <!-- Offers Highlights -->
  <section class="py-5">
    <div class="container">
      <div class="row text-center g-4">
        <div class="col-md-4">
          <div class="icon-box">
            <div class="icon mb-3"><i class="bi bi-tag-fill"></i></div>
            <h5 class="fw-bold">Seasonal Discounts</h5>
            <p>Shop now and save big during our Summer Sale. Up to 50% off on select items!</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box">
            <div class="icon mb-3"><i class="bi bi-gift-fill"></i></div>
            <h5 class="fw-bold">Buy 1 Get 1 Free</h5>
            <p>Exclusive BOGO deals on fashion, accessories, and more – for a limited time only.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box">
            <div class="icon mb-3"><i class="bi bi-stars"></i></div>
            <h5 class="fw-bold">Member-Only Perks</h5>
            <p>Sign up to unlock secret deals, early access, and exclusive coupons.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How to Avail Offers -->
  <section class="bg-light py-5">
    <div class="container text-center">
      <h2 class="mb-4">How to Avail These Offers</h2>
      <div class="row g-4">
        <div class="col-md-3">
          <div class="icon-box">
            <div class="icon mb-2"><i class="bi bi-search"></i></div>
            <h6>1. Browse Offers</h6>
            <p>Visit our <a href="/offers" class="text-decoration-underline">Offers Page</a> to view all active deals.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="icon-box">
            <div class="icon mb-2"><i class="bi bi-cart-plus-fill"></i></div>
            <h6>2. Add to Cart</h6>
            <p>Pick products included in the offer and add them to your cart.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="icon-box">
            <div class="icon mb-2"><i class="bi bi-percent"></i></div>
            <h6>3. Apply Code</h6>
            <p>Use promo codes at checkout to get instant discounts.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="icon-box">
            <div class="icon mb-2"><i class="bi bi-bag-check-fill"></i></div>
            <h6>4. Checkout & Save</h6>
            <p>Enjoy your products at great prices with easy checkout.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="py-5 text-center bg-warning text-white">
    <div class="container">
      <h3 class="mb-3">Deals You Don't Want to Miss</h3>
      <p>Special offers change weekly. Shop now to grab them before they’re gone!</p>
      <a href="home.php" class="btn btn-dark btn-lg">View All Offers</a>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
