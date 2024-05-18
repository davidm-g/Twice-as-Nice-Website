const sort_btn = document.getElementById('sort_btn');

sort_btn.addEventListener('click', function() {
    const formData = new FormData();
    if(sort_btn.className == "fa-solid fa-sort-down") {
        sort_btn.className = "fa-solid fa-sort-up";
        const direction = '0';
        formData.append('direction', direction);
    }
    else {
        sort_btn.className = "fa-solid fa-sort-down";
        const direction = '1';
        formData.append('direction', direction);
    }
    fetch('api_sort_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
    fetch('api_updateItems.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        document.getElementById('random_items').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

const orders = document.querySelectorAll('[id^="order"]');

const reset = document.getElementById('reset_order');

orders.forEach(order => {
    order.addEventListener('click', async function() {
        const sortId = order.id.replace('order', '');
        const formData = new FormData();
        formData.append('sortOrder', sortId);
        fetch('api_sort_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            reset.style.display = 'flex';
            orders.forEach(order => {
                order.style.backgroundColor = 'transparent';
            });
            order.style.backgroundColor = '#C9ADA7';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

reset.addEventListener('click', async function() {
    const formData = new FormData();
    formData.append('sortOrder', '0');
    fetch('api_sort_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        reset.style.display = 'none';
        orders.forEach(order => {
            order.style.backgroundColor = 'transparent';
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

const parent = document.getElementById('sort_options');
const children = parent.children;

for (let i = 0; i < children.length; i++) {
    children[i].addEventListener('click', function() {
        fetch('api_updateItems.php', {
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            document.getElementById('random_items').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
}
