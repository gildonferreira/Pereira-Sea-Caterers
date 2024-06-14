<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '.$_POST['area'].', '.$_POST['town'] .', '. 'Goa' .', '. 'India' .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'address saved!';
   header('location:profile.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update address</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <h1 style="text-align:left;">Flat no./H.no.:</h1>
      <input type="text" class="box" placeholder="flat no./H.no." required maxlength="50" name="flat">
      <h1 style="text-align:left;">Area name:</h1>
      <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
      <h1 style="text-align:left;">Village/City name:</h1>
      <select name="town" class="box" required>
         <option value="" disabled selected>Select Village/City --</option>
         <option value="Cuncolim">Cortalim</option>
         <option value="Verna">Cansaulim</option>
         <option value="Goa-velha">Goa-velha</option>
         <option value="Margao">Margao</option>
         <option value="Mapusa">Mapusa</option>
         <option value="Verna">Majorda</option>
         <option value="Old-Goa">Old-Goa</option>
         <option value="Panaji">Panaji</option>
         <option value="Pilar">Pilar</option>
         <option value="Ponda">Ponda</option>
         <option value="Verna">Verna</option>
         <option value="Verna">Velsao</option>
         <option value="Vasco da Gama">Vasco da Gama</option>

      
      <h1 style="text-align:left;">State name:</h1>
      <input type="hidden" class="box" placeholder="state name" required maxlength="50" name="state" value="Goa" >
      <input type="text" class="box" placeholder="state name" required maxlength="50" name="state" value="Goa" disabled>
      <h1 style="text-align:left;">Country name:</h1>
      <input type="text" class="box" placeholder="country name" required maxlength="50" name="country"value="India" disabled>
      <h1 style="text-align:left;">Pin code:</h1>
      <input type="number" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

</section>










<?php include 'components/footer.php' ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>