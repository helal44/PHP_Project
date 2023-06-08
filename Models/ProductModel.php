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
  protected function view($limit,$offset,$page_items){
        $con=$this->connect();
        $sql1="SELECT COUNT(*) FROM `Products` where 1 ";
        $rows=mysqli_fetch_array(mysqli_query($con,$sql1));
        
        $count=ceil($rows[0]/$page_items);

        $sql2="SELECT * FROM `Products` WHERE 1 LIMIT $offset,$limit ";
        $result=mysqli_query($con,$sql2);

        

        $data=[$result,$count];
        if($result){
            return $data;
        }
        else {
            echo mysqli_error($con);
        }
    }


    // Search For Row  by id  -------------------------------------->

    public function searchbyid($id){
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



     // Search For Row by name  -------------------------------------->

     public function searchbyname($name){
        $con=$this->connect();
   
            $sql="SELECT * FROM `Products` WHERE `name` LIKE '%$name%'";
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