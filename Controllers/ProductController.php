<?php
require_once(dirname(__FILE__).'/../Models/ProductModel.php');

class ProductController extends ProductModel{

  public $errors=array();

  // validate product ------------------------------------------->
  protected function ProductValidate($name,$state,$category,$price,$image){

    try {
      if(empty($name)){
        $this->errors['name']='nema Required';
      }
      else{
        if(preg_match('/^[a-zA-z]*$/',$name)==0){
          $this->errors['name']='name should be string';
        }
      }

      if(empty($category)){
        $this->errors['category']='category is required';
      }

      if(empty($state)){
        $this->errors['state']='state is required';
      }

      if(empty($price)){
        $this->errors['price']='price is required';
      }
      if(empty($image)){
        $this->errors['image']='image is required';
      }

      return $this->errors;

    } catch (Exception $th) {
      echo $th->getMessage();
    }
  }

  //  upload image ------------------------------------------>

  protected function UploadProductImage($image){

    try {
     
     $dir='/xampp1/htdocs/PHP_Project/Public/Images/Products/'.$image;
     
     $result=move_uploaded_file($_FILES['image']['tmp_name'],$dir);
       if($result){
          echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         // return true;
       }
       else{
       echo 'failed to upload image';
       }
       
    } catch (Exception $th) {
     echo $th->getMessage();
   }
   }


  // delete image   ------------------------------------------>

  protected function DeleteProductImage($image){
    try{
      $dir='/xampp1/htdocs/PHP_Project/Public/Images/Products/'.$image;

        $result=unlink($dir);
        if($result){
          return true;
        }
    }
    catch (Exception $th) {
      echo $th->getMessage();
    }
    
  }



  //  insert product -------------------------------------->
    public function InsertProduct(){

      try {
        if(isset($_POST['addproduct'])){
          $name=$_POST['name'];
          $state=$_POST['state'];
          $category=$_POST['category'];
          $price=$_POST['price'];
          $image=$_FILES['image']['name'];

          $error=$this->ProductValidate($name,$state,$category,$price,$image);  // valiadte data
          if(empty($error)){

           $im= $this->UploadProductImage($image);  // upload image 
            // if($im){
              $result=$this->Insert($name,$state,$price,$category,$image); // insert data in data base
              if($result){
                header('Location:./Products.php');
              }
           // }
          }

          else{
            return $error;
          }

        }
      } catch (Exception $th) {
        echo $th->getMessage();
      }

    }


    // view all products ---------------------------------->

    public function ViewProducts(){
      try{
        $limits=5;
        $page_Number=isset($_GET['page']) ?$_GET['page'] :1;

        $offset=($page_Number-1)* $limits;

        $result=$this->view($limits ,$offset,$limits);

      if($result){
        return $result;
      }
    }catch (Exception $th) {
      // echo $th->getMessage();
    }
     
    }


    // search Product by id   ------------------------------------>

    public function SearchProduct(){

      try{
      if(isset($_GET['search'])){

        $id=$_GET['search'];
        $result=$this->searchbyid($id);
        if($result){
          $row=mysqli_fetch_assoc($result); 
          return $row;
        }
      }
     
    }
    catch (Exception $th) {
      echo $th->getMessage();
    }
    }
 
      
      
      // search Product by name   ------------------------------------>

      public function SearchProductByName(){
  
        try{
        if(isset($_POST['search'])){
  
          $name=$_POST['name'];
          $result=$this->searchbyname($name);
          if($result){
          
            return $result;
          }
          else{
            echo 'no result';
          }
        }
       
      }
      catch (Exception $th) {
        echo $th->getMessage();
      }
      }


    // Update Row of Data in Database  ----------------------------->

    public function UpdateProduct(){

    try{
        if(isset($_POST['updateproduct'])){
          $id=$_GET['search'];
          $oldimage=$_GET['image'];
          $name=$_POST['name'];
          $state=$_POST['state'];
          $category=$_POST['category'];
          $price=$_POST['price'];
          $image=$_FILES['image']['name'];

          $error=$this->ProductValidate($name,$state,$category,$price,$image);  // valiadte data
          if(empty($error)){
              $this->DeleteProductImage($oldimage); // delete old image
            $this->UploadProductImage($image);  // upload image 

            $result=$this-> update($id,$name,$state,$price,$category,$image); // update row of data in data base

              if($result){
                  echo '<h3 class="text-success">Data Updated Successfly</h3>';
                  ob_start();
                  header('Location:Products.php');
                  ob_end_flush();
              
              }
          }

          else{
            return $error;
          }

        }
      }
      catch (Exception $th) {
        echo $th->getMessage();
      }
    }


    // Delete Product --------------------------------------->

    public function DeleteProduct(){
      try{
        if(isset($_GET['delete']) && isset($_GET['image'])){
          $id=$_GET['delete'];
          $image=$_GET['image'];
          $result=$this->delete($id);
          if($result){
            $Re2=$this->DeleteProductImage($image);
            if($Re2){
              header('Location:Products.php');
            }
          }
        }
    }catch (Exception $th) {
      echo $th->getMessage();
    }
      
    }




}
?>