<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Giao Đồ Ăn</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-light bg-light px-3">
  <a class="navbar-brand" href="index.php">🍔 FoodExpress</a>
  <div class="ml-auto">
    <a href="cart.php" class="btn btn-outline-success mr-2">🛒 Giỏ hàng</a>
    <?php if (isset($_SESSION['user'])): ?>
      <span class="mr-2">👤 <?= $_SESSION['user'] ?> (<?= $_SESSION['role'] ?>)</span>
      <?php if ($_SESSION['role'] == 'admin'): ?>
        <a href="manage.php" class="btn btn-warning mr-2">Quản lý</a>
        <a href="history.php" class="btn btn-outline-info mr-2">📜 Đơn đã đặt</a>

      <?php endif; ?>
      <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
    <?php else: ?>
      <a href="login.php" class="btn btn-primary mr-2">Đăng nhập</a>
      <a href="register.php" class="btn btn-secondary">Đăng ký</a>
    <?php endif; ?>
  </div>
</nav>
