<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2 class="text-center">🍱 Danh sách món ăn</h2>
  <div class="row">
    <?php
    $rs = $conn->query("SELECT * FROM products");
    while ($row = $rs->fetch_assoc()):
    ?>
      <div class="col-md-4 mt-3">
        <div class="card h-100">
          <img src="<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $row['name'] ?></h5>
            <p class="card-text text-muted"><?= $row['price'] ?>.000đ</p>
            <a href="add_to_cart.php?id=<?= $row['id'] ?>" class="btn btn-success mt-auto">🛒 Thêm vào giỏ</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
