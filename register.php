
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Sign In</title>
  <link rel="stylesheet" href="register.css"/>
</head>
<body>
<?php
$con = mysqli_connect('localhost', 'root', '', 'ecom');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO users (Name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Registration failed!');</script>";
    }
    $stmt->close();
}
?>
  <div class="wrapper">
    <div class="form-header">
      <div class="titles">
        <div class="title-login">Sign_In</div>
      </div>
    </div>
    <!-- SIGN IN FORM -->
    <form class="login-form" autocomplete="off" method="POST" action="">
      <div class="input-box">
        <input type="text" class="input-field" id="log-username" name="name" required>
        <label for="log-username" class="label">Username</label>
        <i class='bx bx-user icon'></i>
      </div>
      <div class="input-box">
        <input type="email" class="input-field" id="log-email" name="email" required>
        <label for="log-email" class="label">Email</label>
        <i class='bx bx-envelope icon'></i>
      </div>
      <div class="input-box">
        <input type="password" class="input-field" id="log-pass" name="password" required>
        <label for="log-pass" class="label">Password</label>
        <i class='bx bx-lock-alt icon'></i>
      </div>
      <div class="form-cols">
        <div class="col-1"></div>
        <div class="col-2">
          <a href="#">Forgot password?</a>
        </div>
      </div>
      <div class="input-box">
        <button class="btn-submit" id="SignInBtn" name="submit" type="submit">Sign In <i class='bx bx-log-in'></i></button>
      </div>
      <div class="switch-form">
        <span>Already have an account? <a href="login.php">Login</a></span>
      </div>
    </form>
  </div>
</body>
</html>