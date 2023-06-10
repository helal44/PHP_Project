<?php 
    require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');
    require_once(dirname(__FILE__).'/../../Controllers/UserController.php');

    $Order=new OrderController();
    $number=$Order->WatingItems();

    $User=new UserController();
    $User->LogoutUser();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/project/Views/Pages/Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php 
            //   session_start();

           if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
           ?>
              
            <li class="nav-item">
                <a class="nav-link" href="/PHP_Project/Views/Admin/Products/Products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PHP_Project/Views/Admin/Users/Users.php">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PHP_Project/Views/Admin/ManualOrders.php">ManulOrder</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PHP_Project/Views/Admin/Checks.php">Checks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PHP_Project/Views/Admin/CurrentOrders.php">CurrentOrders</a>
            </li>
            <?php } 
                else if(isset($_SESSION['role'])){
            ?>
                
              <li class="nav-item">
                <a class="nav-link" href="/PHP_Project/Views/Pages/MyOrders.php">MyOrders</a>
             </li>
            <?php }?>
        </ul>
       

        <ul class="navbar-nav ml-auto">
           <?php
            // session_start();
           if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
           ?>
            <li class="nav-item">
            <img src="/project/Public/Images/Users/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['image'] ?>" width="30"/>
            </li>
            <li class="nav-item">
                <p class="nav-link text-primary" ><?php  echo 'Welcome Admin:'. $_SESSION['name'] ?></p>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="?logout" ><strong>Logout</strong></a>
            </li>
            <?php }
            else if(isset($_SESSION['role']) && $_SESSION['role']=='user'){

                if($number>0){
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="/project/Views/Pages/MyOrders.php" ><?php  echo 'Your Orders :'. $number ?></a>
                </li>
                    <?php } ?>
            <li class="nav-item">
            <img src="/project/Public/Images/Users/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['image'] ?>" width="30"/>
            </li>
            <li class="nav-item">
                <p class="nav-link"  ><?php  echo 'Welcome :'. $_SESSION['name'] ?></p>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="?logout" ><strong>Logout</strong></a>
            </li>
            
            <?php
            }
            else {
            ?>
            <li class="nav-item">
            <a class="nav-link" href="/project/Views/Pages/Login.php" >Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/project/Views/Pages/Login.php">Register</a>
            </li>
            <?php }?>
        </ul>
    </div>
</nav>





