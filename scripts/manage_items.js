function deleteItem(itemId) {
    const form = document.getElementById('manage-item-' + itemId);
    const formData = new FormData(form);
    formData.append('action', 'delete');

    fetch('api_manage_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Remove the item from the page
            const itemElement = document.getElementById('manage-item-' + itemId).parentNode;
            itemElement.parentNode.removeChild(itemElement);
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function showNewPrice(itemId) {
    // Select the div for changing the price
    const newPriceDiv = document.getElementById('new-price-' + itemId);
    // Display the div
    newPriceDiv.style.display = 'block';
}
function changePrice(itemId) {
    const form = document.getElementById('manage-item-' + itemId);
    const newPrice = form.new_price.value;
    if (!newPrice) {
        alert('Please enter a new price.');
        return;
    }
    const formData = new FormData(form);
    formData.append('action', 'change_price');

    fetch('api_manage_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Update the price on the page
            const articleElement = document.getElementById('manage-item-' + itemId).parentElement;
            const priceElement = articleElement.querySelector('.item-price');
            priceElement.textContent = 'Price: ' + form.new_price.value + ' €';
            // Hide the price change form
            document.getElementById('new-price-' + itemId).style.display = 'none';
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}