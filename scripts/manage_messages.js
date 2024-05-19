document.addEventListener('DOMContentLoaded', function() {
    const msgContainer = document.querySelector('.msg-container');
    msgContainer.scrollTop = msgContainer.scrollHeight;
})

function showCounterOfferForm(itemId) {
    let element = document.getElementById('counter-offer-' + itemId);
    if (element.style.display === 'block') {
        element.style.display = 'none';
    } else {
        element.style.display = 'block';
    }
}
 // Track the last message ID

function fetchMessages() {
    fetch(`/fetch_new_messages.php?user=${encodeURIComponent(otherUser)}&item=${encodeURIComponent(itemId)}&last_message_id=${lastMessageId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.length > 0) {
                updateMessages(data);
                lastMessageId = data[data.length - 1].id; // Update the last message ID
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateMessages(newMessages) {
    const messagesContainer = document.querySelector('.msg-container');

    newMessages.forEach(message => {
        const messageElement = document.createElement('p');
        messageElement.id = `message-${message.id}`;
        messageElement.className = message.sender === username ? 'user' : 'other_user';

        const date = new Date(message.timestamp * 1000);
        const dateFormatted = date.toLocaleString('en-GB', { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric' });

        let messageContent = '';

        if (message.price === null) {
            // Regular message
            messageContent = `
                <strong>${message.sender}:</strong>
                ${message.message_text}
            `;
        } else {
            // Proposal or offer
            if (message.offer_accepted && transactionStatus !== 'sold') {
                // Offer accepted
                if (username !== seller) {
                    // Buyer's view
                    messageContent = `<a href='checkout.php?price=${message.price}&item_id=${itemId}&user=${otherUser}' class='accept-offer'>Proceed to checkout</a>`;
                } else {
                    // Seller's view
                    messageContent = `You accepted the offer of ${message.price} €.`;
                }
            } else if (transactionStatus === 'sold') {
                // Item sold
                messageContent = `Item Sold!`;
            } else {
                // Proposal or offer
                if (message.sender === username) {
                    // Buyer's proposal
                    messageContent = `You sent a proposal for ${message.price} €`;
                } else {
                    // Seller's or Buyer's proposal
                    messageContent = `${username === seller ? 'Buyer' : 'Seller'}'s proposal: ${message.price} €<br>`;
                    if (!message.offer_accepted && username !== seller) {
                        // Show "Accept Offer" button for the buyer
                        messageContent += `
                            <a href='api_accept_offer.php?price=${message.price}&item_id=${itemId}&message_id=${message.id}&user=${otherUser}' class='accept-offer'>Accept Offer</a>
                        `;
                    } else if (username === seller && transactionStatus !== 'sold') {
                        // Show "Accept Offer" button for the seller
                        messageContent += `
                            <a href='api_accept_offer.php?price=${message.price}&item_id=${itemId}&message_id=${message.id}&user=${otherUser}' class='accept-offer'>Accept Offer</a>
                        `;
                    }
                }
            }
        }

        messageElement.innerHTML = `
            ${messageContent}
            <br><small>Sent on ${dateFormatted}</small>
        `;

        
        messagesContainer.appendChild(messageElement);
        
    });

    // Scroll to the bottom of the message container
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}



// Fetch new messages every 5 seconds
setInterval(fetchMessages, 5000);



