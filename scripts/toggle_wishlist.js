function attachWishlistListeners() {
    // Select all elements whose id starts with "wish"
    const wishItems = document.querySelectorAll('[id^="wish"]');
    const wishbutton = document.querySelectorAll('[id^="btnwish"]');

    // Add event listener to each element
    wishItems.forEach(item => {
        item.addEventListener('click', async function() {
            const itemId = item.id.replace('wish', '');
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('type', '0');
            fetch('action_wishlist.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                item.className = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    wishbutton.forEach(item => {
        item.addEventListener('click', async function() {
            const itemId = item.id.replace('btnwish', '');
            const formData = new FormData();
            formData.append('item_id', itemId);
            fetch('action_wishlist.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                item.style.backgroundColor = data.bgcolor;
                item.style.color = data.color;
                item.innerHTML = data.text;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
}

// Call the function to attach event listeners initially
attachWishlistListeners();