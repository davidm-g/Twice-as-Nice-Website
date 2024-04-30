function showCounterOfferForm(itemId) {
    // Select the div for the counter offer form
    const counterOfferDiv = document.getElementById('counter-offer-' + itemId);
    // Display the div
    counterOfferDiv.style.display = counterOfferDiv.style.display === 'block' ? 'none' : 'block';
}

function sendCounterOffer(itemId,receiver) {
    const form = document.getElementById('counter-offer-form-' + itemId);
    const newPrice = form.new_price.value;
    if (!newPrice) {
        alert('Please enter a new price.');
        return;
    }
    const formData = new FormData(form);
    formData.append('receiver', receiver);
    formData.append('item_id', itemId);
    

    fetch('send_message_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Hide the counter offer form
            document.getElementById('counter-offer-' + itemId).style.display = 'none';
            // Reload the page to show the new message
            location.reload();
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}