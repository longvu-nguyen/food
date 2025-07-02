<?php include 'header.php'; ?>
<div class="container mt-5">
  <h2>Đăng ký tài khoản</h2>
  <form method="post">
    <input name="username" class="form-control mb-2" placeholder="Tên người dùng" required>
    <input name="password" type="password" class="form-control mb-2" placeholder="Mật khẩu" required>
    <select name="role" class="form-control mb-2">
      <option value="user">Người dùng</option>
      <option value="admin">Admin</option>
    </select>
    <button name="submit" class="btn btn-success">Đăng ký</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
  $u = $_POST['username'];
  $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $r = $_POST['role'];
  $conn->query("INSERT INTO users(username, password, role) VALUES('$u', '$p', '$r')");
  echo "<script>alert('Đăng ký thành công!'); location='login.php';</script>";
}
include 'footer.php';
?>
