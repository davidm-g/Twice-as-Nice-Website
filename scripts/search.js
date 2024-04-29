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
        event.preventDefault();
        window.location.href = "search.php?query=" + input.value;
    });
};