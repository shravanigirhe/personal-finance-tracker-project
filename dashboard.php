<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit;
}

$user_id = $_SESSION['user_id'];
$name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users WHERE id=$user_id"))['name'];
$income = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM transactions WHERE user_id=$user_id AND type='income'"))['total'] ?? 0;
$expense = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM transactions WHERE user_id=$user_id AND type='expense'"))['total'] ?? 0;
$balance = $income - $expense;
$transactions = mysqli_query($conn, "SELECT * FROM transactions WHERE user_id=$user_id ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>Hello, <?= $name ?> 👋</h2>
    <p><strong>Income:</strong> ₹<?= $income ?> | <strong>Expense:</strong> ₹<?= $expense ?> | <strong>Balance:</strong> ₹<?= $balance ?></p>
    <p><a href="add.php">+ Add Transaction</a> | <a href="logout.php">Logout</a></p>
    
    <<table>
  <tr><th>Type</th><th>Amount</th><th>Category</th><th>Date</th><th>Note</th></tr>
  <?php while($row = mysqli_fetch_assoc($transactions)) { ?>
  <tr>
    <td><?= $row['type'] ?></td>
    <td>₹<?= $row['amount'] ?></td>
    <td><?= $row['category'] ?></td>
    <td><?= $row['date'] ?></td>
    <td><?= $row['note'] ?></td>
  </tr>
  <?php } ?>
</table>
  </div>
</body>
</html>
