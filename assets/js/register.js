/* =========================================================================
   register.js
   JS specific to pages/register.php
     - Toggles each password field (Password / Confirm Password) between
       hidden/visible when the user clicks its eye icon.
   ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const input = this.previousElementSibling;
            const icon = this.querySelector('span');
            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            if (icon) icon.textContent = isPassword ? 'visibility_off' : 'visibility';
        });
    });
});
