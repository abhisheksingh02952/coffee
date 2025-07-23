<?php
include 'auth.php';
authorize('employee'); 

$conn = mysqli_connect("localhost", "root", "", "test");

if (isset($_GET['shop_id'])) {
    $_SESSION['shop_id'] = $_GET['shop_id'];
}
$shop_id = $_SESSION['shop_id'] ?? 0;

$result = mysqli_query($conn, " SELECT p.id AS product_id, p.name, COALESCE(s.quantity, 0) AS quantity FROM products p LEFT JOIN stock s ON s.product_id = p.id AND s.shop_id = $shop_id ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "head.php"; ?>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Main Content Area -->
    <main class="col-md-10 py-4">
        <form method="POST" id="geoForm" enctype="multipart/form-data" action="insert_update_stock.php">
            <div id="data" class="container">
                <h1>Update Stock Details</h1>
                <hr>

                <input type="hidden" name="shop_id" value="<?= htmlspecialchars($shop_id) ?>">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($row['name']) ?>
                            <input type="hidden" name="product_ids[]" value="<?= $row['product_id'] ?>">
                        </td>
                        <td>
                            <input type="number" name="quantities[]" value="<?= $row['quantity'] ?>" min="0" class="form-control">
                        </td>
                    </tr>
                    <?php } ?>

                    </tbody>
                </table>

                <div class="clearfix mt-3">
                    <button type="button" onclick="location.href='shop_stock_update.php'" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </main>
  </div>
</div>

<!-- JS includes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</body>
</html>
