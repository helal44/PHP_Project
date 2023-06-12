<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location:../../Pages/Login.php');
    exit();
}
require_once dirname(__FILE__) . '/../../../Controllers/CategoryController.php';
$Category = new CategoryController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Add Category</title>
</head>
<body>
    <div class="container-fluid my-1">
        <?php require_once dirname(__FILE__) . '/../../Includes/Navbar.php' ?>
    </div>
    <div class="container">
        <div class="row my-5 mx-5  ">
            <form action="" class="w-100" method="post" enctype="multipart/form-data">
                <h4>Add Category</h4>
                <div class="form-group mt-5">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <button type="submit" class="btn btn-primary my-2" name="addCategory">Add</button> <br>
                <?php
                $Category->insertCategory();
                foreach ($Category->errors as $key => $err) { ?>
                    <span class="text-danger"><?php echo '<br><br>' . $key . '=>' . $err ?></span>
                <?php } ?>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>