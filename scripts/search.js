window.addEventListener('DOMContentLoaded', (event) => {
    const input = document.querySelector('#searchbar input[type="text"]');
    const ul = document.getElementById('itemList');

    input.addEventListener('input', async () => {
        if (input.value.trim() === '') {
            ul.style.display = 'none';
        } else {
            const response = await fetch('api_search.php?query=' + encodeURIComponent(input.value));
            const items = await response.json();

            ul.innerHTML = '';

            for (const item of items) {
                const li = document.createElement('li');

                const a = document.createElement('a');
                a.href = 'item_page.php?id=' + item.id;
                a.textContent = item.name;

                li.appendChild(a);
                ul.appendChild(li);
            }

            ul.style.display = 'block';
        }
    });
});