<?php 

// require_once('dbController.php');
 require_once(dirname(__FILE__).'/../Models/UserModel.php');

class UserController extends UserModel {
    public $errors=array();

    // validate user Login data ------------------------------>
    protected function ValidateLoginUser($email,$password){
    
        if(empty($email)){
            $this->errors['email']='email is requierd';
           
          }
          else{

            if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
                $this->errors['emailstyle']='email not valid';
            }

          }

          if(empty($password)){
            $this->errors['password']='password is requierd';
          }

          return $this->errors;
     }


    // validate user Register  data -------------------------->
    protected function ValidateRegisteUser($name,$email,$password,$confirmPassword,$image){
    
        if(empty($name) ){
          $this->errors['Name']='name is requierd';
         
        }else{
          if(preg_match('/^[a-zA-z]*$/',$name)==0){
            $this->errors['Name']='name should be string';
          }
        }
    

        if(empty($email)){
            $this->errors['email']='email is requierd';       
          }else{

            if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
              $this->errors['Email']='email not valid';
            }
          }
    


          if(empty($password)){
            $this->errors['Password']='password is requierd';
    
          }else{

            $passpattern = '/^(?=.*[a-z])(?=.*\d)[a-z\d]{8}$/';
            if (!preg_match($passpattern, $password)) {
               $this->errors['Password']='invalid Password';
            }
          }
          
        
          if(empty($confirmPassword)){
            $this->errors['Confirmpassword']='confirmpassword is requierd';
            
          }
         else{
                if($confirmPassword !=$password){
                  $this->errors['Confirmpassword']='confirmpassword not equal to password';
                }
          }



          if(empty($image)){
            $this->errors['Image']='image is requierd';
          }
    
          return $this->errors;
    
     }


     // upkoad user image ------------------------->

     protected function UploadUserImage($image){
        try {
         
           $dir='/opt/lampp/htdocs/project/Public/Images/Users/'.$image;
           $resut=move_uploaded_file($_FILES['image']['tmp_name'],$dir);
           if($resut){
          return true;
           }
           else{
           echo 'failed to upload image';
           }
           
         } catch (Exception $th) {
           echo $th->getMessage();
          }
       }


       // delete user  image   ------------------------------------------>

        protected function DeleteUserImage($image){
            try{
              $dir='/opt/lampp/htdocs/project/Public/Images/Users/'.$image;
                $result=unlink($dir);
                if($result){
                return true;
                }
            }
            catch (Exception $th) {
                echo $th->getMessage();
               }
            

        }

    // add users ----------------------------------->
       public function insertUSer(){
        try {
            if(isset($_POST['submit'])){
                $name=$_POST['name'];
                $email=$_POST['email'];
                $password=$_POST['password'];
                $confirmPassword=$_POST['confirmPassword'];
                $room=$_POST['room'];
                $image=$_FILES['image']['name'];
                $role='user';
            
              

                $errors=$this->ValidateRegisteUser($name,$email,$password,$confirmPassword,$image);
                if(empty($errors)){

                    $im=$this->UploadUserImage($image);

                   if($im){
                    $result=$this->insert($name,$email,$password,$room,$image,$role);
                    if($result){
                       echo "<h4 class='success'>success<h4>";
                    }
                   }

                }
                else{
                    return $errors;
                }
            }
           
        } catch (Exception $th) {
           echo $th->getMessage();
        }
    }


    // check if user Exist ----------------------------------->

    public function CheckUserExist(){
       try {
            if(isset($_POST['submit'])){
            
                $email=$_POST['email'];
                $password=$_POST['password'];

                $errors=$this->ValidateLoginUser($email,$password);

                    if(empty($errors)){
                    
                    $result=$this->check($email,$password);
                    if($result){

                        $data=mysqli_fetch_assoc($result);
                        session_start();
                        $_SESSION['id']=$data['id'];
                        $_SESSION['name']=$data['name'];
                        $_SESSION['email']=$data['email'];
                        $_SESSION['image']=$data['image'];
                        $_SESSION['role']=$data['role'];
                        $_SESSION['room']=$data['room'];

                        header('Location:./Home.php');
                    }

                    }
                    else{
                        foreach($errors as $key=>$vale){
                            echo " <span class='text-danger'>".$key."  =>  ".$vale."</span><br>";
                        }
                }
            }
        }
        catch (Exception $th) {
          echo $th->getMessage();
        }
     }

 
       // get all users  -------------------------------------------------------------->
        public function ViewUSers(){

            try {
            $data= $this->view();
            if($data){
                return $data;
            }
           
            }
             catch (Exception $th) {
                echo $th->getMessage();
             }
        }

        // delete users   ------------------------------------------------------->

        public function DeleteUSer(){

            try {
              if(isset($_GET['delete'])){
                $id=$_GET['delete'];
                $resul=$this->delete($id);
                if($resul){
                    header("Location:".$_SERVER['PHP_SELF']);

                }
              }
            }
             catch (Exception $th) {
                echo $th->getMessage();
             }
        }

         // search  Users  --------------------------------------------->

        public  function SearchUser(){

            try {    
                if(isset($_GET['search'])){

                  $id=$_GET['search'];
                  $result=$this->search($id);
                  if($result){
                      $row=mysqli_fetch_assoc($result); 
                      return $row;
                  }
                }
            } catch (Exception $th) {
                echo $th->getMessage();
             }
        }


        // update USers ------------------------------------------> 

        public function updateUser(){
            try {
               
                if(isset($_POST['submit'])){
                    $id=$_GET['search'];
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                    $password=$_POST['password'];
                    $confirmPassword=$_POST['confirmPassword'];
                    $room=$_POST['room'];
                    $image=$_FILES['image']['name'];
                    $role=$_POST['role'];

             
    
                    $errors=$this->ValidateRegisteUser($name,$email,$password,$confirmPassword,$image);
                    if(empty($errors)){
    
                        $im=$this->UploadUserImage($image);
                       if($im){
                        $result=$this->update($id,$name,$email,$password,$room,$image,$role);
                        if($result){
                            
                          header('Location:./Users.php');

                          echo '<h3 class="text-success"> User Updated Successfly</h3>';
                        }
                       }
    
                    }
                    else{
                        return $errors;
                    }
                }
               
            } catch (Exception $th) {
                echo $th->getMessage();
            }

        }


        // logout userss ----------------------------------------------->

        public function LogoutUser(){
          try {
            if(isset($_GET['logout'])){
              session_unset();
              setcookie(session_name(), '', time() - 3600);
              // session_destroy();
              header("Location:".$_SERVER['PHP_SELF']);
               
            }
          } catch (\Throwable $th) {
            throw $th;
          }
        }

}
?>