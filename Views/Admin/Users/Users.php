<?php 

    session_start();
    if($_SESSION['role'] !='admin'){
      header('Location:../../Pages/Login.php');
      exit();
    }

  require_once(dirname(__FILE__).'/../../../Controllers/UserController.php');
  $user=new UserController();

  $user->DeleteUSer();
  $data=$user->ViewUSers();

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../Public/Styles/style.css">
  <link rel="stylesheet" href="../../../Public/Styles/product.css">
  <!-- <link rel="stylesheet" href="../../../Public/Styles/users.css"> -->

  <title>Users Page</title>
</head>
<body>
<div class="container-fluid my-1">
        <?php require_once dirname(__FILE__) . '/../../Includes/Navbar.php' ?>
    </div>
 
        <div class="row my-5 mx-2">
       
    <div class="my-5 mx-2 table m-auto">
        <div class="table-header">
             <h4 class="text-center">All Users</h4>
              <a class="nav-link text-center btn mt-0" href="/PHP_Project/Views/Pages/Register.php">Add User</a>
        </div>
        <div class=" row table-contact">
        <table class="table my-5 mx-2 ">
            <thead>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Room</th>
              <th>Role</th>
              <th>Action</th>
            </thead>
            <tbody>
           <?php while($row=mysqli_fetch_assoc($data)){?>
            <tr>
              <td><?php echo $row['id'] ?></td>
              <td> <img src="/PHP_Project/Public/Images/Users/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="50"/></td>
              <td><?php echo $row['name'] ?></td>
              <td><?php echo $row['email'] ?></td> 
              <td><?php echo $row['password'] ?></td>
              <td><?php echo $row['room'] ?></td>
              <td><?php echo $row['role'] ?></td>
              <td>
              <a class="bg-danger" href="Users.php?delete=<?php echo $row['id'] ?>&image=<?php echo $row['image'] ?>">Delete</a>
                     <a class="" href="EditUser.php?search=<?php echo $row['id'] ?>&image=<?php echo $row['image'] ?>">Update</a>
              </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
        </div>
       
    </div>
  </div>
    
         
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>