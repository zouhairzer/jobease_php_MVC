<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration or Sign Up form in HTML CSS | CodingLab</title>
  <link rel="stylesheet" href="/assets/styles/registerstyle.css">
</head>

<body>
  <div class="wrapper">
    <h2>Login</h2>
    <form method="POST" action="?route=login">
      <div class="input-box">
        <input type="text" name="email" placeholder="Enter your email" required>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Create password" required>
      </div>
      <div class="policy">
        <input type="checkbox" required>
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="submit" value="Login">
      </div>
      <span style="color:red;"></span>
        <div class="signup-link">Not a member? <a href="?route=register">Signup now</a></div>
    </form>
  </div>
</body>

</html>