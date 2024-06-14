<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};
if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `selectpackage` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'package item deleted!';
}
if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `selectpackage` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'package quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->


<!-- shopping cart section starts  -->

<section class="products">

   <h1 class="title">Quantity</h1>

   <div class="box-container">

      <?php
      $pid = $_GET['pid'];
      if($user_id == ''){
         header('location:login.php');}
         else{

         $grand_total = 0;
         $grand_total1 = 0;
         $select_cart = $conn->prepare("SELECT * FROM `selectpackage` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>
         <div style="background-color:var(--yellow);" class="name"><b>Package name:</b><?= $fetch_cart['Package_name']; ?></div>
         <div class="name"><b>Starter: </b><?= $fetch_cart['starter_Name']; ?></div>
         <div class="name"><b>Main Course: </b><?= $fetch_cart['MainCourse_Name']; ?></div>
         <div class="name"><b>Dessert: </b><?= $fetch_cart['Dessert_Name']; ?></div>
         <div class="flex">
            <div class="price"><span>Rs: </span><?= $fetch_cart['price']; ?></div>

            <input type="number" name="qty" class="qty" min="20" max="1000" value="<?= $fetch_cart['quantity']; ?>" maxlength="5">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> Sub total : <span>Rs: <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
         <div class="sub-total">  With 18% of GST : <span>Rs: <?=  $grand_total1 +=$sub_total +($sub_total+18)/100;?>/-</span> </div>
      </form>
      <?php
               $grand_total +=$sub_total +($sub_total+18)/100;
            }
         }else{
            echo '<p class="empty">your package is empty</p>';
         }
      ?>

   </div>

   <div class="cart-total">
      <p>Total price: <span>Rs: <?= $grand_total; ?>/-</span></p>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">place order</a>
   </div>

</section>
<?php
            }
       
      ?>
<!-- shopping cart section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>