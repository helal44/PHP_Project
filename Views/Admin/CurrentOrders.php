<?php 
session_start();
if($_SESSION['role'] !='admin'){
    header('Location:../Pages/Login.php');
  exit();
}

require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');

$Order=new OrderController();

$Order->GetOrderDone();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Public/Styles/currentModel.css">
  <title>CurrentORders</title>
</head>
<body>
<div class="container-fluid my-1">
<?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
</div>
    <div class="container">
        <div class="">
            <div class=" title">

        <h4 class="">All Confirmed Orders</h4>
        <div class=" row w-100 table-contact">
        <table class=" table mx-5  ">

            <thead class=" mx-5">
              
                <th>User</th>
                <th>Image</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Room</th>
                <th>TotalPrice</th>
                <th>Action</th>
            
            </thead>
            <tbody>
                <?php 
                   
                    

                    $orders=$Order->GetConfirmedOrders();

                    foreach($orders as $row){
                ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td> <img class="card-image-top" src="/PHP_Project/Public/Images/Users/<?php echo $row['image'] ?>" alt="img" width="50" /></td>
                    <td>  <?php echo $row['amount'] ?>   </td>
                    <td>   <?php 
                            if($row['state']=='done'){
                                echo '<p class="text-success">'. $row['state'].'</p>';
                            }
                            else{
                                echo '<p class="text-primary">'. $row['state'].'</p>';
                            }
                    ?>  </td>
                    <td><?php echo date('d-m-y H:i',strtotime($row['date'])) ?></td>
                    <td><?php echo $row['room'] ?></td>
                    <td><?php echo $row['totalPrice'] ?> EGP</td>
                    <td><a class="btn btn-success"  href="?done_id=<?php echo $row['id'] ?>">Done</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
      
       
    </div>       
  </div>
  </div>
                        </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
