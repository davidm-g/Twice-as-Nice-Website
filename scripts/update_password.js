window.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector('#password_update_form');
    const currentPasswordInput = document.querySelector('#current_password');
    const newPasswordInput = document.querySelector('#new_password');
    const confirmPasswordInput = document.querySelector('#confirm_password');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (newPasswordInput.value !== confirmPasswordInput.value) {
            alert('New password and confirm password do not match.');
            return;
        }
        if(newPasswordInput.value.length < 8) {
            alert('New password must be at least 8 characters.');
            return;
        }
        const response = await fetch('verify_password.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'password='+encodeURIComponent(currentPasswordInput.value),
        });

        const isPasswordCorrect = await response.json();

        if (!isPasswordCorrect) {
            alert('Current password is incorrect.');
            
        }
        else{
            form.update_password.value = '1';
            form.submit();
        }
    });
});