// dashboard.js

document.addEventListener("DOMContentLoaded", function () {
  console.log("Dashboard Loaded");

  // Highlight current sidebar item based on URL
  const navLinks = document.querySelectorAll(".sidebar nav a");
  const currentPage = window.location.pathname;

  navLinks.forEach((link) => {
    if (link.href.includes(currentPage)) {
      link.classList.add("active");
    }
  });

  // Placeholder: Dynamically update stats from local data (simulate)
  const statValues = {
    courses: 5,
    sales: 2450,
    downloads: 67,
  };

  const statCards = document.querySelectorAll(".stat-card p");
  statCards[0].textContent = statValues.courses;
  statCards[1].textContent = `₹${statValues.sales}`;
  statCards[2].textContent = statValues.downloads;
});
