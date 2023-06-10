<?php
require_once(dirname(__FILE__).'/dbModel.php');

class OrderModel extends dbModel{


        // insert Order ---------------------------------------> >>>>>
        protected function insert($user_id,$product_id,$state,$amount,$note,$room,$date,$totalPrice){
        
            $con=$this->connect();
            $sql="INSERT INTO `Order`( `user_id`, `product_id`, `state`,`amount`,`note`,`room`,`date`, `totalPrice`) 
                         VALUES ($user_id,$product_id,'$state',$amount,'$note',$room,'$date',$totalPrice) ";
                $data= mysqli_query($con,$sql);
                if($data){
                    echo 'ORder Added';
                    return true;
                }
                else{
                    mysqli_error($con);
                }
        
        }
        

        // Get all confirmed  Orders for Admin  --------------------------------------------> >>>>>>

        protected function ConfirmedORders(){

        $con=$this->connect();
        $sql="select o.* ,u.name ,u.image from `Order` as o , `Users` as u where state in ('confirm','done') and o.user_id=u.id " ;
        $result= mysqli_query($con,$sql);
        if(!$result){
            return '<br>No No Confirmed ORders'.mysqli_error($con);
        }
        else{
            
            return $result;
        }
        }


        // change the state of the confirmed orders to done  --------------------------> >>>>>>>>

        protected function DoneOrders($id){

        $con=$this->connect();
        $sql="UPDATE `Order` SET `state` ='done'  WHERE id=$id ";
        $data=mysqli_query($con,$sql);

        if($data){
            return true;
        }
        else{
                echo '<br>falied'.mysqli_error($con);
        }
    }
    

    // search Orders for one users -------------------------------------------->  >>>>>>>>>

    protected function userSearch($user_id,$from=null,$to=null){

        $con=$this->connect();
        if($from & $to){
            $sql="select o.* ,p.name ,p.image from `Order` as o , `Products` as p where o.user_id=$user_id  and o.product_id=p.id and DATE(date) between '$from' and '$to'";
        }
        else{
            $sql="select o.* ,p.name ,p.image from `Order` as o , `Products` as p where o.user_id=$user_id  and o.product_id=p.id";
        }
        $result= mysqli_query($con,$sql);
        if(!$result){
            return '<br>No Oredritem'.mysqli_error($con);
        }
        else{
          
            return $result;
        }

    }


     // search If the same Order Exist  --------------------------------------------> >>>>

     protected function check($user_id,$product_id){

        $con=$this->connect();
        $sql="select * from `Order` where user_id=$user_id and product_id=$product_id and state='waiting'";
        $result= mysqli_query($con,$sql);
        if(!$result){
            echo '<br>'.mysqli_error($con);
        }
        else{
          
            return $result;
        }

    }



        // search Wating Order  --------------------------------------------> >>>>>>

        protected function Wating($user_id){

            $con=$this->connect();
            $sql="select * from `Order` where state='waiting' and user_id=$user_id";
            $result= mysqli_query($con,$sql);
            if(!$result){
                return '<br>No OrderWating Item'.mysqli_error($con);
            }
            else{
            
                return $result;
            }
         }



         // search one order by id for the current user ---------------------------->$_COOKIE

          
        protected function FindOrder($product_id,$user_id){

            $con=$this->connect();
     
            $sql="select o.* ,p.name ,p.image from `Order` as o ,`Products` as p where o.product_id=$product_id and o.user_id=$user_id and p.id=$product_id";
            $result= mysqli_query($con,$sql);
            if(!$result){
                echo '<br>No OrderWating Item'.mysqli_error($con);
            }
            else{
            
                
                return $result;
            }
         }



            // Update  Order notes and room by usedr ----------------------------------------> >>>>>>>>>

            protected function UpdateOrder($id,$note,$room){

                $con=$this->connect();
                $sql="UPDATE `Order` SET  `note`='$note' ,`room`= $room WHERE id=$id ";
                $data=mysqli_query($con,$sql);
        
                if($data){
                    return true;
                }
                else{
                        echo '<br>falied'.mysqli_error($con);
                }
            }




            // get the last five done order for the current user  --------------------------------------------> >>>>>>

         protected function LastDone($user_id){

            $con=$this->connect();
            $sql2="select o.* ,p.name ,p.image from `Order` as o , `Products` as p where o.user_id=$user_id and o.product_id=p.id and o.state='done'  LIMIT 3";
            // $sql="select * from `Order` where state='done' and user_id=$user_id    LIMIT 5";
            $result= mysqli_query($con,$sql2);
            if(!$result){
                return '<br>No Done Orders Item'.mysqli_error($con);
            }
            else{
            
                return $result;
            }
         }




        // increase order amnount by one and update price --------------------------> >>>>>>>>

        protected function increase($id,$price){

            $con=$this->connect();
            $sql="UPDATE `Order` SET totalPrice =totalPrice + $price , amount =amount +1  WHERE id=$id and amount <10";
            $data=mysqli_query($con,$sql);
    
            if($data){
                return true;
            }
            else{
                    echo '<br>falied'.mysqli_error($con);
            }
        }


        // deacreas  order amnount by one and update price --------------------------> >>>>>>>

        protected function decrease($id,$price){

            $con=$this->connect();
            $sql="UPDATE `Order` SET `totalPrice`= totalPrice - $price , amount= amount -1 WHERE id=$id and totalPrice > $price";
            $data=mysqli_query($con,$sql);
    
            if($data){
                return true;
            }
            else{
                    echo '<br>falied'.mysqli_error($con);
            }
        }


           // Confirm Order ------ --------------------------------------------> >>>>>>>>>

           protected function confirm($id){

            $con=$this->connect();
            $sql="UPDATE `Order` SET  `state`='confirm'  WHERE id=$id ";
            $data=mysqli_query($con,$sql);
    
            if($data){
                return true;
            }
            else{
                    echo '<br>falied'.mysqli_error($con);
            }
        }


          // Get Total Price For  Orders  -------------------------------------------->  >>>>>>>

            protected function totalPrice($user_id){

                $con=$this->connect();
                $sql="select SUM(totalPrice) as price from `Order` where user_id=$user_id and state='confirm'";
                $result= mysqli_query($con,$sql);
                if(!$result){
                    return '<br>No OrderWating Item'.mysqli_error($con);
                }
                else{
                
                    return $result;
                }
            }


            // delete Order ------------------------------------->   >>>>>>>>>>>>>>
            protected function delete($id){

                $con=$this->connect();
                $sql="DELETE FROM `Order` WHERE id=$id";
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

