<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
   
};

if(isset($_POST['add_package'])){

   $Package_Name=$_POST['name'];
   $Package_Name = filter_var($Package_Name, FILTER_SANITIZE_STRING);
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $quantity = $_POST['quantity'];
   $quantity = filter_var($quantity, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $starter = isset($_POST['starter']) ? $_POST['starter'] : [];
$starter1 = implode(",", $starter);

$MainCourse = isset($_POST['Course']) ? $_POST['Course'] : [];
$MainCourse1 = implode(",", $MainCourse);

$Dessert = isset($_POST['Dessert']) ? $_POST['Dessert'] : [];
$Dessert1 = implode(",", $Dessert);

$select_products = $conn->prepare("SELECT * FROM `selectpackage` WHERE id = ?");
$select_products->execute([$pid]);

if($select_products->rowCount() > 0){
   $message[] = 'package name already exists!';
}else{
   $insert_product = $conn->prepare("INSERT INTO `selectpackage`(`user_id`,`Package_name`, `pid`, `starter_Name`, `MainCourse_Name`, `Dessert_Name`, `price`, `quantity`) VALUES(?,?,?,?,?,?,?,?)");
   $insert_product->execute([$user_id,$Package_Name,$pid,$starter1,$MainCourse1, $Dessert1,$price,$quantity]);
  
         $message[] = 'package added!';

         header("location:quantity.php?pid=id");
      }
   }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Package </title>
   <link rel="icon" type="image/x-icon" href="logo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="title">Select Menu Items</h1>

   <?php
      $pid = $_GET['pid'];
      if($user_id == ''){
         header('location:login.php');}
         else{

         
      $select_products = $conn->prepare("SELECT * FROM `package` WHERE package_ID = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            $starter_Name=$fetch_products['starter_Name'];
            $MainCourse_Name=$fetch_products['MainCourse_Name'];
            $Dessert_Name=$fetch_products['Dessert_Name'];
   ?>
   <?php
$starter_Name = explode(",", $starter_Name);
$MainCourse_Name = explode(",", $MainCourse_Name);
$Dessert_Name = explode(",", $Dessert_Name);
?><form action="" method="post" class="box">
   <input type="hidden" name="pid" value="<?= $fetch_products['Package_ID']; ?>">
   <input type="hidden" name="number_of_starter" value="<?= $fetch_products['number_of_starter']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['Package_Name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="quantity" value="20">
        
      
         
         
         
         <div class="name"><b>Package Name:</b> <?= $fetch_products['Package_Name']; ?></div>
      
      
      
      
      <div class=name><b>Starter:<br> </b>
      
      <div class="name"><b>Select only </b> <?= $fetch_products['number_of_starter']; ?> <b>Starters</b></div><?php
      
    foreach ($starter_Name as $item) {
        
        $starter_Name = trim($item);

        
        echo '<input type="checkbox" name="starter[]" onclick="validateCheckbox()" value="' . $starter_Name . '" > ' . $starter_Name . '<br>';
    }
    ?>
        <script>
        function validateCheckbox8() {
            var checkboxes = document.getElementsByName('starter[]');
            var minChecked = <?php echo $fetch_products['number_of_starter']; ?>;
            var checkedCount = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCount++;
                }
            }

            if (checkedCount < minChecked) {
                alert("Please select at least " + minChecked + " Starter.");
                return false;
            }

            return true;
        }
    
        function validateCheckbox() {
            var checkboxes = document.getElementsByName('starter[]');
            var checkedCheckboxes = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCheckboxes++;
                }
            }

            if (checkedCheckboxes === <?php echo $fetch_products['number_of_starter']; ?>) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (!checkboxes[i].checked) {
                        checkboxes[i].disabled = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].disabled = false;
                }
            }
        }
    </script></div>
    <div class=name><b>MainCourse : </b><br>
    <div class="name"><b>Select only </b><?= $fetch_products['number_of_MainCourse']; ?><b> Main Course</b></div><?php
    foreach ($MainCourse_Name as $item) {
        
        $MainCourse_Name = trim($item);

        
        echo '<input type="checkbox" name="Course[]" onclick="validateCheckbox1()" value="' . $MainCourse_Name . '"> ' . $MainCourse_Name . '<br>';
    }
    ?>
    <script>
         function validateCheckbox9() {
            var checkboxes = document.getElementsByName('Course[]');
            var minChecked = <?php echo $fetch_products['number_of_MainCourse']; ?>;
            var checkedCount1 = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCount1++;
                }
            }

            if (checkedCount1 < minChecked) {
                alert("Please select at least " + minChecked + " Main Course.");
                return false;
            }

            return true;
        }
        function validateCheckbox1() {
            var checkboxes = document.getElementsByName('Course[]');
            var checkedCheckboxes = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCheckboxes++;
                }
            }

            if (checkedCheckboxes === <?php echo $fetch_products['number_of_MainCourse']; ?>) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (!checkboxes[i].checked) {
                        checkboxes[i].disabled = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].disabled = false;
                }
            }
        }
    </script></div>
    <div class=name><b>Dessert : </b><br>
    <div class="name"><b>Select only </b><?= $fetch_products['number_of_Dessert']; ?><b> Dessert</b></div><?php
    foreach ($Dessert_Name as $item) {
                                                                                                                     
        $Dessert_Name = trim($item);

        
        echo '<input type="checkbox" name="Dessert[]" onclick="validateCheckbox2()" value="' . $Dessert_Name . '"> ' . $Dessert_Name . '<br>';
    }
    ?>
    <script>
        function validateCheckbox10() {
            var checkboxes = document.getElementsByName('Course[]');
            var minChecked = <?php echo $fetch_products['number_of_Dessert']; ?>;
            var checkedCount2 = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCount2++;
                }
            }

            if (checkedCount2 < minChecked) {
                alert("Please select at least " + minChecked + " Dessert.");
                return false;
            }

            return true;
        }
        function validateCheckbox2() {
            var checkboxes = document.getElementsByName('Dessert[]');
            var checkedCheckboxes = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCheckboxes++;
                }
            }

            if (checkedCheckboxes === <?php echo $fetch_products['number_of_Dessert']; ?>) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (!checkboxes[i].checked) {
                        checkboxes[i].disabled = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].disabled = false;
                }
            }
        }
    </script></div>
     
         <div class="flex">
            <div class="price">Rs: <?= $fetch_products['price']; ?><span>/-</span></div>
          </div> 
           <input type="submit" value=" Add items " name="add_package" class="btn "  onclick="return validateCheckbox8(), validateCheckbox9(),validateCheckbox10()"></a>
           
          
             </form>
            </div>
      <?php
            }
         }else{
            echo '<p class="empty">not add the package   </p>';
         }
      
      ?>

   </div>

</section>
<?php include 'components/footer.php'; }?>
   