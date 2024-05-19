async function validateForm(event) {
    event.preventDefault();
    const username = document.getElementById('elevate_username').value;
    return fetch("actions/action_check_user_exists.php?username=" + username)
        .then(response => response.text())
        .then(text => {
            if (text == 'false') {
                alert('User does not exist.');
                return false;
            } else {
                event.target.submit();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            return false;
        });
}