<?php
require_once dirname(__FILE__).'/../../Controllers/UserController.php';
 $user=new UserController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Public/styles/style.css">
  <title>Forgot Password</title>
</head>
<body  class="body">
  <div class="container-fluid my-1">
  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
</div>
   <div class="container mt-5 my-4 w-50">
   <form method="post" class="form-group  shadow my-2 mx-3 p-4">
    <h2 class="form-group text-center">Forgot Password</h2>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>
      <button type="submit" class="btn btn-primary mb-4" name="submit">Reset</button>
      <?php 
      session_start();
      $user->isUserExist(); ?>
    </form>
   </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
