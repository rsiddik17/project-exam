export function header() {
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  const currentPath = window.location.pathname;

  navLinks.forEach((link) => {
    const linkPath = link.getAttribute("href");
    if (currentPath.includes(linkPath)) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
}
