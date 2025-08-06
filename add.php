<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $type = $_POST['type'];
  $amount = $_POST['amount'];
  $category = $_POST['category'];
  $date = $_POST['date'];
  $user_id = $_SESSION['user_id'];
  $note = $_POST['note'];
$sql = "INSERT INTO transactions (user_id, type, amount, category, date, note)
        VALUES ($user_id, '$type', $amount, '$category', '$date', '$note')";
  mysqli_query($conn, $sql);
  header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Transaction</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>Add Transaction</h2>
    <form method="POST">
  <select name="type">
    <option value="income">Income</option>
    <option value="expense">Expense</option>
  </select>
  <input type="number" name="amount" placeholder="Amount" required>
  <input type="text" name="category" placeholder="Category" required>
  <input type="date" name="date" required>
  <textarea name="note" placeholder="Add note (optional)"></textarea>
  <button type="submit">Add</button>
</form>
  </div>
</body>
</html>
