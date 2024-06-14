<?php

include 'components/connect.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code)
{
   require ("PHPMailer/Exception.php");
require ("PHPMailer/PHPMailer.php");
require ("PHPMailer/SMTP.php");

$mail = new PHPMailer(true);
try {
   $mail->isSMTP();                                            //Send using SMTP
   $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
   $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
   $mail->Username   = 'macofeds29@gmail.com';                     //SMTP username
   $mail->Password   = 'soaqjoddemxanisq';                               //SMTP password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
   $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

   //Recipients
   $mail->setFrom('macofeds29@gmail.com', 'Pereira Sea Caterers');

   $mail->addAddress($email);     //Add a recipient
   
 
   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = 'Email verification from Pereira Sea Caterers';
   $mail->Body    = '<html>
   <head>
       <title>Registration Verification</title>
   </head>
   <body>
       <div style="text-align: center;">
           <img src="https://i.postimg.cc/Y0T2HsGN/logo.png" alt="Logo" style="width: 200px; height: auto;">
           <h2>Thanks for registration!</h2>
           <p>Please click on the button below to verify your email address:</p>
           <a href="http://localhost/PEREIRA%20_SEA_CATERERS/verifye.php?email=' . $email . '&v_code=' . $v_code . '" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Verify Email</a>
       </div>
   </body>
   </html>
';

 

   $mail->send();
  return true;
   } catch (Exception $e) {
   return false;
   }
}

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR ph_number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email or Phone number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         $v_code=bin2hex(random_bytes(16));
         $insert_user = $conn->prepare("INSERT INTO `users`(user_name, email, ph_number, password, verification_code, is_verified) VALUES(?,?,?,?,'$v_code','0')");
         $insert_user->execute([$name, $email, $number, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0 && sendMail($_POST['email'],$v_code)){
            
           
            header('location:login.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="icon" type="image/x-icon" href="logo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

   <form action="" method="post">
      <h3>Register</h3>
<h1 style="text-align:left;">User name:</h1>
      <input type="text" name="name" required placeholder="Enter your user name" class="box" maxlength="50">
      <h1 style="text-align:left;">Email:</h1>
      <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <h1 style="text-align:left;">Phone Number:</h1>
      <input type="number" name="number" required placeholder="Enter your number" class="box" min="0" max="9999999999"minlength="10" maxlength="10">
      <h1 style="text-align:left;">  Password:</h1>
      <input type="password" name="pass" required placeholder="Enter your password" class="box" minlength="8" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <h1 style="text-align:left;">Confirm Password:</h1>
      <input type="password" name="cpass" required placeholder="Confirm your password" class="box"minlength="8" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Create Account" name="submit" class="btn">
      <p>Already have an account? <a href="login.php">Login</a></p>
   </form>

</section>



















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>