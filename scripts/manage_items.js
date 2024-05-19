document.addEventListener('DOMContentLoaded', function() {
    const sellMoreBtn = document.getElementById('sellmorebtn');
    
    sellMoreBtn.addEventListener('click', function() {
        window.location.href = 'sell.php';
    });
});

function deleteItem(itemId) {
    // Select the container of the item
    const itemContainer = document.getElementById('item-container-' + itemId);
    if (!itemContainer) {
        console.error('Error: Item container not found');
        return;
    }

    // Create a FormData object to send the delete request
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('item_id', itemId);

    fetch('api_manage_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Remove the item container from the page
            itemContainer.parentNode.removeChild(itemContainer);
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
    if(newPriceDiv.style.display === 'block') {
        newPriceDiv.style.display = 'none';
    }
    else if(newPriceDiv.style.display === 'none') {
        newPriceDiv.style.display = 'block';
    }
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
    document.getElementById('new-price-' + itemId).style.display = 'none';

    fetch('api_manage_items.php', {
        method: 'POST',
        body: formData
    })

    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Update the price on the page
            const priceElement = document.getElementById('item-price-' + itemId);
            priceElement.textContent =newPrice + ' €';
           
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