<?php

        session_start();
        if(!isset($_SESSION['role'])){
        header('Location:./Login.php');
        exit();
        }

    require_once(dirname(__FILE__).'/../../Controllers/OrderController.php');

    $Order= new OrderController();

    $myorder=$Order->FindUserchOrder();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Edit Order</title>
</head>
<body>
    
<?php require_once(dirname(__FILE__).'/../Includes/Navbar.php') ;?>
  <div class="container my-4">

    <div class="row w-100  ">
   
        <div class="col-md-6 mx-auto">

        <form method="post" class=" form-group  shadow mt-2 p-3 ">
        <h4 class=" text-center my-3"> Edit Note And Room</h4>
        <div class="elm my-3">
    
                    <input type="text" name="id" value="<?php echo $myorder['id'] ?> " hidden>
            </div>
            <div class="elm my-3">
                    <h5 > Name : <strong> <?php echo $myorder['name'] ?> </strong></h5>
            </div>
            <div class="elm my-3">
                    <label > Current Image </label>
                    <img src="./../../Public/Images/Products/<?php echo $myorder['image'] ?>"  >
            </div>
            <div class="elm my-3">
                    <label > Order Notes :</label>
                    <textarea name="note" class=" form-control" >  <?php echo $myorder['note'] ?>  </textarea>
            </div>
            <div class="elm">
                    <label > Select Room  </label>

                    <select name="room"  class="form-control">
                        <option value="1">Room 1</option>
                        <option value="2">Room 2</option>
                        <option value="3">Room 3</option>
                    </select>
            </div>

            <div class="elm mt-4">
                    <input type="submit" class=" btn btn-primary" value="Edit" name="editorder">
            </div>

            <?php $Order->UpdateUserOrder();  ?>
        </form>

        </div>
        
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>




















