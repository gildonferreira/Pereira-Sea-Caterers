<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
  ;
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="icon" type="image/x-icon" href="logo.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

 

</section>

<section class="category">

   <h1 class="title">Food Category</h1>

   <div class="box-container">

      <a href="category.php?category=Starter" class="box">
         <img src="images/cat-1.png" alt="">
         <h3>Starters</h3>
      </a>

      <a href="category.php?category=Main Course" class="box">
         <img src="images/cat-2.png" alt="">
         <h3>Main Course</h3>
      </a>

      

      <a href="category.php?category=Dessert" class="box">
         <img src="images/cat-4.png" alt="">
         <h3>Desserts</h3>
      </a>

   </div>

</section>
<section>
<h1 class="title">BOOK CALENDAR</h1>
<div style ="font-size: 2rem;"class="title">Check if date is available or not</div>
<?php include 'calender.php'; ?>
</section>
<section class="products">

   <h1 class="title">Package</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `package` ");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
               $starter_Name=$fetch_products['starter_Name'];
               $MainCourse_Name=$fetch_products['MainCourse_Name'];
               $Dessert_Name=$fetch_products['Dessert_Name'];
      ?>       
       <?php
$starter_Name = explode(",", $starter_Name);
$MainCourse = explode(",", $MainCourse_Name);
$Dessert_Name = explode(",", $Dessert_Name);
?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['Package_ID']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['Package_Name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         
         
         
         <div style="background-color:var(--yellow);"class="name"><i><h2><?= $fetch_products['Package_Name']; ?></h2></i></div>
         <div style="background-color:#D3D3D3;">
         <div class=name><b>Starter :<br> </b>
         
      <div class="name"><b> Select only :</b> <?= $fetch_products['number_of_starter']; ?></div>
      <?php
    foreach ($starter_Name as $item) {
        
        $starter_Name = trim($item);

        
        echo '*' . $starter_Name . '<br>';
    }
    ?></div>
    <div class=name><b>MainCourse :<br> </b>
      <div class="name"><b> Select only: </b><?= $fetch_products['number_of_MainCourse']; ?></div>
      <?php
    foreach ($MainCourse as $item1) {
        
        $MainCourse = trim($item1);

        
        echo '*' . $MainCourse . '<br>';
    }
    ?></div>
    <div class=name><b>Dessert :<br> </b>
      <div class="name"><b>Select only: </b><?= $fetch_products['number_of_Dessert']; ?></div>
    <?php
    foreach ($Dessert_Name as $item2) {
        
        $Dessert_Name = trim($item2);

        
        echo '*' . $Dessert_Name . '<br>';
    }
    ?></div>
      
      
         <div class="flex">
            <div class="price"><b>Per plate Rs: </b><?= $fetch_products['price']; ?><span>/-<br><br></span></div>
            <a href="package_selected.php?pid=<?= $fetch_products['Package_ID']; ?>" class="btn">Book</a></div>
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no Package added yet!</p>';
         }
      ?>

   </div>
   
</section>

<?php include 'components/footer.php'; ?>




















<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>