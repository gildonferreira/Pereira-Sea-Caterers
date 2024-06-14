<?php require('razorpay-php/Razorpay.php'); include ("components/connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

        session_start();

        if(isset($_SESSION['user_id'])){
           $user_id = $_SESSION['user_id'];
        }else{
           $user_id = '';
           header('location:home.php');
        };  
      ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment Verification </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/user_header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 form-container">
				<h1>Payment Status</h1>
<hr>


				<div class="row"> 
					<div class="col-8"> 
            <?php 
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$success = true;
include("gateway-config.php");
$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}



if ($success === true)
{
    $api = new Api($keyId, $keySecret);
    $firstname=$_SESSION['name']; 
    $pid=$_SESSION['pid'];
    $total_products=$_SESSION['total_products'];
     $email=$_SESSION['email'];
    $mobile=$_SESSION['number'];
    $address=$_SESSION['address'];
    $venue=$_SESSION['venue'];
    $title=$_SESSION['Package_name'];
    $starter_Name=$_SESSION['starter_Name'];
    $MainCourse_Name=$_SESSION['MainCourse_Name'];
    $Dessert_Name=$_SESSION['Dessert_Name'];
    $time=$_SESSION['time'];
    $datee=date('y-m-d',strtotime($_SESSION['deliver_date'])); 

$posted_hash = $_SESSION['razorpay_order_id'];
    if(isset($_POST['razorpay_payment_id']))
        
    $txnid = $_POST['razorpay_payment_id'];
    $amount = $_SESSION['total_price'];
    $status='success'; 
  $eid=$_POST['shopping_order_id']; 
$subject='Your payment has been successful..';
       $key_value='okpmt'; 
  
$currency='INR';
$date = new DateTime(null, new DateTimezone("Asia/Kolkata"));
$payment_date=$date->format('Y-m-d H:i:s');
$stmt = $conn->prepare("SELECT count(*) FROM `orders` WHERE txnid = ?");
$stmt->execute([$txnid]);
           $stmt->bindParam(':txnid', $txnid, PDO::PARAM_STR);
           
          $countts=$stmt->fetchcolumn();
  if($txnid!=''){
    if($countts<=0)
    {
        $insert_product = $conn->prepare("INSERT INTO `orders`( `user_id`,`name`, `package_name`, `starter_Name`, `MainCourse_Name`, `Dessert_Name`, `total_item`, `deliver_date`,`deliver_time`, `amount`, `txnid`, `pid`, `payer_email`, `currency`, `mobile`, `address`,`venue`, `payment_date`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert_product->execute([$user_id,$firstname,$title,$starter_Name,$MainCourse_Name,$Dessert_Name, $total_products,$datee,$time,$amount,$txnid,$pid,$email,$currency,$mobile,$address,$venue,$payment_date,$status]);
}$message[] = 'item added!';
function sendMail($email, $txnid,$firstname,$address,$datee,$payment_date,$starter_Name,$MainCourse_Name,$Dessert_Name,$amount) {
    require ("PHPMailer/Exception.php");
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");

    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'macofeds29@gmail.com';
        $mail->Password   = 'soaqjoddemxanisq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->setFrom('macofeds29@gmail.com', 'Pereira Sea Caterers');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Payment Status';
        $mail->Body = "
        <div style='text-align: left;'>
        <center>
            <h1>Order Details</h1>
            <p><strong>Transaction Id:</strong> $txnid</p>
            <p><strong>Username:</strong> $firstname</p>
            <p><strong>Delivery Address:</strong> $address</p>
            <p><strong>Delivery Date:</strong> $datee</p>
            <p><strong>Date of Purchase:</strong> $payment_date</p>
            <hr>
            </center>
            <table style='width: 100%; border-collapse: collapse;'>
                <tr>
                    <th style='border: 1px solid #ddd; padding: 8px;'>Details</th>
                    <th style='border: 1px solid #ddd; padding: 8px;'>Price</th>
                </tr>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'><b>Starters:</b>$starter_Name<br><b>Main Course:</b> $MainCourse_Name<br><b>Dessert:</b> $Dessert_Name</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>Amount(₹): $amount</td>
                </tr>
            </table>
            <br>
            <p>Check the order by clicking on the link below:</p>
            <a href='http://localhost/PEREIRA%20_SEA_CATERERS/orders.php' style='background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Check Order</a>
        </div>
    ";
    

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
$delete_cart = $conn->prepare("DELETE FROM `selectpackage` WHERE user_id = ?");
$delete_cart->execute([$user_id]);
 // start 
        echo ' <h2 style="color:#33FF00";>'.$subject.'</h2>   <hr>';

        echo '<table class="table">'; 
        echo '<tr> '; 
        $stmt = $conn->prepare("SELECT count(*) FROM `orders` WHERE txnid = ?");
        $stmt->execute([$txnid]);
                   $stmt->bindParam(':txnid', $txnid, PDO::PARAM_STR);
           $rows=$stmt->fetchAll();
foreach($rows as $row)
{
    
}
echo '
<tr>  
          <th>Transaction ID:</th>
        <td>'.$txnid.'</td> 
    </tr>
    <tr>
    <th>Quantity (Price X Quantity) :</th>
    <td>'.$total_products.'</td> 
   </tr>
     <tr> 
        <th>Paid Amount:</th>
        <td>'.$amount.' '. $currency.'</td> 
    </tr>
    <tr>
       <th>Payment Status:</th>
        <td>'.$status.'</td> 
   </tr>
   <tr> 
       <th>Payer Email:</th>
       <td>'.$email.'</td> 
   </tr>
    <tr> 
       <th>Name:</th>
       <td>'.$firstname.'</td>
   </tr>
   
   
   <tr> 
       <th>Mobile:</th>
       <td>'.$mobile.'</td>
   </tr>
   <tr>
   <tr> 
       <th>Deliver Address:</th>
       <td>'.$venue.'</td>
   </tr>
       <th>Delivery date :</th>
       <td>'.$datee.'</td> 
  </tr>
  <tr>
  <th>Delivery time :</th>
  <td>'.$time.' hrs</td> 
</tr>
   <tr>
       <th>Package name :</th>
       <td>'.$title.'</td> 
  </tr>
  <tr>
       <th>Starter Name  :</th>
       <td>'.$starter_Name.'</td> 
  </tr>
  <tr>
       <th>MainCourse Name  :</th>
       <td>'.$MainCourse_Name.'</td> 
  </tr>
  <tr>
       <th>Dessert Name  :</th>
       <td>'.$Dessert_Name.'</td> 
  </tr>
 
  <tr>
       <th>Payment date :</th>
       <td>'.$payment_date.'</td> 
  </tr>
  </table>';
}
 else 
 {
  $html = "<p><div class='errmsg'>Invalid Transaction. Please Try Again</div></p>";   
  $error_found=1;      
 } 
 sendMail($email,$txnid,$firstname,$address,$datee,$payment_date,$starter_Name,$MainCourse_Name,$Dessert_Name,$amount);   
}

else
{
    $html = "<p><div class='errmsg'>Invalid Transaction. Please Try Again</div></p>
             <p>{$error}</p>";
             $error_found=1;
}
if(isset($html)){
echo $html;
}
?>
					</div>
					<div class="col-4 text-center">
					
				<br> 
				</div>
				</div>
		</div>
	</div>	
</div>
</body>
</html>