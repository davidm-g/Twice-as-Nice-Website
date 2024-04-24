// Select all elements whose id starts with "wish"
const wishItems = document.querySelectorAll('[id^="wish"]');

// Add event listener to each element
wishItems.forEach(item => {
    item.addEventListener('click', async function() {
        // Extract the id from the item's id (which should be in the format "wish<id>")
        const itemId = item.id.replace('wish', '');
        const response = await fetch('action_wishlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `item_id=${encodeURIComponent(itemId)}`
        });

        if (response.ok) {
            // response.text() will contain the class name returned by the PHP script
            item.className = await response.text();
        }
    });
});