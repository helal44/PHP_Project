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
  <link rel="stylesheet" href="../../Public/Styles/Style.css">
  <title>Registration Form</title>
</head>
<body>
  <div class="container-fluid my-1">
  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
  </div>
    <div class="container">
        <div class="row my-5 mx-2">
  

   <div class="col-12">

 
    <form class="form-group shadow  p-4" method="POST" enctype="multipart/form-data" class="form-group">
    <h2 class="text-center text-white">Registration Form</h2>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>

      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" name="confirmPassword" placeholder="Confirm your password">
      </div>

      <div class="form-group">
        <label for="room">Room No</label>
       <select name="room" id="room" class="form-control">
        <option value="1">Application1</option>
        <option value="2">Application2</option>
        <option value="3">Application3</option>
       </select>
      </div>

      <div class="form-group">
        <label for="image">Choose Image</label>
        <input type="file" class="form-control" id="image" name="image" placeholder="Enter your name">
      </div>
      <button type="submit" class="btn" name="submit">Submit</button>
      <a href="./Login.php" class="nav-link">Login</a>

      <?php
       $user->insertUSer();
       $errors=$user->errors;
       foreach($errors as $key=>$error){
          echo '<p class="text-danger">'.$key.'=>'.$error.'</p>';
       }
       ?>
         
    </form>
   </div>

   </div>
   <img class="background-image" style="position:fixed" src="../../Public/Images/Products/login.jpeg">
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
