<?php 

    require_once(dirname(__FILE__).'/../Models/OrderModel.php');
    require_once(dirname(__FILE__).'/../Models/ProductModel.php');
    require_once(dirname(__FILE__).'/../Models/UserModel.php');

    class OrderController extends OrderModel{

        // insert order item ---------------------------------->
        public  function  AddItem(){
            try {
                if(isset($_GET['item'])){
                    session_start();
                    $Product_id=$_GET['item'];
                    $user_id=$_SESSION['id'];
                    $state='waiting';
                    $amount=1;
                    $note='';
                    $room=$_SESSION['room'];
                    $date= date('Y-m-d H:i:s'); 
                    $price=$_GET['price'];
                
                    $check=$this->check($user_id,$Product_id);
                    if($check->num_rows >0){
                        echo 'Order Already Exist';
                    }
                    else{
                        $this->insert($user_id,$Product_id,$state,$amount,$note,$room,$date,$price);
                    }
                   

                }

            } catch (\Throwable $th) {
                throw $th;
            }
        }


        // view all  wating item  ------------------------------------------------->

        public function WatingItems(){

            try {
                session_start();
                $user_id=$_SESSION['id'];
                $result=$this->Wating($user_id);
                if($result->num_rows>0){
                    $num=$result->num_rows;
                    return $num;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }



        //  search all the item for the current user --------------------------------->

        public function SearchForUser(){
            try {
                if(isset($_GET['user_id'])){   // for admin search orders by users  
                    $user_id=$_GET['user_id'];
                      
                    if(isset($_POST['SearchByDate'])){
                       $from=$_POST['from'];
                       $to=$_POST['to'];
                       $result=$this->userSearch($user_id,$from,$to);
                       if($result){
                           return $result;
                       }
                    }
                    else{
                       $result=$this->userSearch($user_id);
                       if($result){
                           return $result;
                       }
                    }
                }

                else{

                    session_start();
                    $user_id=$_SESSION['id'];  // for current user to show his ordesr
   
                    if(isset($_POST['SearchByDate'])){
                       $from=$_POST['from'];
                       $to=$_POST['to'];
                       $result=$this->userSearch($user_id,$from,$to);
                       if($result){
                           return $result;
                       }
                    }
                    else{
                       $result=$this->userSearch($user_id);
                       if($result){
                           return $result;
                       }
                    }

                }
               
              

            } catch (\Throwable $th) {
                throw $th;
            }
            
        
        }



        // incease amount of item  by one on click ------------------------------->

        public function IncreaseItem(){
            try {
                if(isset($_GET['increase'])){
                    $id=$_GET['id'];
                $product_id=$_GET['increase'];
                $product=new ProductModel();
                $result=mysqli_fetch_assoc($product->search($product_id));
                $price=$result['price'];
                $this->increase($id,$price);

                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

          // decrease amount of item  by one on click ------------------------------->

          public function DecreaseItem(){
            try {
                if(isset($_GET['decrease'])){
                    $id=$_GET['id'];
                $product_id=$_GET['decrease'];
                $product=new ProductModel();
                $result=mysqli_fetch_assoc($product->search($product_id));
                $price=$result['price'];
              
                $this->decrease($id,$price);

                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        // Cancel order and delete it  ----------------------------------------->$_COOKIE
        public function CancelOrder(){
            try {
                if(isset($_GET['cancel'])){
                    $id=$_GET['cancel'];
                    $this->delete($id);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        } 



        // confirm Order state ---------------------------------------->  
        public function ConfirmOrder(){
            try {
                if(isset($_GET['confirm'])){
                    $id=$_GET['confirm'];

                    $this->confirm($id);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        // get total price for user orders ------------------------------------->

        public function GetTotalPrice(){
            try {
                session_start();
                $user_id=$_SESSION['id'];
                $result=$this->totalPrice($user_id);
                if($result){
                    return mysqli_fetch_assoc($result);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }


    }

?>