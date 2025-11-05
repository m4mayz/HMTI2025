document.addEventListener("DOMContentLoaded", function () {
    // Menu Toggle
    const menuToggle = document.querySelector(".menu-toggle");
    const mainNavigation = document.querySelector(".main-navigation");

    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            const isOpen = document.body.classList.toggle("menu-open");
            menuToggle.setAttribute("aria-expanded", isOpen);
        });
    }

    // Close menu when clicking navigation links
    if (mainNavigation) {
        const navLinks = mainNavigation.querySelectorAll("a");
        navLinks.forEach((link) => {
            link.addEventListener("click", function () {
                document.body.classList.remove("menu-open");
                if (menuToggle) {
                    menuToggle.setAttribute("aria-expanded", "false");
                }
            });
        });
    }

    // Close menu when clicking outside
    if (mainNavigation) {
        mainNavigation.addEventListener("click", function (e) {
            if (e.target === mainNavigation) {
                document.body.classList.remove("menu-open");
                if (menuToggle) {
                    menuToggle.setAttribute("aria-expanded", "false");
                }
            }
        });
    }

    // Highlight Animation on Scroll
    const highlightTitles = document.querySelectorAll(".title-with-highlight");

    if (highlightTitles.length > 0) {
        const observerOptions = {
            threshold: 0.3, // Trigger when 30% of element is visible
            rootMargin: "0px 0px -50px 0px",
        };

        const highlightObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-highlight");
                    // Optional: stop observing after animation triggered once
                    // highlightObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        highlightTitles.forEach((title) => {
            highlightObserver.observe(title);
        });
    }

    // Header Hide/Show on Scroll
    const header = document.querySelector(".site-header");
    let lastScrollTop = 0;
    let scrollThreshold = 100; // Minimum scroll untuk memicu hide/show
    let ticking = false;

    function updateHeader(scrollPos) {
        if (scrollPos > lastScrollTop && scrollPos > scrollThreshold) {
            // Scrolling Down - Hide Header
            header.classList.add("header-hidden");
            header.classList.remove("header-visible");
        } else if (scrollPos < lastScrollTop) {
            // Scrolling Up - Show Header
            header.classList.remove("header-hidden");
            header.classList.add("header-visible");
        }

        // If at top, ensure header is visible
        if (scrollPos <= scrollThreshold) {
            header.classList.remove("header-hidden");
            header.classList.add("header-visible");
        }

        lastScrollTop = scrollPos;
        ticking = false;
    }

    window.addEventListener("scroll", function () {
        const scrollPos =
            window.pageYOffset || document.documentElement.scrollTop;

        if (!ticking) {
            window.requestAnimationFrame(function () {
                updateHeader(scrollPos);
            });
            ticking = true;
        }
    });

    // Dropdown Kategori Toggle
    const btnDropdownCat = document.querySelector(".btn-dropdown-cat");
    const dropdownCatWrapper = document.querySelector(".dropdown-cat-wrapper");

    if (btnDropdownCat && dropdownCatWrapper) {
        btnDropdownCat.addEventListener("click", function (e) {
            e.preventDefault();
            dropdownCatWrapper.classList.toggle("hidden");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (e) {
            if (
                !btnDropdownCat.contains(e.target) &&
                !dropdownCatWrapper.contains(e.target)
            ) {
                dropdownCatWrapper.classList.add("hidden");
            }
        });
    }
});
