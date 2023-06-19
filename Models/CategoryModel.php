<?php
require_once('dbModel.php');
class CategoryModel extends dbModel {
    // Insert New Category--------------------------------------------------------------------------------------
    function insert($name){
        $con = $this->connect();
        $sql = "INSERT INTO `Categories` (`name`)
        VALUES ('$name')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            mysqli_close($con);
            return true;
        } else {
            echo '<br>Failed To Insert Data ' . mysqli_error($con);
        }
    }

    // Get ALL Categories---------------------------------------------------------------------------------------
    function view(){
        $con = $this->connect();
        $sql = "SELECT * FROM `Categories`";
        $result = mysqli_query($con, $sql);
        if ($result) {
            return $result;
        } else {
            echo mysqli_error($con);
        }
    }

    //  Delete Category-----------------------------------------------------------------------------------------
    function delete($id){
        $con = $this->connect();
        $sql = "DELETE FROM `Categories` WHERE id=$id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            return true;
        } else {
            echo mysqli_error($con);
        }
    }
}
