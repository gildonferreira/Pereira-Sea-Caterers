
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit']))
{
$_SESSION['name']=$_POST['name'];

$_SESSION['total_products']=$_POST['total_products']; 
$_SESSION['email']=$_POST['email']; 
$_SESSION['number']=$_POST['number'];
$_SESSION['Package_name']=$_POST['Package_name'];
$_SESSION['starter_Name']=$_POST['starter_Name'];
$_SESSION['MainCourse_Name']=$_POST['MainCourse_Name'];
$_SESSION['Dessert_Name']=$_POST['Dessert_Name'];
$_SESSION['total_price']=$_POST['total_price']; 
$_SESSION['address']=$_POST['address']; 
$_SESSION['venue']=$_POST['venue']; 
$_SESSION['pid']=$_POST['pid'];
$_SESSION['time']=$_POST['time'];
$_SESSION['deliver_date']=($_POST['deliver_date']);
if($_POST['email']!='')
{
header("location:pay.php");
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>checkout</h3>
   <p><a href="home.php">home</a> <span> / checkout</span></p>
</div>

<section class="checkout">

   <h1 class="title">order summary</h1>

<form action="" method="post">

   <div class="cart-items">
      <h3>package items</h3>
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `selectpackage` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = ' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].')  ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity'])+((($fetch_cart['price'] * $fetch_cart['quantity'])+18)/100);
               
      ?>
      <input type="hidden" name="pid" value="<?= $fetch_cart['id'] ?>">
      <input type="hidden" name="Package_name" value="<?= $fetch_cart['Package_name'] ?>">
      <input type="hidden" name="starter_Name" value="<?= $fetch_cart['starter_Name'] ?>">
      <input type="hidden" name="MainCourse_Name" value="<?= $fetch_cart['MainCourse_Name'] ?>">
      <input type="hidden" name="Dessert_Name" value="<?= $fetch_cart['Dessert_Name'] ?>">
      
      <p style="color:#FFFFFF;"><span class="name"><b>Package name: </b><?= $fetch_cart['Package_name']; ?></p>
     <p style="color:#FFFFFF;"><span class="name"><b>Starter name: </b><?= $fetch_cart['starter_Name']; ?><br><b>Main Course name:</b>
      <?= $fetch_cart['MainCourse_Name']; ?><br><b>Dessert name: </b><?= $fetch_cart['Dessert_Name']; ?>
      <p> 
     </span><span class="price">₹<?= $fetch_cart['price']; ?> (Per Plate) x <?= $fetch_cart['quantity'];?> (Quantity) + 18% (GST)</span><p>
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
      <p class="grand-total"><span class="name">Grand Total :</span><span class="price">₹<?= $grand_total; ?></span></p>
      
   </div>
  
   <input type="hidden" name="total_products" value="<?= $total_products; ?>">
   <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
   <input type="hidden" name="name" value="<?= $fetch_profile['user_name'] ?>">
   <input type="hidden" name="number" value="<?= $fetch_profile['ph_number'] ?>">
   <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
   <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

   <div class="user-info">
      <h3>Your info</h3>
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['user_name'] ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['ph_number'] ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
      
      <h3>Home Address</h3>
      <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'Please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_address.php" class="btn">update address</a>
      <h3>Delivery address</h3>
      <select name="venue" class="box" required>
         <option value="" disabled selected>Select Venue/Home --</option>
         <option value="<?= $fetch_profile['address']?> (Home Address) "><?php echo $fetch_profile['address'];?> (Home Address) </option>
         
         <option value="God's Garden, Verna Goa">God's Garden, Verna Goa</option>
         <option value="Quatro Banquet, Verna Goa">Quatro Banquet, Verna Goa</option>
         <option value="The Village, Nuvem Goa">The Village, Nuvem Goa</option>
         <option value="Wild Orchid, Majorda Goa">Wild Orchid, Majorda Goa</option>
         <option value="The White House, Arlem Goa">The White House, Arlem Goa</option>
         <option value="BlueBerry Hill, Nagoa Goa">BlueBerry Hill, Nagoa Goa</option>
         <option value="Coco Loco Lawns, Agacaim Goa">Coco Loco Lawns, Agacaim Goa</option>
         <option value="Old Heritage, Agacaim Goa">Old Heritage, Agacaim Goa</option></select>
      <h3>delivery date</h3>
      <input type="date" class="box" name="deliver_date" id="deliver_date"value=""  required>
      <h3>delivery Time</h3>
      <input type="time" class="box" id="time" onchange="validateTime()" name="time" required>
      <script>
function validateTime() {
  var inputTime = document.getElementById('time').value;
  var startTime = new Date('1970-01-01T09:00');
  var endTime = new Date('1970-01-01T20:00');
  var selectedTime = new Date('1970-01-01T' + inputTime);

  if (selectedTime < startTime || selectedTime > endTime) {
    alert('Please select a time between 9 am and 8 pm.');
    // You can reset the input value or take other actions as needed.
    document.getElementById('time').value = '';
  }
}
</script>


<script language="javascript">
  document.addEventListener('DOMContentLoaded', function () {
            var today = new Date();
            today.setDate(today.getDate() + 7); // Set to tomorrow
            var minDate = today.toISOString().split('T')[0];
            
            document.getElementById('deliver_date').setAttribute('min', minDate);
        });
</script>
    <?php
// Connect to your database (replace these variables with your actual database credentials)
$conn = new mysqli('localhost', 'root', '', 'pereira_sea_caterers');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve dates from the database
$sql = "SELECT deliver_date FROM orders";
$result = $conn->query($sql);

// Fetch dates and store them in an array
$dates = array();
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['deliver_date'];
}

// Close the database connection
$conn->close();

// Convert the PHP array to a JavaScript array
$js_dates = json_encode($dates);
?>
    <script>
    // Disable specific dates using JavaScript
    var disabledDates =<?php echo $js_dates; ?>;

    document.getElementById("deliver_date").addEventListener("input", function() {
        var selectedDate = this.value;

        // Check if the selected date is in the disabledDates array
        if (disabledDates.includes(selectedDate)) {
            alert("The selected date is booked. Please choose another date.");
            this.value = ""; // Clear the input field
        }
    });
</script>
      <input type="submit" value="place order" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
   </div>

</form>
   
</section>









<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>