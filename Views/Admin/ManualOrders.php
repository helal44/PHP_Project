<?php 
session_start();
if($_SESSION['role'] !='admin'){
    header('Location:../Pages/Login.php');
  exit();
}

require_once(dirname(__FILE__).'/../../Controllers/ProductController.php');
require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');
require_once(dirname(__FILE__).'/../../Controllers/UserController.php');

$Oredre= new OrderController();
$Product=new ProductController();
$User=new UserController();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Public/Styles/Style.css">
  <link rel="stylesheet" href="../../Public/Styles/manualOrder.css">
  <title>Home Page</title>
</head>
<body>
  <div class="container-fluid my-1">

  <?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>

  <!-- <?php require_once(dirname(__FILE__).'/../Includes/SearchBar.php') ;?> -->
  </div>
    <!-- <div class="container ">
        <div class="row my-5 mx-2">
           
            <div class="mx-2  user text-center">
                  <?php  

                        $users=$User->ViewUSers();

                        foreach($users as $row){
                    
                         echo '<a href="?search='.$row['id'].'&room='.$row['room'].'"> '.$row['name'] .'</a><br>';
                        
                        }
                  ?>
            
            </div>
            <div class="text-center mt-3">
              <?php    $Order->AdminAddItem(); ?>
            </div>
            <div class=" d-flex ">
              <?php


                $currentUser=$User->SearchUser();
                         

                $products=$Product->SearchProductByName();

                $ProductData=$Product->ViewProducts();

                if($products){

                  while($row=mysqli_fetch_assoc($products)){
                    if($row['state']=='available'){
                    ?>
                    <div class=" card m-3 align-items-center shadow p-2  ">
                    <img class="card-image" src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $row['name'] ?></h2>
                        <h4 class="card-text"><?php echo $row['price'] ?>$</h4>
                        <a href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>&user_id=<?php   echo $currentUser['id']; ?>&room=<?php  echo $currentUser['room']; ?>"  >Add to list</a>
              
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
                        <h4 class="card-text"><?php echo $row['price'] ?>$</h4>
                        <a href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>&user_id=<?php   echo $currentUser['id']; ?>&room=<?php  echo $currentUser['room']; ?>" >Add to list</a>
                    </div>
                    </div>
                  <?php } }

                }
                 
              ?>
              
            </div>

            <div class=" pag d-flex flex-wrap justify-content-center mt-3 mb-3" >
            <?php
                for ($i = 1; $i <=$ProductData[1]; $i++) {
                
                    echo "<a class='btn' href='?page=$i'>$i</a> ";
                  
                }
              
              ?>
           </div>
         
        </div>
    </div> -->
    <section class="menu " id="menu">
    <div class="text-center ">
            <?php  

        $users=$User->ViewUSers();

        foreach($users as $row){

        echo '<a class="text-light" href="?search='.$row['id'].'&room='.$row['room'].'"> '.$row['name'] .'</a><br>';

        }
        ?>
        <div class="text-center">
            <?php    $Order->AdminAddItem(); ?>
        </div>
            <div class="box-container mt-3">
              <?php
              
               $products=$Product->SearchProductByName();

                 $ProductData=$Product->ViewProducts();
               

                  if($products){
                    while($row=mysqli_fetch_assoc($products)){
                      if($row['state']=='available'){
                      ?>
 
    
                      <div class="box bg-dark">
                      <img  src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                     
                          <h3 ><?php echo $row['name'] ?></h3>
                          <div class="price"><?php echo $row['price'] ?>EGP <span>20.99</span></div>

                          <a  class="btn" href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>" >Add to cart</a>
                      </div>
                      </div>
                    <?php } }
                  }

                  else{
                    while($row=mysqli_fetch_assoc($ProductData[0])){
                      if($row['state']=='available'){
                      ?>
                      <div class="box bg-dark ">
                        <img  src="/PHP_Project/Public/Images/Products/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>" width="150" />
                     
                          <h3><?php echo $row['name'] ?></h3>
                          <div class="price"><?php echo $row['price'] ?>EGP <span>20.99</span></div>
                          <a  class="btn" href="?item=<?php echo $row['id'] ?>&price=<?php echo $row['price']?>" >Add to cart</a>
                      </div>
                  
                    <?php } }
                  }

               

              ?>
              
            </div>
              
 </section>
    <!-- </div> -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
