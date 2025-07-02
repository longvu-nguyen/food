<?php include 'header.php'; ?>
<div class="container mt-5">
  <h2>Đăng nhập</h2>
  <form method="post">
    <input name="username" class="form-control mb-2" placeholder="Tên người dùng" required>
    <input name="password" type="password" class="form-control mb-2" placeholder="Mật khẩu" required>
    <button name="submit" class="btn btn-primary">Đăng nhập</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
  $u = $_POST['username'];
  $p = $_POST['password'];
  $rs = $conn->query("SELECT * FROM users WHERE username='$u'");
  if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc();
    if (password_verify($p, $row['password'])) {
      $_SESSION['user'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      header("Location: index.php");
      exit;
    }
  }
  echo "<script>alert('Sai tài khoản hoặc mật khẩu!');</script>";
}
include 'footer.php';
?>
