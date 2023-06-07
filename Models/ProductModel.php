<?php
require_once ('dbModel.php');

class ProductModel extends dbModel{

    // insert data to data base ----------------------->
    protected function Insert($name ,$state,$price,$category,$image){

        $con=$this->connect();
        $sql="INSERT INTO `Products` (`name`,`state` ,`price` ,`category` ,`image`) 
        VALUES ('$name','$state' ,$price ,'$category','$image')" ;

        $result=mysqli_query($con,$sql);

        if($result){

            mysqli_close($con);
            return true;
        }
        else{
            echo '<br>failed insert data '.mysqli_error($con);
        }

    }

  // get ALL Data from data base ----------------------------->
  protected function view(){
        $con=$this->connect();
        $sql="SELECT * FROM `Products` WHERE 1";
        $result=mysqli_query($con,$sql);
        if($result){
            return $result;
        }
        else {
            echo mysqli_error($con);
        }
    }


    // Search For Row   -------------------------------------->

    public function search($id){
        $con=$this->connect();
        $sql="SELECT * FROM `Products` WHERE id=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            return $result;
        }
        else{
            echo mysqli_error($con);
        }
    }



    // Update Row OF data in data base ------------------------>

    protected function update($id,$name,$state,$price,$category,$image){
        $con=$this->connect();        
        $sql="UPDATE  `Products` SET `name`='$name' ,`state`='$state' 
            ,`price`=$price ,`category`='$category' ,`image`='$image' WHERE `id`=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            return true;
        }
        else{
            echo mysqli_error($con);
        }
    }

    //  delete table row from data base ----------------------------->

    protected function delete($id){
        $con=$this->connect();
        $sql="DELETE FROM `Products` WHERE id=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            return true;
        }
        else{
            echo mysqli_error($con);
        }
    }
}
?>