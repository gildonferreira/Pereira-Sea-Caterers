<?php require('razorpay-php/Razorpay.php'); include ("components/connect.php");
   session_start();

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
      header('location:home.php');
   };   ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment  </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>

				
<hr>
<?php 
include("gateway-config.php");
//Razorpay//
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);
$firstname=$_SESSION['name']; 
$pid=$_SESSION['pid'];
$total_products=$_SESSION['total_products'];
 $email=$_SESSION['email'];
$mobile=$_SESSION['number'];
$address=$_SESSION['address'];
$price=$_SESSION['total_price'];
$venue=$_SESSION['venue'];
$title=$_SESSION['Package_name'];
$starter_Name=$_SESSION['starter_Name'];
$time=$_SESSION['time'];
$MainCourse_Name=$_SESSION['MainCourse_Name'];
$Dessert_Name=$_SESSION['Dessert_Name'];
$datee=date('d-m-y',strtotime($_SESSION['deliver_date']));

            
$webtitle='PEREIRA SEA CATERERS'; // Change web title
$displayCurrency='INR';
$imageurl='images/logo.png'; //change logo from here
$orderData = [
    'receipt'         => 3456,
    'amount'          => $price * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $webtitle,
    "description"       => $title,
    "image"             => $imageurl,
    "prefill"           => [
    "name"              => $firstname,
    "email"             => $email,
    "contact"           => $mobile,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);


 ?>
				
                <section class="products">

<h1 class="title">payment</h1>

<div class="box-container">
  <div class="box">
    <label  class="name"><b>First Name : </b><?php echo $firstname; ?></label>
   
  
  

  <div class="name">
    <label class="label"><b>Email: </b></label>
      <?php echo $email; ?>
  </div>
  <div class="name">
    <label class="label"><b>Mobile: </b><?php echo $mobile; ?></label>
      
  
  <div class="name">
    <label class="label"><b>Deliver Address: </b><?php echo $venue; ?></label>
    
  </div>
  <div class="name">
    <label class="label"><b>Pacakage name: </b><?php echo $title; ?></label>
      
      <div class="name">
    <label class="label"><b>Starter name: </b><?php echo $starter_Name; ?></label>
      
      <div class="name">
    <label class=""><b>Main Course name: </b><?php echo $MainCourse_Name; ?></label>
      
    <div class="name">
    <label class=""><b>Dessert Name: </b><?php echo $Dessert_Name; ?></label>
    <div class="name">
    <div class="name">
    <label class=""><b>Total item(Price X Quantity): </b><?php echo $total_products ?></label>
    <div class="name">
    <label class="label"><b>Deliver date: </b><?php echo $datee; ?></label>
    <div class="name">
    <label class="label"><b>Deliver time: </b><?php echo $time; ?> hrs</label>
    <div class="name">
      <label class="label"><b>Price(₹): </b></label>
      <?php echo $price; ?>
 


					</div>
					<div class="col-4 text-center">
					 
					 
         
				<br>
				  <center>
   <form class="btn" action="verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="<?php echo $pid;?>"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="<?php echo $pid;?>">
</form>
</center>

				</div>
				</div>
		</div>
	</div>
</div>
</body>
</html>