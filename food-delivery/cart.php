<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>🛒 Giỏ hàng của bạn</h2>
  <a href="checkout.php" class="btn btn-success mt-3">👉 Thanh toán</a>
  <?php
  
  if (empty($_SESSION['cart'])) {
    echo "<p>Giỏ hàng đang trống.</p>";
  } else {
    $ids = implode(",", $_SESSION['cart']);
    $rs = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    $total = 0;
    while ($row = $rs->fetch_assoc()) {
      echo "<div class='mb-2'>{$row['name']} - {$row['price']}.000đ</div>";
      $total += $row['price'];
    }
    echo "<h5 class='mt-3'>Tổng cộng: $total.000đ</h5>";
  }
  ?>
</div>
<?php include 'footer.php'; ?>
