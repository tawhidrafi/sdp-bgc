<?php
echo '
    <header>
      <!-- Primary Navbar (User) -->
      <div class="navbar user-navbar container">
        <div class="navbar-left logo">
          <h1><i class="fa fa-book-reader"></i> EduMarketHub</h1>
        </div>
        <nav class="navbar-right nav-links">
          <a href="./../index.php">Home</a>
          <a href="./../about.php">About</a>
          <a href="./../courses/index.html">Courses</a>
          <a href="./../contact.php">Contact</a>
        </nav>
      </div>

      <!-- Admin Navbar -->
      <div class="navbar admin-navbar container">
        <div class="navbar-left logo admin-welcome">
          <h1>Welcome, Admin</h1>
        </div>
        <nav class="navbar-center nav-links">
          <a href="./index.php">Dashboard</a>
          <a href="./all-courses.php">All Courses</a>
          <a href="./all-users.php">All Users</a>
          <a href="./payments.php">Payments</a>
        </nav>
        <div class="navbar-right">
          <a href="./logout.php" class="join-btn logout-btn">Log Out</a>
        </div>
      </div>
    </header>
';
