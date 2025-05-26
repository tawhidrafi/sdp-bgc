<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - User</title>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/upload-course.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="upload-course-section">
      <h2 class="section-title">Edit Course / Note</h2>

      <form class="upload-form" enctype="multipart/form-data">
        <div class="form-grid">
          <!-- Left Column -->
          <div class="form-group">
            <label for="name">Course Name</label>
            <input
              type="text"
              id="name"
              name="name"
              value="Introduction to Python"
              required />
          </div>

          <div class="form-group">
            <label for="category">Category</label>
            <input
              type="text"
              id="category"
              name="category"
              value="Programming"
              required />
          </div>

          <div class="form-group">
            <label for="image">Cover Image</label>
            <input type="file" id="image" name="image" accept="image/*" />
            <small>Leave blank to keep current image</small>
          </div>

          <div class="form-group">
            <label for="type">Type</label>
            <select id="type" name="type" required>
              <option value="">Select Type</option>
              <option value="course" selected>Course</option>
              <option value="note">Note</option>
            </select>
          </div>

          <div class="form-group">
            <label for="duration">Duration (e.g. 2h 30m)</label>
            <input
              type="text"
              id="duration"
              name="duration"
              value="3h 15m"
              required />
          </div>

          <div class="form-group">
            <label for="level">Skill Level</label>
            <input
              type="text"
              id="level"
              name="level"
              value="Beginner"
              required />
          </div>

          <!-- Right Column -->
          <div class="form-group">
            <label for="lectures">No. of Lectures</label>
            <input
              type="number"
              id="lectures"
              name="lectures"
              value="10"
              required />
          </div>

          <div class="form-group">
            <label for="language">Language</label>
            <input
              type="text"
              id="language"
              name="language"
              value="English"
              required />
          </div>

          <div class="form-group">
            <label for="price">Price (in $)</label>
            <input
              type="number"
              id="price"
              name="price"
              value="25"
              min="0"
              required />
          </div>

          <div class="form-group">
            <label for="file">Replace Course File (.zip)</label>
            <input type="file" id="file" name="file" accept=".zip" />
            <small>Leave blank to keep existing file</small>
          </div>

          <!-- Full-width Details Field -->
          <div class="form-group full-width">
            <label for="details">Details</label>
            <textarea id="details" name="details" rows="4" required>
This course teaches you Python from scratch, ideal for beginners with no programming experience.
          </textarea>
          </div>
        </div>

        <button type="submit" class="btn submit-btn">Update Course</button>
      </form>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>