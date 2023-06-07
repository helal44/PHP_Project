<?php
require_once(dirname(__FILE__).'/../../Controllers/UserController.php');
 $user=new UserController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/style.css">
  <title>Login Form</title>
</head>
<body>
  <div class="container-fluid my-1">
  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
   <div class="row my-4 ">
   <div class="col-2">

   </div>
   <div class="col-8">
   <form method="post" class="form-group  shadow my-2 mx-3 p-4">
    <h2 class="form-group text-center">Login Form</h2>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Login</button>

      <a href="./Register.php" class="nav-link">Register</a>

      <?php $user->CheckUserExist(); ?>
    </form>
   </div>
   </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
