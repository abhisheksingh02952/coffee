  <nav id="sidebarMenu" class="col-md-2 d-md-block bg-dark  sidebar collapse show py-4">
    <div class="position-sticky">
      <h5 class="text-center text-white mb-4 d-none d-md-block">
        Welcome <?php echo $_SESSION['name']; ?>
      </h5>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="admin_dashboard.php" class="nnav-link ">Dashboard</a></li>
        <li class="nav-item"><a href="admin_profile.php" class="nav-link">Profile</a></li>
        <li class="nav-item"><a href="admin_addemployee.php" class="nav-link">Add Employee</a></li>
        <li class="nav-item"><a href="admin_allemployee.php" class="nav-link">All Employee</a></li>
        <li class="nav-item"><a href="admin_all_products.php" class="nav-link">All Products</a></li>
        <li class="nav-item"><a href="admin_add_products.php" class="nav-link">Add Products</a></li>
        <li class="nav-item"><a href="admin_all_orders.php" class="nav-link">All Orders</a></li>
        <li class="nav-item"><a href="admin_all_shop_showing.php" class="nav-link">All Shop</a></li>
        <li class="nav-item"><a href="index.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
      </ul>
    </div>
  </nav>