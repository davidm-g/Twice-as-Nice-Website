const num = document.getElementById("random_items").childElementCount;

if (num === 0) {
    const h2 = document.createElement('h2');
    h2.textContent = 'There are no products to be displayed here...'; // replace with your message
    document.getElementById("random_items").appendChild(h2);
}
