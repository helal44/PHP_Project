<?php
    session_start();
    if(!isset($_SESSION['name'])){
      header('Location:../../Pages/Login.php');
      exit();
    }
    
    require_once(dirname(__FILE__).'/../../../Controllers/UserController.php');
    $user=new UserController();
    $data=$user->SearchUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Registration Form</title>
</head>
<body>
  <div class="container-fluid my-1">
  <?php require_once(dirname(__FILE__).'/../../Includes/Navbar.php') ;?>
   <div class="row my-4">

   <div class="col-2">

   </div>
   <div class="col-8">

 
    <form class="form-group shadow  p-4" method="POST" enctype="multipart/form-data" class="form-group">
    <h2 class="text-center">Edit User Form</h2>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $data['name'] ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $data['email'] ?>">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="<?php echo $data['password'] ?>">
      </div>

      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" name="confirmPassword" placeholder="Confirm your password" value="<?php echo $data['password'] ?>">
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
        <span class="my-4 mx-5" >    
                Current Image
                <img src="/project/Public/Images/Users/<?php echo $data['image'] ?>" alt="img" width="80"/>
                </span>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Edit User</button>

      <?php
       $user->updateUser();
       $errors=$user->errors;
       foreach($errors as $key=>$error){
          echo '<p class="text-danger">'.$key.'=>'.$error.'</p>';
       }
       ?>
         
    </form>
   </div>

   </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
