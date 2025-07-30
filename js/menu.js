let navLinks = document.querySelector('nav ul');
let menuBtn = document.querySelector("#menu-btn");
menuBtn.addEventListener('click', function (e) {
    e.stopPropagation(); // Prevent click from bubbling to document
    navLinks.classList.toggle("show");
    
});

document.addEventListener("click", function (e) {
    const isClickInsideMenu = navLinks.contains(e.target);
    const isClickOnButton = menuBtn.contains(e.target);

    if (!isClickInsideMenu && !isClickOnButton) {
        navLinks.classList.remove("show");
    }
});