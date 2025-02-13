<?php

include 'components/connect.php';

session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      if($row['is_verified'] == 1){
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      } else {
         $message[] = 'Your email is not verified.';
      }
   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="icon" type="image/x-icon" href="logo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

<?php include 'components/user_header.php'; ?>
<section class="form-container">

   <form class="label" action="" method="post">
      <h3>Login</h3>
      <h1 style="text-align:left;">Email:</h1>
      <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <h1 style="text-align:left;">Password:</h1>
      <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Login" name="submit" class="btn">
      <p>Don't have an account? <a href="register.php">Register</a></p>
   </form>

</section>


















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>