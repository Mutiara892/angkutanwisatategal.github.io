<?php
require 'config.php';
?>
<!--awal navbar-->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark py-3 fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="img/4.png" width="100px" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php#Rute">Mau Kemana?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$page == 'rute' ? 'active' : '';?>" href="rute.php">Rute</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$page == 'jadwal' ? 'active' : '';?>" href="jadwal.php">Jadwal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard/order/order.php">Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#kontak">Kontak</a>
        </li>
        <?php if (isset($_SESSION['login_admin'])): ?>
          <li class="nav-item"><a class="nav-link" href="dashboard/admin">Admin</a></li>
        <?php endif; ?>
        <?php if (!isset($_SESSION['login'])): ?>
        <li><a href="dashboard/pages/login.php" class="btn btn-light">Login</a></li>
        <?php else: ?>
        <li class="me-2 mb-lg-0 mb-2"><a href="dashboard/pages/login.php" class="btn btn-light">Dashboard</a></li>
        <li><a href="dashboard/order/logout.php" class="btn btn-light">Logout</a></li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav>
<!--akhir navbar-->
