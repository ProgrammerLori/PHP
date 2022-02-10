<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "localhost";
$username = "phpteszt";
$password = "]Bh.QH!YrMww@2]G";
$dbname = "teszt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 

?>
