// Select all elements whose id starts with "wish"
const wishItems = document.querySelectorAll('[id^="wish"]');

// Add event listener to each element
wishItems.forEach(item => {
    item.addEventListener('click', function() {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", 'action_wishlist.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // this.responseText will contain the class name returned by the PHP script
                item.className = this.responseText;
            }
        }
        // Extract the id from the item's id (which should be in the format "wish<id>")
        const itemId = item.id.replace('wish', '');
        xhr.send("item_id=" + itemId);
    });
});