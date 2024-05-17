document.addEventListener('DOMContentLoaded', () => {
    const search = document.querySelector('#searchbar');

    if (search) {
        const input = document.querySelector('#searchbar input[type="text"]');
        const ul = document.getElementById('itemList');

        input.addEventListener('input', async () => {
            const query = input.value.trim();

            if (query === '') {
                ul.style.display = 'none';
                ul.innerHTML = '';
            } else {
                try {
                    const response = await fetch(`api_search.php?query=${encodeURIComponent(query)}`);
                    const items = await response.json();

                    ul.innerHTML = '';
                    if (items.length > 0) {
                        items.forEach(item => {
                            const li = document.createElement('li');
                            const a = document.createElement('a');
                            a.href = `item_page.php?id=${item.id}`;
                            a.textContent = item.name;

                            li.appendChild(a);
                            ul.appendChild(li);
                        });

                        ul.style.display = 'block';
                    } else {
                        ul.style.display = 'none';
                    }
                } catch (error) {
                    console.error('Error fetching search results:', error);
                    ul.style.display = 'none';
                }
            }
        });

        search.addEventListener('submit', event => {
            event.preventDefault();
            window.location.href = `search.php?query=${encodeURIComponent(input.value)}`;
        });
    }
});
