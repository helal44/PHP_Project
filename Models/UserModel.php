<?php 
require_once('dbModel.php');

class UserModel extends dbModel{


    // insert data --------------------------------------->
    protected function insert($name,$email,$password,$room,$image,$role){
    
        $con=$this->connect();
        $sql="INSERT INTO `Users`( `name`, `email`, `password`, `room`, `image`,`role`) 
            VALUES ('$name','$email','$password','$room','$image','$role') ";
            $data= mysqli_query($con,$sql);
                mysqli_close($con);
            if($data){
                return true;
            }
            else{
                mysqli_error($con);
            }
     
    }

    //  show all users ------------------------------------->

    protected function view(){

        $con=$this->connect();
        $sql="select * from Users where 1";
        $data= mysqli_query($con,$sql);

        if($data){
            return $data;
        }
        else{
            echo '<br>nodata'.mysqli_error($con);
        }
    
    }

    // check user exist ------------------------------------------>

    protected function check($email,$password){
 
        $con=$this->connect();
        $sql="select * from Users where email='$email' and password='$password'";
        $data= mysqli_query($con,$sql);

        if($data){
            return $data;
        }
        else{
            echo '<br>No User'.mysqli_error($con);
        }

    }


    // search user  -------------------------------------------->

    protected function search($id){

        $con=$this->connect();
        $sql="select * from Users where id=$id";
        $data= mysqli_query($con,$sql);
        if(!$data){
            return '<br>No User'.mysqli_error($con);
        }
        else{
            return $data;
        }

    }



    // update user -------------------------------------------->
    protected function update($id,$name,$email,$password,$room,$image,$role){

        $con=$this->connect();
        $sql="UPDATE `Users` SET `name`='$name',`email`='$email',`password`='$password',
                `room`='$room',`image`='$image' ,`role`='$role' WHERE id=$id";
        $data=mysqli_query($con,$sql);

        if($data){
            return true;
        }
        else{
                echo '<br>falied'.mysqli_error($con);
        }

    }

    // delete user ------------------------------------->
    protected function delete($id){

        $con=$this->connect();
        $sql="DELETE FROM `Users` WHERE id=$id";
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