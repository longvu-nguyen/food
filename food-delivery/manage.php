<?php include 'header.php'; ?>
<?php
if ($_SESSION['role'] != 'admin') {
  echo "<script>alert('Bạn không có quyền truy cập'); location='index.php';</script>";
  exit;
}
?>

<div class="container mt-4">
  <h2>Quản lý sản phẩm</h2>
  <form method="post" enctype="multipart/form-data" class="mb-3">
    <input name="name" class="form-control mb-2" placeholder="Tên món ăn" required>
    <input name="price" type="number" class="form-control mb-2" placeholder="Giá" required>
    <input type="file" name="image" class="form-control mb-2" required>
    <button name="add" class="btn btn-primary">Thêm món</button>
  </form>

  <?php
  // Xử lý thêm sản phẩm
  if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $imageName = basename($_FILES['image']['name']);
    $targetDir = "images/" . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetDir)) {
      $conn->query("INSERT INTO products(name, price, image) VALUES('$name', '$price', '$targetDir')");
      echo "<script>alert('Đã thêm món mới'); location='manage.php';</script>";
    } else {
      echo "<div class='alert alert-danger'>Lỗi tải ảnh lên!</div>";
    }
  }

  // Danh sách sản phẩm
  $rs = $conn->query("SELECT * FROM products");
  while ($row = $rs->fetch_assoc()) {
    echo "<div class='d-flex justify-content-between align-items-center border p-2 mb-2'>
      <div><img src='{$row['image']}' width='60' class='mr-2'> {$row['name']} - {$row['price']}đ</div>
      <a href='?del={$row['id']}' class='btn btn-sm btn-danger'>Xoá</a>
    </div>";
  }

  // Xử lý xoá
  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $res = $conn->query("SELECT image FROM products WHERE id=$id");
    if ($res && $res->num_rows > 0) {
      $imgPath = $res->fetch_assoc()['image'];
      if (file_exists($imgPath)) unlink($imgPath);
    }
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: manage.php");
    exit;
  }
  ?>
</div>
<?php include 'footer.php'; ?>