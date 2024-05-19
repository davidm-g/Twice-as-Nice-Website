
document.getElementById('category').addEventListener('change', function() {
    const categoryId = this.value;
    fetch('/apis/api_subcategories.php?category_id=' + categoryId)
        .then(response => response.json())
        .then(data => {
            const subcategorySelect = document.getElementById('subcategory');
            subcategorySelect.innerHTML = '';
            data.forEach(function(subcategory) {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.text = subcategory.name;
                subcategorySelect.appendChild(option);
            });
        });
});
