function verifyPassword() {  

    const pw = document.getElementById('password').value;
    const cf = document.getElementById('confirm').value;

    if(pw.length < 8) {  
        alert('Password length must be atleast 8 characters');
        return false;  
    }

    if(pw != cf)  
    {   
        alert('Passwords did not match');
        return false;  
    }

    return true;
}

async function verifyPasswordUpdate() {
    const currentPw = document.getElementById('current_password').value;
    const newPw = document.getElementById('new_password').value;
    const confirmPw = document.getElementById('confirm_password').value;

    if(newPw.length < 8) {
        alert('New password length must be at least 8 characters');
        return false;
    }

    if(newPw != confirmPw) {
        alert('New password and confirmation do not match');
        return false;
    }

    // Make a fetch request to verify the current password
    const response = await fetch('verify_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'password=' + encodeURIComponent(currentPw)
    });

    if (!response.ok) {
        alert('An error occurred while verifying the current password');
        return false;
    }

    const isPasswordCorrect = await response.text();
    if (isPasswordCorrect !== 'true') {
        alert('Current password is incorrect');
        return false;
    }

    return true;
}


