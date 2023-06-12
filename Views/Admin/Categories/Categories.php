<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location:../../Pages/Login.php');
    exit();
}

require_once dirname(__FILE__).'/../../../Controllers/CategoryController.php';

$category = new CategoryController();
$category->DeleteCategory();
$data = $category->ViewCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Categories</title>
</head>
<body>
    <div class="container-fluid my-1">
        <?php require_once dirname(__FILE__) . '/../../Includes/Navbar.php' ?>
    </div>
    <div class="container">
        <div class="row my-5 mx-2">
            <div class="row w-100">
                <div class="col-9">
                    <h4 class="ml-5">All Categories</h4>
                </div>
                <div class="col-3">
                    <a class="btn btn-info nav-link text-center mx-4 mb-1" href="./AddCategory.php">Add Category</a>
                </div>
            </div>
            <div class=" row w-100">
                <table class="table mx-5 ">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td  class="text-center">
                                    <a class="btn btn-danger" href="Categories.php?delete=<?php echo $row['id'] ?>">X</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>