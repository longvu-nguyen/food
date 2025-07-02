<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>📜 Lịch sử đơn hàng</h2>

  <?php
  $user = $_SESSION['user'];
  $rs = $conn->query("SELECT * FROM orders WHERE username='$user' ORDER BY created_at DESC");

  if ($rs->num_rows == 0) {
    echo "<p>Chưa có đơn hàng nào.</p>";
  } else {
    while ($row = $rs->fetch_assoc()) {
      echo "<div class='border p-3 mb-3'>
        <strong>🧾 Món:</strong><br><pre>{$row['items']}</pre>
        <strong>💰 Tổng:</strong> {$row['total']}.000đ<br>
        <strong>🔄 Thanh toán:</strong> {$row['method']}<br>
        <strong>📦 Trạng thái:</strong> {$row['status']}<br>
        <strong>📅 Ngày:</strong> {$row['created_at']}
      </div>";
    }
  }
  ?>
</div>
<?php include 'footer.php'; ?>
