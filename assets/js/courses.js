// courses.js

document.addEventListener("DOMContentLoaded", function () {
  const courseList = document.getElementById("courseList");
  const searchInput = document.getElementById("search");
  const categoryFilter = document.getElementById("category-filter");

  // Sample course data (to be replaced with real data or API calls)
  const courses = [
    {
      title: "JavaScript Basics",
      description: "Learn JavaScript from scratch.",
      category: "javascript",
      price: "$19.99",
    },
    {
      title: "Advanced Python",
      description: "Master Python for data science.",
      category: "python",
      price: "$29.99",
    },
    {
      title: "HTML & CSS for Beginners",
      description: "Build websites with HTML & CSS.",
      category: "html-css",
      price: "$9.99",
    },
    {
      title: "React Fundamentals",
      description: "Learn React for building web applications.",
      category: "react",
      price: "$25.99",
    },
    {
      title: "JavaScript Advanced Concepts",
      description: "Dive deeper into advanced JS topics.",
      category: "javascript",
      price: "$39.99",
    },
    {
      title: "Python for Machine Learning",
      description: "Use Python for building machine learning models.",
      category: "python",
      price: "$49.99",
    },
  ];

  // Function to display courses
  function displayCourses(filteredCourses) {
    courseList.innerHTML = "";
    filteredCourses.forEach((course) => {
      const courseCard = document.createElement("div");
      courseCard.classList.add("course-card");

      courseCard.innerHTML = `
        <h3>${course.title}</h3>
        <p>${course.description}</p>
        <p class="price">${course.price}</p>
        <button>View More</button>
      `;

      courseList.appendChild(courseCard);
    });
  }

  // Filter courses by search and category
  function filterCourses() {
    const searchValue = searchInput.value.toLowerCase();
    const categoryValue = categoryFilter.value;

    const filteredCourses = courses.filter((course) => {
      const matchesSearch =
        course.title.toLowerCase().includes(searchValue) ||
        course.description.toLowerCase().includes(searchValue);
      const matchesCategory = categoryValue
        ? course.category === categoryValue
        : true;
      return matchesSearch && matchesCategory;
    });

    displayCourses(filteredCourses);
  }

  // Event listeners
  searchInput.addEventListener("input", filterCourses);
  categoryFilter.addEventListener("change", filterCourses);

  // Initial display of all courses
  displayCourses(courses);
});
