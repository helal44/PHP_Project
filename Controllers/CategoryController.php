<?php
require_once dirname(__FILE__).'/../Models/CategoryModel.php';

class CategoryController extends CategoryModel{

  public $errors=array();

  // Validate Category------------------------------------------------------------------------------------------
    function categoryValidate($name){
        try {
            if (empty($name)) {
                $this->errors['name'] = 'Name Is Required';
            } else {
                if (preg_match('/^[a-zA-z]*$/', $name) == 0) {
                    $this->errors['name'] = 'Name Should be String';
                }
            }
            return $this->errors;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

  // Insert Category-------------------------------------------------------------------------------------------
    function insertCategory(){
        try {
            if (isset($_POST['addCategory'])) {
                $name = $_POST['name'];
                $error = $this->categoryValidate($name);
                if (empty($error)) {
                    $result = $this->insert($name);
                    if ($result) {
                        header('Location:./Categories.php');
                    } else {
                        return $error;
                    }
                }
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    // View All Categories--------------------------------------------------------------------------------------
    function ViewCategories(){
        try {
            $result = $this->view();
            if ($result) {
                return $result;
            }
        } catch (Exception $th) {
            // echo $th->getMessage();
        }
    }

    // Delete Category------------------------------------------------------------------------------------------
    function DeleteCategory(){
        try {
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $result = $this->delete($id);
                if ($result) {
                    header('Location:Categories.php');
                }
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

}
?>