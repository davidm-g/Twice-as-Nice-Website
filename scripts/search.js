const search = document.querySelector('#searchbar')

if (search) {
    const input = document.querySelector('#searchbar input[type="text"]');
    const ul = document.getElementById('itemList');

    input.addEventListener('input', async () => {
        if (input.value.trim() === '') {
            ul.style.display = 'none';
            ul.innerHTML = '';
        } else {
            const response = await fetch('api_search.php?query=' + encodeURIComponent(input.value));
            const items = await response.json();

            ul.innerHTML = '';
            if (items.length > 0) { // Check if items array is not empty
                for (const item of items) {
                    const li = document.createElement('li');
    
                    const a = document.createElement('a');
                    a.href = 'item_page.php?id=' + item.id;
                    a.textContent = item.name;
    
                    li.appendChild(a);
                    ul.appendChild(li);
                }
    
                ul.style.display = 'block';
            } else {
                ul.style.display = 'none';
            }
        }
    });

    search.addEventListener('submit', (event) => {
        const formData = new FormData();
        formData.append('search', input.value);
        fetch('api_filter_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(!document.getElementById('choiceremsearch')) {
                let li = document.createElement('li');
                li.setAttribute('id', 'choiceremsearch');
            }
            document.getElementById('choiceremsearch').innerHTML = data;
            console.log(data);
            appfilters.appendChild(document.getElementById('choiceremsearch'));
            resetf.style.display = 'flex';
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
};