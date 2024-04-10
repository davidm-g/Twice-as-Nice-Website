
document.getElementById('category').addEventListener('change', function() {
    var categoryId = this.value;
    fetch('/get_subcategories.php?category_id=' + categoryId)
        .then(response => response.json())
        .then(data => {
            var subcategorySelect = document.getElementById('subcategory');
            subcategorySelect.innerHTML = '';
            data.forEach(function(subcategory) {
                var option = document.createElement('option');
                option.value = subcategory.id;
                option.text = subcategory.name;
                subcategorySelect.appendChild(option);
            });
        });
});
