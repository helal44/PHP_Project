<?php 
    require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');
    require_once(dirname(__FILE__).'/../../Controllers/UserController.php');

    $Order=new OrderController();
    $number=$Order->WatingItems();

    $User=new UserController();
    $User->LogoutUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Public/Styles/Style.css">
    <title>navbar</title>
</head>
<body> 

 <nav class="navbar navbar1 navbar-expand-lg navbar-light "> <!--  don't delete  -->

 
<nav class="navbar navbar1 navbar-expand-lg navbar-light">
<a href="#" class="logo mb-4">
  <img src="/PHP_Project/Public/Images/Products/logo1.png"  style="height: 80px;width: 120px;">
</a>
  <a class="navbar-brand text-white  mb-3" href="/PHP_Project/Views/Pages/Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="collapse-icon">
    <span class="navbar-toggler-icon" id="collapse-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php 
            //   session_start();

           if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
           ?>
              
            <li class="nav-item">
                <a class="nav-link text-white " href="/PHP_Project/Views/Admin/Products/Products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/Users/Users.php">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/ManualOrders.php">ManulOrder</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/PHP_Project/Views/Admin/Categories/Categories.php">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/CurrentOrders.php">CurrentOrders</a>
            </li>
           
            <?php
              require_once(dirname(__FILE__).'/../Includes/SearchBar.php') ;
             ?>
           

            <?php } 
                else if(isset($_SESSION['role'])){
            ?>
                
              <li class="nav-item">
                <a class="nav-link text-white  mb-3" href="/PHP_Project/Views/Pages/MyOrders.php">MyOrders</a>
             </li>
                
            <?php }?>
        </ul>
       

        <ul class="navbar-nav ml-auto">
           <?php 
           //session_start();
        //    <?php 
            // session_start();
           if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
           ?>
            <li class="nav-item">
            <img src="/PHP_Project/Public/Images/Users/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['image'] ?>" width="30"/>
            </li>
            <li class="nav-item">
                <p class="nav-link text-primary" ><?php  echo 'Welcome Admin:'. $_SESSION['name'] ?></p>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white " href="?logout" ><strong>Logout</strong></a>
            </li>
           
            <?php }
            else if(isset($_SESSION['role']) && $_SESSION['role']=='user'){

                if($number>0){
            ?>
                <li class="nav-item mt-4">
                    <a class="nav-link text-white" href="/PHP_Project/Views/Pages/MyOrders.php" ><?php  echo 'Your Orders :'. $number ?></a>
                </li>
                    <?php } ?>
            <li class="nav-item mt-4">
            <img src="/PHP_Project/Public/Images/Users/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['image'] ?>" width="30"/>
            </li>
            <li class="nav-item mt-4">
                <p class="nav-link text-white"  ><?php  echo 'Welcome :'. $_SESSION['name'] ?></p>
            </li>
            <li class="nav-item mt-4">
            <a class="nav-link text-white" href="?logout" ><strong>Logout</strong></a>
            </li>
            <li class="nav-item mt-4">
            <?php
              require_once(dirname(__FILE__).'/../Includes/SearchBar.php') ;
             ?>
            </li>
            <?php
            }
            else {
            ?>
            <li class="nav-item">
            <a class="nav-link text-white" href="/PHP_Project/Views/Pages/Login.php" >Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Pages/register.php">Register</a>
            </li>
            <?php }?>
        </ul>
    </div>
</nav>
      
</body>
</html>




