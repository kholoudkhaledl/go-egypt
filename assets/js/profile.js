/* =========================================================================
   profile.js
   JS specific to pages/profile.php
     - Asks for confirmation before deleting a single booking.
     - Asks for confirmation before clearing all bookings.
   ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.delete-booking-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm('Delete this booking? This cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    document.querySelectorAll('.clear-all-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm('Delete ALL your bookings? This cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
