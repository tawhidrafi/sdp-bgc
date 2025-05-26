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
  <link rel="stylesheet" href="./assets/css/courses.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="courses-section my-courses">
      <div class="courses-container">
        <div class="courses-header">
          <h6 class="courses-subtitle">My Library</h6>
          <h1 class="courses-title">Enrolled Course</h1>
        </div>

        <div class="courses-grid">
          <div class="course-item">
            <a href="./../courses/detail.html">
              <img
                src="./assets/img/courses-1.jpg"
                alt="React for Beginners"
                class="course-image" />
              <div class="course-content">
                <h5 class="course-title">React for Beginners</h5>
                <div class="course-footer">
                  <span class="course-author">John Smith</span>
                  <span class="course-progress">Progress: 45%</span>
                </div>
              </div>
            </a>
          </div>

          <div class="course-item">
            <a href="./../courses/detail.html">
              <img
                src="./assets/img/courses-2.jpg"
                alt="Advanced CSS Techniques"
                class="course-image" />
              <div class="course-content">
                <h5 class="course-title">Advanced CSS Techniques</h5>
                <div class="course-footer">
                  <span class="course-author">Emily Clark</span>
                  <span class="course-progress">Progress: 80%</span>
                </div>
              </div>
            </a>
          </div>

          <div class="course-item">
            <a href="./../courses/detail.html">
              <img
                src="./assets/img/courses-3.jpg"
                alt="Python for Data Science"
                class="course-image" />
              <div class="course-content">
                <h5 class="course-title">Python for Data Science</h5>
                <div class="course-footer">
                  <span class="course-author">Michael Lee</span>
                  <span class="course-progress">Progress: 60%</span>
                </div>
              </div>
            </a>
          </div>

          <div class="course-item">
            <a href="./../courses/detail.html">
              <img
                src="./assets/img/courses-4.jpg"
                alt="UI/UX Fundamentals"
                class="course-image" />
              <div class="course-content">
                <h5 class="course-title">UI/UX Fundamentals</h5>
                <div class="course-footer">
                  <span class="course-author">Anna Brown</span>
                  <span class="course-progress">Progress: 20%</span>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>