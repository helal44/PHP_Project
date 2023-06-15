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

$Product->DeleteProduct();
$data=$Product->ViewProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Public/Styles/footer.css">
  <link rel="stylesheet" href="../../Public/Styles/Style.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Home Page</title>
</head>
<body>


  <div class="container-fluid my-1">

  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ; ?>

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

<img class="background-image" src="../../Public/Images/Products/cup.jpg">
</div>
<br>
<!------------------------------------------ header ---------------------------------------->
<section id="sec1">
  <div class="div1">
    <!-- <h1 class="text-white text-center">Coffee Shop</h1> -->
<p class="home-para text-center">
Awaken Your Senses with the Finest Coffee Selections Imaginable
                </p>
                <div class="text-center">
<a href="#menu" class="btn font-weight-bold">View Menu</a>
                </div>
                </div>
</section>


    <!-- menu section start -->
    <section class="menu" id="menu">
            <h1 class="heading">our <span>menu</span></h1>
            <div class="box-container">
                <div class="box">
                    <img src="../../Public/Images/Products/cat-01.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-02.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-03.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-04.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-05.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-06.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-07.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
                <div class="box">
                    <img src="../../Public/Images/Products/cat-08.jpg" alt="">
                    <h3>tasty and healthy</h3>
                    <div class="price">$15.99 <span>20.99</span></div>
                    <a href="#"class="btn">add to cart</a>
                </div>
            </div>
        </section>
     <!-- menu section end -->
     <div>
    
    </div>
      <!-- product section start --> 
     <section>
     <div class="products" id="products">
        <div class="heading">Our <span>Products</span></div>
        <div class="box-container">
        <?php while($row=mysqli_fetch_assoc($data[0])){?>
            <div class="box">
                <div class="icons">
                    <a href="#" class="fas fa-shopping-cart"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
             
                    <img src="../../Public/Images/Products/<?php echo $row['image'] ?>" alt="" >
                 
                </div>
                <div class="content">
                    <h3>
                   
                        <?php echo $row['name'] ?>
                 
                    </h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">
           
                        <?php echo "$".$row['price'] ?>
                  
                         <span>$20.99</span>
                        </div>
                </div>
            </div>
       
            <?php } ?>
        </div>
      </div>
     </section>
     <!-- product section end  -->
  
     <div class="d-flex flex-wrap justify-content-center mt-3 mb-3" >
            <?php
                for ($i = 1; $i <=$ProductData[1]; $i++) {
                
                    echo "<a class='btn' href='?page=$i'>$i</a> ";
                  
                }
              
              ?>
             
                <?php require_once(dirname(__FILE__).'/../Includes/Footer.php') ; ?>
            
           </div>
         
  
  
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
