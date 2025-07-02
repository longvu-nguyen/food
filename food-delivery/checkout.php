<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>💳 Thanh toán</h2>

  <?php if (empty($_SESSION['cart'])): ?>
    <p>Giỏ hàng của bạn đang trống.</p>
  <?php else: ?>
    <form method="post">
      <div class="form-group">
        <label>Phương thức thanh toán:</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_method" value="Tiền mặt" required>
          <label class="form-check-label">💵 Tiền mặt</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_method" value="Chuyển khoản" required>
          <label class="form-check-label">🏦 Chuyển khoản</label>
        </div>
      </div>
      <button name="checkout" class="btn btn-success">Xác nhận thanh toán</button>
    </form>
  <?php endif; ?>

  <?php
  if (isset($_POST['checkout'])) {
    $method = $_POST['payment_method'];
    $ids = array_keys($_SESSION['cart']);
    $id_str = implode(",", $ids);
    $rs = $conn->query("SELECT * FROM products WHERE id IN ($id_str)");

    $order = "";
    $total = 0;

    while ($row = $rs->fetch_assoc()) {
      $qty = $_SESSION['cart'][$row['id']];
      $line = "{$row['name']} x $qty";
      $order .= $line . "\n";
      $total += $qty * $row['price'];
    }

    $user = $_SESSION['user'];
    $status = "Đã chuyển cho tài xế";
    $now = date('Y-m-d H:i:s');

    // Lưu vào bảng orders
    $stmt = $conn->prepare("INSERT INTO orders(username, items, total, method, status, created_at) VALUES(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $user, $order, $total, $method, $status, $now);
    $stmt->execute();

    echo "<div class='alert alert-success mt-4'>
      ✅ Đã thanh toán bằng <strong>$method</strong><br>
      🧾 Tổng cộng: <strong>$total.000đ</strong><br>
      📦 Trạng thái: <strong>$status</strong>
    </div>";

    unset($_SESSION['cart']);
  }
  ?>
</div>
<?php include 'footer.php'; ?>
