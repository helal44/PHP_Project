<?php

  class dbModel{
  

   private $dbname='ProjectDataBase';

    public function connect(){
        try {

            $con=  mysqli_connect('localhost','root','');

           if(!$con){
             die('connection falied:'.mysqli_connect_error());

             }
           else{

                $mycon= $this->crateDatabes($con);
                return $mycon;

           }
        } 
        catch (\Throwable $th) {
            echo $th->getMessage();
        }
        
    }


     function crateDatabes($con){

        $sql="CREATE DATABASE IF NOT EXISTS $this->dbname";
        $data=  mysqli_query($con,$sql);
       
       if($data){
        $con=  mysqli_connect('localhost','root','',$this->dbname); 
          
            return $con;
        }
        else{
            die( 'failed to create database'.$con->error);
        }
    }



     function createUsersTable(){

        try {
           $con= $this->connect();
            $sql="CREATE TABLE Users (
                id INT(6)   AUTO_INCREMENT  PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email varchar(50) UNIQUE NOT NULL,
                password VARCHAR(10) NOT NULL,
                room INT(5) NOT NULL ,
                image VARCHAR(20) NOT NULL,
                role VARCHAR(10) NOT NULL,
                token INT(6)
            )";

            $data=$con->query($sql);
        
          if(!$data){
            die('table not created '.$con->error.'<br>');
          }
          else{
                echo 'table users is created';
          }
            
        } catch (\Throwable $th) {
           echo $th->getMessage();
        }
    }



     function createProductTable(){

        try {
           $con= $this->connect();
            $sql="CREATE TABLE Products (
                id INT(6)   AUTO_INCREMENT  PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                state VARCHAR(10) NOT NULL,
                price INT(10)  NOT NULL,
                -- category VARCHAR(10) NOT NULL,
                category_id INT(10),
                image VARCHAR(20) NOT NULL,
                foreign key(category_id) references Categories(id) on delete cascade
            )";

            $data=$con->query($sql);
        
          if(!$data){
            die(' Table not Created '.$con->error.'<br>');
          }
          else{
                echo 'table Products is created';
          }
            
        } catch (\Throwable $th) {
           echo $th->getMessage();
        }
    }



     function createOrderTable(){

        try {
           $con= $this->connect();
            $sql="CREATE TABLE `Order` (
                id INT(11)   AUTO_INCREMENT  PRIMARY KEY,
                user_id int(6)  ,
                product_id int(6)  ,
                state VARCHAR(10) NOT NULL,
                amount INT(10)  NOT NULL,
                note VARCHAR(50) ,
                room INT(6) NOT NULL ,
                date TIMESTAMP NOT NULL,
                totalPrice INT(6) NOT NULL ,
                foreign key(user_id) references Users(id) on delete cascade,
                 foreign key(product_id) references Products(id) on delete cascade
            )";

            $data=$con->query($sql);
        
          if(!$data){
            die('<br>table not created '.$con->error.'<br>');
          }
          else{
                echo 'table users is created';
          }
            
        } catch (\Throwable $th) {
           echo $th->getMessage();
        }
    }

    function createCategoriesTable()
    {
      try {
        $con = $this->connect();
        $sql = "CREATE TABLE Categories (
                id INT(10) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50)  NOT NULL
            )";
        $data = $con->query($sql);
        if (!$data) {
          die('<br>Categories Table Not Created ' . $con->error . '<br>');
        } else {
          echo 'Categories Table Is Created';
        }
      } catch (\Throwable $th) {
        echo $th->getMessage();
      }
    }
  

  
}

        //  $data=new dbModel();
        //  $data->connect();
        //  $data->createUsersTable();
        //  $data->createCategoriesTable();
        //  $data->createProductTable();
        //  $data->createOrderTable();
?>