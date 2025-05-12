// about.js (Optional, for smooth scrolling between sections)
document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".sidebar nav ul li a");

  links.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const target = document.querySelector(link.getAttribute("href"));
      window.scrollTo({
        top: target.offsetTop - 100, // Offset to make it a bit nicer
        behavior: "smooth",
      });
    });
  });
});
