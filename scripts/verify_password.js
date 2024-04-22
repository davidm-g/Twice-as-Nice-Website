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