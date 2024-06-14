<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>
   <link rel="icon" type="image/x-icon" href="logo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

   <h1 class="title">food category</h1>

   <div class="box-container">

      <?php
         $category = $_GET['category'];
         $select_products = $conn->prepare("SELECT * FROM `item` WHERE categories = ?");
         $select_products->execute([$category]);
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="item_id" value="<?= $fetch_products['item_id']; ?>">
         <input type="hidden" name="Name" value="<?= $fetch_products['Name']; ?>">
         <input type="hidden" name="Description" value="<?= $fetch_products['Description']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         
         
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <div class="name"><b>Name: </b><?= $fetch_products['Name']; ?></div>
         <div class="flex">
            <div class="name"><b>Description: </b><?= $fetch_products['Description']; ?></div>
            
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

</section>








<?php include 'components/footer.php'; ?>



<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>