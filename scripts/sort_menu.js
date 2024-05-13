document.getElementById('sort_btn').addEventListener('click', function() {
    var sortOptions = document.getElementById('sort_options');
    if(sortOptions.style.display == 'none') {
        sortOptions.style.display = 'flex';
        sortOptions.style.animation = 'slide-in 0.5s forwards';
        sortOptions.removeEventListener('animationend', hideAfterAnimation);
    }
    else {
        sortOptions.style.animation = 'slide-out 0.5s forwards';
        sortOptions.addEventListener('animationend', hideAfterAnimation);
    }
    
    function hideAfterAnimation() {
        sortOptions.style.display = 'none';
        sortOptions.removeEventListener('animationend', hideAfterAnimation);
    }
});

const orders = document.querySelectorAll('[id^="order"]');

const reset = document.getElementById('reset_order');

orders.forEach(order => {
    order.addEventListener('click', async function() {
        const sortId = order.id.replace('order', '');
        const formData = new FormData();
        if(sortId == 2) {
            formData.append('sortOrder', sortId);
            fetch('api_sort_items.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    reset.style.display = 'flex';
                    console.log("Order is name");
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
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
        if (data.status === 'success') {
            reset.style.display = 'none';
            console.log("Order is reset");
        } else {
            console.error('Error:', data.message);
        }
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
