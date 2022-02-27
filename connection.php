<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "erent";

// $username = "id16500058_erental";
// $password = "kyve5N*acher";
// $database = "id16500058_erent";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 echo "Connected successfully";
?>
