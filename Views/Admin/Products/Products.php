<?php 
  session_start();
  if($_SESSION['role'] !='admin'){
    header('Location:../../Pages/Login.php');
    exit();
  }

  require_once(dirname(__FILE__).'/../../../Controllers/ProductController.php');

  $Product=new ProductController();

  $Product->DeleteProduct();
  $data=$Product->ViewProducts();

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../Public/Styles/Style.css">
  <link rel="stylesheet" href="../../../Public/Styles/product.css">
 
  <title>products Page</title>
</head>
<body >
  

<div class="container-fluid my-1">
  <?php require_once dirname(__FILE__) . '/../../Includes/Navbar.php' ?>
</div>

<div class="container">
    <div class="row my-5 mx-2">
            <div class="row w-100">

    <div class="  mx-2 table">
        <div class=" table-header">
                <div class="col text-center">
            <h4>All Products</h4>
          </div>
          <div class="col text-center mb-5">
            <a class="nav-link  " href="./AddProduct.php">Add Product</a>
          </div>
        </div>

        <!-- <div class="row w-100">
                <div class="col-6">
                    <h4 class="text-center">All Products</h4>
                </div>
                <div class="col-6">
                <a class="nav-link text-center" href="./AddProduct.php">Add Product</a>
                </div>
        </div> -->
        <div class="row table-contact">

          <table class="table mx-5 ">
              <thead>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>State</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
              </thead>
              <tbody>
            <?php while($row=mysqli_fetch_assoc($data[0])){?>
              <tr>
                <td><?php echo $row['id'] ?></td>
                <td> <img src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="img" width="50"/></td>
                <td><?php echo $row['name'] ?></td>
                <td >
                  <?php if($row['state']=='available'){
                    echo '<p class="text-success">'.$row['state'].'p';
                  } else{
                    echo '<p class="text-danger">'.$row['state'].'p';
                  }
                  ?>
                  </td>
                <td><?php echo $row['price'] ?></td>
                <td><?php echo $row['category'] ?></td>
                <td>
                <a class="bg-danger " href="Products.php?delete=<?php echo $row['id'] ?>&image=<?php echo $row['image'] ?>">Delete</a>
                <a class="" href="EditProduct.php?search=<?php echo $row['id'] ?>&image=<?php echo $row['image'] ?>">Update</a>
                </td>
              </tr>
              <?php }?>
              </tbody>
          </table>
        </div>

          <div class="text-center m-auto" >
              <?php
                  for ($i = 1; $i <=$data[1]; $i++) {
                  
                      echo "<a class='btn btn-dark ' href='?page=$i'>$i</a> ";
                    
                  }
                
                ?>
          </div>
    </div>
    </div>
</div>
</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
