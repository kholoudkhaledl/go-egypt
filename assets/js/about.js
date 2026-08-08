/* =========================================================================
   about.js
   JS specific to pages/about.php
     - Initializes the AOS (Animate On Scroll) library used for the
       fade/slide-in animations on this page's hero and sections.
   ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 1000,
            once: true
        });
    }
});
