<?php 
session_start();
if($_SESSION['role'] !='admin'){
  header('Location:../Pages/Login.php');
  exit();
}

require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');
require_once(dirname(__FILE__).'/../../Controllers/UserController.php');

      $User=new UserController();
      $Order=new OrderController();
     
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Public/Styles/style.css">
  <link rel="stylesheet" href="../../Public/Styles/product.css">
  <title>Myorders Page</title>
</head>
<body class="bg text-light">
  <div>
<?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
</div>
    <div class="container">
        <div class="row my-5 mx-2">
            <div class="row  w-100 user">

 
    
      <ul class="number" >
        <!-- <label >Select USer</label> -->
      <?php
        $users=$User->ViewUSers();
        foreach($users as $row){  ?>
            <li ><a class="text-light" href="?user_id=<?php echo $row['id'] ?>"> <?php echo $row['name'] ?> </a></li>
        <?php } ?>
      </ul>
  




 </div>
  <div class="row w-100 ">
      <form  method="post" class="row w-100 mx-3">
        <div class="col">
          <label>Date From</label>
          <input type="date" class="form-control" name="from" required>
        </div>
        <div class="col">
          <label>Date To</label>
          <input type="date" class="form-control" name="to" required>
        </div>

       <div class="col">
       <input type="submit" class="btn btn-primary mt-4" value="Search" name="SearchByDate">
       </div>

      </form>
  </div>
         
    <div class=" row table-contact">
        
        <table class=" table  mx-5   ">
            <thead>
              
                <th>Product</th>
                <th>Image</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Room</th>
                <th>TotalPrice</th>
              
            </thead>
            <tbody>
                <?php 
                   
                    

                    $orders=$Order->SearchForUser();

                    foreach($orders as $row){
                ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td> <img class="card-image-top" src="/project/Public/Images/Products/<?php echo $row['image'] ?>" alt="img" width="50" /></td>
                    <td>  <?php echo $row['amount'] ?>   </td>
                    <td>
                      <?php if($row['state']=='confirm'){
                        echo '<p class="text-primary">'.$row['state'] .'</p>';
                        }
                        else{
                          echo '<p class="text-warning">'.$row['state'] .'</p>';
                        }
                        ?>
                    </td>
                    <td><?php echo date('d-m-y H:i',strtotime($row['date'])) ?></td>
                  
                    <td><?php echo $row['room'] ?></td>
                    <td><?php echo $row['totalPrice'] ?> EGP</td>
                  
                </tr>
                <?php }?>
            </tbody>
        </table>
       
       <div>
    </div>       
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
