function sendMessage() {
    const messageText = document.getElementById('messageText').value;
    const formData = new FormData();
    formData.append('receiver', otherUser);
    formData.append('item_id', itemId);
    formData.append('message_text', messageText);

    fetch('apis/api_send_message_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Message sent successfully');
        // Assuming you want to update the messages after sending
        fetchMessages(); // You may need to adjust this based on your application flow
    })
    .catch(error => console.error('Error:', error));
}

function sendProposal() {
    const proposalPrice = document.getElementById('proposalPrice').value;
    const formData = new FormData();
    formData.append('receiver', otherUser);
    formData.append('item_id', itemId);
    formData.append('new_price', proposalPrice);

    fetch('apis/api_send_message_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Proposal sent successfully');
        // Assuming you want to update the messages after sending
        fetchMessages(); // You may need to adjust this based on your application flow
    })
    .catch(error => console.error('Error:', error));
}

function sendMessageAjax(receiver, itemId, messageText) {
    fetch('apis/api_send_message_ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'receiver': receiver,
            'item_id': itemId,
            'message_text': messageText
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Message sent successfully, fetch and update messages
            fetchMessages();
        } else {
            // Handle failure
            console.error('Message sending failed.');
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
    });
}

function sendProposalAjax(receiver, itemId, price) {
    fetch('apis/api_send_message_ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'receiver': receiver,
            'item_id': itemId,
            'new_price': price
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Proposal sent successfully, fetch and update messages
            fetchMessages();
        } else {
            // Handle failure
            console.error('Proposal sending failed.');
        }
    })
    .catch(error => {
        console.error('Error sending proposal:', error);
    });
}
// Function to handle accepting an offer asynchronously
function acceptOffer(messageId, price) {
    fetch(`apis/api_accept_offer.php?price=${encodeURIComponent(price)}&item_id=${encodeURIComponent(itemId)}&message_id=${encodeURIComponent(messageId)}&user=${encodeURIComponent(otherUser)}`)
        .then(response => response.json())
        .then(data => {
            console.log('Offer accepted successfully');
            // Redirect the user if necessary
            
        })
        .catch(error => console.error('Error:', error));
}

// Function to handle sending a counter offer asynchronously
function sendCounterOffer(itemId, otherUser) {
    const form = document.getElementById(`counter-offer-form-${itemId}`);
    const formData = new FormData(form);
    formData.append('receiver', otherUser);
    formData.append('item_id', itemId);
    fetch('apis/api_send_message_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Counter offer sent successfully');
        // Assuming you want to update the messages after sending
        fetchMessages(); // You may need to adjust this based on your application flow
    })
    .catch(error => console.error('Error:', error));
}