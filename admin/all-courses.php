<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - All Courses</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/courses.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/admin-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="admin-courses-section">
      <h2 class="section-title">All Courses</h2>

      <div class="table-wrapper">
        <table class="course-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category</th>
              <th>Type</th>
              <th>Name</th>
              <th>Creator</th>
              <th>Date</th>
              <th>Price ($)</th>
              <th>Enrolled</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT c.*, u.name AS creator_name, 
                           (SELECT COUNT(*) FROM payments WHERE course_id = c.id AND status = 'approved') AS enrolled 
                    FROM courses c 
                    JOIN users u ON c.user_id = u.id 
                    ORDER BY c.created_at DESC";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>#C{$row['id']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['creator_name']}</td>
                        <td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>
                        <td>{$row['price']}</td>
                        <td>{$row['enrolled']}</td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='10'>No courses found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>