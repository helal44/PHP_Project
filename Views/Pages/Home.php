<?php 
session_start();
if(!isset($_SESSION['role'])){
  header('Location:./Login.php');
  exit();
}

require_once(dirname(__FILE__).'/../../Controllers/ProductController.php');
require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');


$order=new OrderController();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Home Page</title>
</head>
<body>
  <div class="container-fluid my-1">

  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
   
   
            <div class="mx-2 border-bottom-2 border-bottom-color-primary text-center">
              

              <span class=" text-center text-warning"><?php  $order->AddItem() ?></span>
            </div>
            
            <div class=" d-flex flex-wrap justify-content-center ">
              <?php
                $Product=new ProductController();
                $ProductData=$Product->ViewProducts();

              while($row=mysqli_fetch_assoc($ProductData)){
                if($row['state']=='available'){
                ?>
                <div class=" card m-3 align-items-center shadow p-2  ">
                <img class="card-image " src="/project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                <div class="card-body">
                    <h2 class="card-title"><?php echo $row['name'] ?></h2>
                    <h4 class="card-text"><?php echo $row['price'] ?>$</h4>
                    <a href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>" >Add to list</a>
                </div>
                </div>
              <?php } } ?>
              
            </div>
         
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
