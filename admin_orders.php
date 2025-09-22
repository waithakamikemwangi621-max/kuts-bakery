<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bakery_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("DB Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");

echo "<h1>All Orders</h1>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Name</th><th>Item</th><th>Qty</th><th>Address</th><th>Date</th></tr>";

while ($row = $result->fetch_assoc()) {
  echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['customer_name']}</td>
          <td>{$row['item']}</td>
          <td>{$row['quantity']}</td>
          <td>{$row['address']}</td>
          <td>{$row['order_date']}</td>
        </tr>";
}
echo "</table>";

$conn->close();
?>