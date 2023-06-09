<?php 
session_start();
if($_SESSION['role'] !='admin'){
  header('Location:../../Pages/Login.php');
  exit();
}


require_once(dirname(__FILE__).'/../../../Controllers/ProductController.php');

$Product=new ProductController();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Add Product</title>
</head>
<body>
  <div class="container-fluid my-1">

  <?php require_once(dirname(__FILE__).'/../../Includes/Navbar.php') ?>
    <div class="row my-5 mx-5  ">
            <form action="" class="w-100" method="post" enctype="multipart/form-data">
                <h4>Add Product</h4>
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="state" >
                    <option value="">-- Select State --</option>
                    <option value="available">Available</option>
                    <option value="unavalable">UnAvailable</option>
                  
                    
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" >
                    <option value="">-- Select Category --</option>
                    <option value="hotdrink">HotDrink</option>
                    <option value="colddrink">ColdDrink</option>
                    <option value="food">Food</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" min="0" step="0.1" >
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" >
            </div>
            <button type="submit" class="btn btn-primary my-2" name="addproduct">Submit</button> <br>
            <?php 
                $Product->InsertProduct();
                foreach($Product->errors as $key=>$err){?>
                    <span class="text-danger"><?php echo '<br><br>'.$key .'=>'.$err ?></span>
                <?php } ?>
        </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
