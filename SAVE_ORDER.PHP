<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer
// OR include 'PHPMailer/src/PHPMailer.php'; etc. if copied manually

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bakery_db";

// Connect DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("DB Connection failed: " . $conn->connect_error);
}

// Get form data
$name    = $_POST['name'];
$item    = $_POST['item'];
$qty     = $_POST['quantity'];
$address = $_POST['address'];

// Insert into DB
$sql = "INSERT INTO orders (customer_name, item, quantity, address) 
        VALUES ('$name', '$item', '$qty', '$address')";
$conn->query($sql);

// Send Email
$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'your_email@gmail.com'; // CHANGE THIS
  $mail->Password   = 'your-app-password';    // CHANGE THIS
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;

  $mail->setFrom('your_email@gmail.com', 'Bakery Website');
  $mail->addAddress('yourbakeryemail@example.com'); // CHANGE THIS

  $mail->isHTML(true);
  $mail->Subject = "New Order from $name";
  $mail->Body    = "Customer: $name <br> Item: $item <br> Qty: $qty <br> Address: $address";

  $mail->send();
  echo "Order placed successfully!";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$conn->close();
?>