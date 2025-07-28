    <nav id="sidebarMenu" class="col-md-2 d-md-block bg-dark  sidebar collapse show py-4">
      <div class="position-sticky">
        <h5 class="text-center text-white mb-4 d-none d-md-block">
          Welcome <?php echo $_SESSION['name']; ?>
        </h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
          <li class="nav-item"><a href="addnewdealer.php" class="nav-link">Add SHOP</a></li>
          <li class="nav-item"><a href="all_shop.php" class="nav-link">All SHOP</a></li>
          <li class="nav-item"><a href="place_order.php" class="nav-link">Place Order</a></li>
          <li class="nav-item"><a href="all_orders.php" class="nav-link">All Orders</a></li>
          <li class="nav-item"><a href="order_payment.php" class="nav-link">Order Payment</a></li>
          <li class="nav-item"><a href="shop_stock.php" class="nav-link">Check Shop Stock</a></li>
          <li class="nav-item"><a href="shop_stock_update.php" class="nav-link">Update Shop Stock</a></li>
          <li class="nav-item"><a href="index.php" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </div>
    </nav>
