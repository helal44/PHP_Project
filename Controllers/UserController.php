<?php 

use \PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

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
         
           $dir='/xampp1/htdocs/PHP_Project/Public/Images/Users/'.$image;
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
              $dir='/xampp1/htdocs/PHP_Project/Public/Images/Users/'.$image;
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

                  
                    $result=$this->insert($name,$email,$password,$room,$image,$role);
                    if($result){
                       echo "<h4 class='success'>success<h4>";
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




  // Validate Reset Email
  function ValidateReset($email)
  {
    if (empty($email)) {
      $this->errors['Email'] = 'Email Is Required';
    } else {
      if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $this->errors['EmailStyle'] = 'Email Not Found Register';
      }
    }
    return $this->errors;
  }

  //Check If User Exist Or Not
  function isUserExist()
  {
    try {
      if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $errors = $this->ValidateReset($email);
        if (empty($errors)) {
          $result = $this->checkRest($email);
          if ($result) {
            $data = mysqli_fetch_assoc($result);
            // session_start();
            $_SESSION['info'] = "Verification Code Sent To your Email :)";
            $_SESSION['email'] = $data['email'];
            $token = rand(999999, 111111);
            $_SESSION['token'] = $token;
            $res = $this->updateToken($data['email'], $token);
            if ($res) {
              // $this->sendEmail($email,$data['name'],$token);
              header('Location:./CodeVerification.php');
              exit();
            } else {
              echo "Failed while sending code!";
            }
          }
        } else {
          foreach ($errors as $key => $vale) {
            echo " <br><span class='alert alert-danger mt-5'>" . $key . "  =>  " . $vale . "</span><br>";
          }
        }
      }
    } catch (Exception $th) {
      echo $th->getMessage();
    }
  }

  //send verification code by mail
  //   function sendEmail($email,$name,$token){ 
  //     $mail = new PHPMailer(true); 
  //     try {
  //         // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  
  //         $mail->isSMTP();                                           
  //         $mail->Host       = 'smtp.gmail.com';                    
  //         $mail->SMTPAuth   = true;                                  
  //         $mail->Username   = 'goo.chrom312@gmail.com';                    
  //         $mail->Password   = 'secret';                              
  //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
  //         $mail->Port       = 587;         

  //         //Recipients
  //         $mail->setFrom('goo.chrom312@gmail.com', $name);
  //         $mail->addAddress('ahmed.abdelmawla312@gmail.com');     
  //         // $mail->addAddress('ellen@example.com');              
  //         // $mail->addReplyTo('info@example.com', 'Information');
  //         // $mail->addCC('cc@example.com');
  //         // $mail->addBCC('bcc@example.com');

  //         //Attachments
  //         // $mail->addAttachment('/var/tmp/file.tar.gz');     
  //         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

  //         //Content
  //         $mail->isHTML(true);                                 
  //         $mail->Subject = 'Reset Password Code';
  //         $mail->Body    = "Your Verification code is : $token";
  //         // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  //         $mail->send();
  //         echo 'Message has been sent';
  //     } catch (Exception $e) {
  //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  //     }
  // }

  //check if token is matched
  function checkCode()
  {
    try {
      // session_start();
      if (isset($_POST['submit'])) {
        $token = $_POST['code'];
        $email = $_SESSION['email'];
        $result = $this->checkRest($email);
        if ($result) {
          $data = mysqli_fetch_assoc($result);
          if ($token === $data['token']) {
            header('Location:./NewPassword.php');
          } else {
            echo " <br><span class='alert alert-danger mt-5'>Incorrect Code !!</span><br>";
          }
        }
      }
    } catch (Exception $th) {
      echo $th->getMessage();
    }
  }

  //rest password and remove token
  function restPass()
  {
    try {
      if (isset($_POST['submit'])) {
        $pass = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $email = $_SESSION['email'];
        $passPattern = '/^(?=.*[a-z])(?=.*\d)[a-z\d]{8}$/';
        if (empty($pass) || empty($confirmPassword)) {
          echo " <br><span class='alert alert-danger mt-5'>Fill Empty inputs</span><br>";
        } else if (!preg_match($passPattern, $pass)) {
          echo " <br><span class='alert alert-danger mt-5'>Invalid password .. must contain 8 of chars and numbers </span><br>";
        } else if ($confirmPassword != $pass) {
          echo " <br><span class='alert alert-danger mt-5'>Password and Confirm password not matched</span><br>";
        } else {
          $res = $this->restPassword($email, $pass);
          if ($res) {
            header('Location:./Login.php');
          } else {
            echo " <br><span class='alert alert-danger mt-5'>Failed To Update Password Try Again</span><br>";
          }
        }
      }
    } catch (Exception $th) {
      echo $th->getMessage();
    }
  }



}
?>