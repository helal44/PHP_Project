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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/Styles/Style.css">
    <title>Document</title>
</head>
<body> 

<nav class="navbar navbar1 navbar-expand-lg navbar-light bg-dark">
<a href="#" class="logo">
  <img src="../../Public/Images/Products/logo1.png"  style="height: 80px;width: 120px;">
</a>
  <a class="navbar-brand text-white" href="/PHP_Project/Views/Pages/Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php 
              //session_start();

           if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
           ?>
              
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/Products/Products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/Users/Users.php">Users</a>
            </li>
            <li class="nav-item">

                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/ManualOrders.php">ManulOrder</a>

               
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/project/Views/Admin/Categories/Categories.php">Categories</a>

            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/Checks.php">Checks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Admin/CurrentOrders.php">CurrentOrders</a>
            </li>
            <?php } 
                else if(isset($_SESSION['role'])){
            ?>
                
              <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Pages/MyOrders.php">MyOrders</a>
             </li>
            <?php }?>
        </ul>
       

        <ul class="navbar-nav ml-auto">
           <?php 
           //session_start();
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

                <li class="nav-item">
                    <a class="nav-link" href="/PHP_Project/Views/Pages/MyOrders.php" ><?php  echo 'Your Orders :'. $number ?></a>
                </li>
                    <?php } ?>
            <li class="nav-item">
            <img src="/PHP_Project/Public/Images/Users/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['image'] ?>" width="30"/>
            </li>
            <li class="nav-item">
                <p class="nav-link"  ><?php  echo 'Welcome :'. $_SESSION['name'] ?></p>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="?logout" ><strong>Logout</strong></a>
            </li>
            
            <?php
            }
            else {
            ?>
            <li class="nav-item">
            <a class="nav-link text-white" href="/PHP_Project/Views/Pages/Login.php" >Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/PHP_Project/Views/Pages/Login.php">Register</a>
            </li>
            <?php }?>
        </ul>
    </div>
</nav>
    
</body>
</html>




