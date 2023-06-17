<?php 
session_start();
if(!isset($_SESSION['role'])){
  header('Location:./Login.php');
  exit();
}

require_once(dirname(__FILE__).'/../../Controllers/ProductController.php');
require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');


      $Order=new OrderController();
      $Order->IncreaseItem();
      $Order->DecreaseItem();
      $Order->CancelOrder();
      $Order->ConfirmOrder();
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
<body class="myOrder">
  <div class="container-fluid my-1">
<?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
</div>
<div class="container my-4">

        <div class="row my-5 mx-2">
  
 

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
       <input type="submit"  class=" btn mt-4" value="Search" name="SearchByDate">
 
       </div>

      </form>
  </div>
         
  <div class="row table-contact">
        
        <table class="table mx-5  ">
            <thead>
              
                <th>Product</th>
                <th>Image</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Room</th>
                <th>TotalPrice</th>
                <th>Notes</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php 
                   
                    

                    $orders=$Order->SearchForUser();

                    foreach($orders as $row){
                ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td> <img class="card-image-top" src="/project/Public/Images/Products/<?php echo $row['image'] ?>" alt="img" width="50" /></td>
                    <td>
                        <a href="?decrease=<?php echo $row['product_id'] ?>&id=<?php echo $row['id']?>" class="display-5 btn btn-warning">-</a>
                        <?php echo $row['amount'] ?>
                        <a href="?increase=<?php echo $row['product_id'] ?>&id=<?php echo $row['id']?>" class="display-5 btn btn-primary my-2">+</a>
                    </td>
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
                    <td><?php echo $row['note'] ?> </td>
                    <td>
                       
                        <a href="./EditOrder.php?search=<?php echo $row['product_id'] ?>" class="btn btn-warning mt-2">Edit</a>
                        <a href="?confirm=<?php echo $row['id'] ?>" class="btn btn-primary mt-2">Confirm</a>
                        <a href="?cancel=<?php echo $row['id'] ?>" class="btn btn-danger mt-2">Cancel</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php $price=$Order->GetTotalPrice(); 
            if($price['price']>0){
              ?>
               <h3 class="text-center mx-5 text-primary"> Total Price : <?php echo $price['price'] ?> EGP</h3>
              <?php
            }
        ?>
       
    </div>       
  </div>
          </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
