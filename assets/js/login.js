/* =========================================================================
   login.js
   JS specific to pages/login.php
     - Toggles the password field between hidden/visible when the user
       clicks the eye icon inside the password input.
   ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passInput = document.getElementById('password');

    if (!toggleBtn || !passInput) return;

    const passIcon = toggleBtn.querySelector('span');

    toggleBtn.addEventListener('click', () => {
        const isPass = passInput.type === 'password';
        passInput.type = isPass ? 'text' : 'password';
        if (passIcon) passIcon.textContent = isPass ? 'visibility_off' : 'visibility';
    });
});
