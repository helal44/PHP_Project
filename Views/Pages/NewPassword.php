<?php
require_once dirname(__FILE__) . '/../../Controllers/UserController.php';
$user = new UserController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/style.css">
  <title>New Password</title>
</head>
<body>
  <div class="container-fluid my-1">
    <?php require_once dirname(__FILE__) . '/../Includes/Navbar.php'; ?>
      </div>
      <div class="container mt-5 my-4 w-50">
        <form method="post" class="form-group  shadow my-2 mx-3 p-4">
          <h2 class="form-group text-center">New Password</h2>
          <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" name="confirmPassword" placeholder="Confirm your password">
      </div>
          <button type="submit" class="btn btn-primary mb-4" name="submit">Update</button><br>
          <?php $user->restPass(); ?>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>