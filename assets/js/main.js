document.addEventListener("DOMContentLoaded", function () {
    // Menu Toggle
    const menuToggle = document.querySelector(".menu-toggle");
    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            document.body.classList.toggle("menu-open");
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
});
