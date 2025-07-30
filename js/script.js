
// // Banner page to home page transition
// document.getElementById('explore-btn').addEventListener('click', function () {
//     document.querySelector('.banner-page').style.display = 'none';
//     document.querySelector('.home-page').style.display = 'block';

//     // Make about-us section visible initially
//     document.querySelector('#about-us').classList.add('visible');

//     // Scroll to about-us section
//     document.querySelector("nav").scrollIntoView();
// });

document.getElementById('explore-btn').addEventListener('click', function () {
    // ✅ Redirect user to the dedicated About Us page
    window.location.href = 'about-us.php';
    document.querySelector('.home-page').style.display='initial';
});
// Navigation handling
document.querySelectorAll('nav a').forEach(function (navLink) {
    navLink.addEventListener('click', function (event) {
        event.preventDefault();

        // Hide all sections
        document.querySelectorAll('section').forEach(function (section) {
            section.classList.remove('visible');
        });

        // Show the target section
        const targetId = this.getAttribute('href').substring(1);
        document.getElementById(targetId).classList.add('visible');

        // Scroll to the section
        document.getElementById(targetId).scrollIntoView();
    });
});



// Product category filter
const categoryBtns = document.querySelectorAll('.category-btn');

categoryBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
        // Remove active class from all buttons
        categoryBtns.forEach(function (b) {
            b.classList.remove('active');
        });

        // Add active class to clicked button
        this.classList.add('active');

        // Filter products logic would go here
        // For demonstration purposes only
        console.log('Filter by: ' + this.textContent);
    });
});

// Intersection Observer for section animations
// const sections = document.querySelectorAll('section');

// const sectionObserver = new IntersectionObserver((entries) => {
//     entries.forEach(entry => {
//         if (entry.isIntersecting) {
//             entry.target.classList.add('visible');
//         }
//     });
// }, {
//     threshold: 0.1
// });

// sections.forEach(section => {
//     sectionObserver.observe(section);
// });






