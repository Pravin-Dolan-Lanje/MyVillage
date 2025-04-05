document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    const titleElement = document.getElementById('image-title');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        slides[index].classList.add('active');
        titleElement.textContent = slides[index].getAttribute('data-title');
    }

    function showNextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function showPrevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    nextBtn.addEventListener('click', showNextSlide);
    prevBtn.addEventListener('click', showPrevSlide);
    setInterval(showNextSlide, 4000);
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.dropdown-submenu .dropdown-toggle').forEach(function(element) {
        element.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            let nextMenu = this.nextElementSibling;
            if (nextMenu) {
                nextMenu.classList.toggle("show");
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function(event) {
        if (!event.target.closest(".navbar-nav")) {
            document.querySelectorAll(".dropdown-menu.show").forEach(function(menu) {
                menu.classList.remove("show");
            });
        }
    });
});



document.addEventListener("DOMContentLoaded", function () {
    fetch("event/fetch_events.php")  // Update the path if necessary
        .then(response => response.json())
        .then(data => {
            let sliderContainer = document.getElementById("event-slider");
            sliderContainer.innerHTML = "";

            if (data.length === 0) {
                // If no events, show "No events available" message
                sliderContainer.innerHTML = `
                    <div class="no-events">
                        <p>No events available</p>
                    </div>`;
            } else {
                data.forEach(event => {
                    sliderContainer.innerHTML += `
                        <div class="swiper-slide">
                            <img src="${event.image_url}" alt="Event Image">
                            <div class="subtitle">${event.subtitle}</div>
                        </div>`;
                });

                // Initialize Swiper.js only if there are events
                new Swiper(".swiper-container", {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    }
                });
            }
        })
        .catch(error => console.error("Error fetching events:", error));
});
(function() {
    'use strict';
    
    // Function to show alert
    const showAlert = () => {
        alert("⚠️ Developer Tools is not allowed!");
    };

    // Method 1: Detect F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
    document.addEventListener('keydown', (e) => {
        if (
            e.key === 'F12' ||
            (e.ctrlKey && e.shiftKey && e.key === 'I') ||
            (e.ctrlKey && e.shiftKey && e.key === 'J') ||
            (e.ctrlKey && e.key === 'U')
        ) {
            e.preventDefault(); // Block the default action (opening DevTools)
            showAlert();
        }
    });

    // Method 2: Detect DevTools via window size (Chrome, Firefox, Edge)
    const threshold = 160; // Adjust based on testing
    let devToolsOpened = false;

    setInterval(() => {
        const widthDiff = window.outerWidth - window.innerWidth > threshold;
        const heightDiff = window.outerHeight - window.innerHeight > threshold;
        
        if ((widthDiff || heightDiff) && !devToolsOpened) {
            devToolsOpened = true;
            showAlert();
        }
    }, 1000);

    // Optional: Prevent right-click inspect
    document.addEventListener('contextmenu', (e) => {
        e.preventDefault();
        showAlert();
    });
})();