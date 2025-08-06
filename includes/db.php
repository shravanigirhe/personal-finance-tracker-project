<?php
$conn = mysqli_connect("localhost", "root", "", "finance_tracker");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
