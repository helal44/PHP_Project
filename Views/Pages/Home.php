<?php 
session_start();
if(!isset($_SESSION['role'])){
  header('Location:./Login.php');
  exit();
}

require_once(dirname(__FILE__).'/../../Controllers/ProductController.php');
require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');


$order=new OrderController();

$lastOrders=$order->LastUSerDoneOrders();


$Product=new ProductController();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Public/Styles/Style.css">
  <title>Home Page</title>
</head>
<body>


  <div class="container-fluid my-1">

  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;
   require_once(dirname(__FILE__).'/../Includes/SearchBar.php') ;?>

            <?php
            //  require_once(dirname(__FILE__).'/../Includes/SearchBar.php') ;
             ?>

            <?php if($lastOrders ) {?>

              <h4 class=" text-center text-primary">Last Orders</h4>
              <div class=" d-flex flex-wrap justify-content-center ">

                <?php 
               
                 while($row=mysqli_fetch_assoc($lastOrders)){
                  ?>
                    <div class=" card m-3 align-items-center shadow p-2  ">
                      <img class="card-image " src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                      <div class="card-body">
                          <h2 class="card-title"><?php echo $row['name'] ?></h2>
                          
                      </div>
                      </div>
                  <?php
                 }

                ?>
               

              </div>
              <!-- <hr> -->
               
              <?php }
              
              $order->AddItem() ;
              ?>
             
                  <!-- <hr> -->
               
            <div class=" d-flex flex-wrap justify-content-center ">
              <?php
              
               $products=$Product->SearchProductByName();

                 $ProductData=$Product->ViewProducts();
               

                  if($products){
                    while($row=mysqli_fetch_assoc($products)){
                      if($row['state']=='available'){
                      ?>
                      <div class=" card m-3 align-items-center shadow p-2  ">
                      <img class="card-image " src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                      <div class="card-body">
                          <h2 class="card-title"><?php echo $row['name'] ?></h2>
                          <h4 class="card-text"><?php echo $row['price'] ?> EGP</h4>
                          <a href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>" >Add to list</a>
                      </div>
                      </div>
                    <?php } }
                  }

                  else{
                    while($row=mysqli_fetch_assoc($ProductData[0])){
                      if($row['state']=='available'){
                      ?>
                      <div class=" card m-3 align-items-center shadow p-2  ">
                      <img class="card-image " src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                      <div class="card-body">
                          <h2 class="card-title"><?php echo $row['name'] ?></h2>
                          <h4 class="card-text"><?php echo $row['price'] ?> EGP</h4>
                          <a href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>" >Add to list</a>
                      </div>
                      </div>
                    <?php } }
                  }

               

              ?>
              
            </div>

           <div d-flex flex-wrap justify-content-center >
            <?php
                for ($i = 1; $i <=$ProductData[1]; $i++) {
                
                    echo "<a class='btn btn-primary mx-2' href='?page=$i'>$i</a> ";
                  
                }
              
              ?>
           </div>
         
<img class="background-image" src="../../Public/Images/Products/cup.jpg">
</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
