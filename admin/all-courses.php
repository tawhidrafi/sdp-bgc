<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Admin</title>

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
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#C101</td>
              <td>Web Dev</td>
              <td>Course</td>
              <td>HTML & CSS Basics</td>
              <td>Jane Doe</td>
              <td>2025-04-15</td>
              <td>25</td>
              <td>110</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C102</td>
              <td>Design</td>
              <td>Note</td>
              <td>UX Research Notes</td>
              <td>John Smith</td>
              <td>2025-03-12</td>
              <td>10</td>
              <td>35</td>
              <td><span class="status inactive">Inactive</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C103</td>
              <td>Marketing</td>
              <td>Course</td>
              <td>SEO Fundamentals</td>
              <td>Alice Green</td>
              <td>2025-04-02</td>
              <td>30</td>
              <td>50</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C104</td>
              <td>Programming</td>
              <td>Note</td>
              <td>Go Language Snippets</td>
              <td>Mike Lee</td>
              <td>2025-05-01</td>
              <td>12</td>
              <td>20</td>
              <td><span class="status inactive">Inactive</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C105</td>
              <td>Writing</td>
              <td>Course</td>
              <td>Content Creation Skills</td>
              <td>Emily White</td>
              <td>2025-04-18</td>
              <td>40</td>
              <td>85</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C106</td>
              <td>Web Dev</td>
              <td>Note</td>
              <td>React Shortcuts</td>
              <td>David Brown</td>
              <td>2025-03-29</td>
              <td>15</td>
              <td>43</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C107</td>
              <td>Data Science</td>
              <td>Course</td>
              <td>Intro to Pandas</td>
              <td>Linda Ray</td>
              <td>2025-02-15</td>
              <td>35</td>
              <td>60</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C108</td>
              <td>Marketing</td>
              <td>Course</td>
              <td>Instagram Ads</td>
              <td>Robert Clark</td>
              <td>2025-01-20</td>
              <td>28</td>
              <td>77</td>
              <td><span class="status inactive">Inactive</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C109</td>
              <td>UI/UX</td>
              <td>Note</td>
              <td>Figma Quick Notes</td>
              <td>Susan Moore</td>
              <td>2025-04-09</td>
              <td>5</td>
              <td>18</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
            <tr>
              <td>#C110</td>
              <td>AI & ML</td>
              <td>Course</td>
              <td>Beginner’s Guide to ML</td>
              <td>Daniel Kim</td>
              <td>2025-03-10</td>
              <td>50</td>
              <td>101</td>
              <td><span class="status active">Active</span></td>
              <td class="action-buttons">
                <button class="btn activate">Okay</button>
                <button class="btn hold">Hold</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>