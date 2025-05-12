// home.js - Home page specific scripts

document.addEventListener("DOMContentLoaded", function () {
  console.log("EduMarketHub Home Page Loaded");

  const animatedSections = document.querySelectorAll(".animate");

  const revealOnScroll = () => {
    const windowHeight = window.innerHeight;

    animatedSections.forEach((section) => {
      const sectionTop = section.getBoundingClientRect().top;

      if (sectionTop < windowHeight - 100) {
        section.classList.add("show");
      }
    });
  };

  window.addEventListener("scroll", revealOnScroll);
  revealOnScroll(); // Trigger once on load
});
