const filtersbrd = document.querySelectorAll('[id^="choicebrd"]');
const filterssz = document.querySelectorAll('[id^="choicesz"]');
const filterscond = document.querySelectorAll('[id^="choicecond"]');

const appfilters = document.getElementById('applied_filters');

const pricefilter = document.getElementById('price_filter');

const resetf = document.getElementById('reset_filters');

// Filters for brand
filtersbrd.forEach(filterbrd => {
    filterbrd.addEventListener('click', async function() {
        const filterId = filterbrd.id.replace('choicebrd', '');
        let id = 'choicerembrd' + filterId;
        if (!document.getElementById(id)) {
            const formData = new FormData();
            formData.append('brand', filterId);
            fetch('api_filter_items.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                let li = document.createElement('li');
                li.setAttribute('id', id);
                li.innerHTML = data;
                appfilters.appendChild(li);
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
        } else {
            console.log('Element with id ' + 'choicerembrd' + filterId + ' already exists');
        }
    });
});

// Filters for size
filterssz.forEach(filtersz => {
    filtersz.addEventListener('click', async function() {
        const filterId = filtersz.id.replace('choicesz', '');
        let id = 'choiceremsz' + filterId;
        if (!document.getElementById(id)) {
            const formData = new FormData();
            formData.append('size', filterId);
            fetch('api_filter_items.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                    let li = document.createElement('li');
                    li.setAttribute('id', id);
                    li.innerHTML = data;
                    appfilters.appendChild(li);
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
        } else {
            console.log('Element with id ' + 'choiceremsz' + filterId + ' already exists');
        }
    });
});

// Filters for condition
filterscond.forEach(filtercond => {
    filtercond.addEventListener('click', async function() {
        const filterId = filtercond.id.replace('choicecond', '');
        let id = 'choiceremcond' + filterId;
        if (!document.getElementById(id)) {
            const formData = new FormData();
            formData.append('condition', filterId);
            fetch('api_filter_items.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                    let li = document.createElement('li');
                    li.setAttribute('id', id);
                    li.innerHTML = data;
                    appfilters.appendChild(li);
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
        } else {
            console.log('Element with id ' + 'choiceremcond' + filterId + ' already exists');
        }
    });
});

// Filter for price
pricefilter.addEventListener('submit', function(event) {
    event.preventDefault(); // prevent the form from submitting and refreshing the page
    let min = document.getElementById('min_price').value;
    let max = document.getElementById('max_price').value;
    if (min == '' || max == '' || min >= max) {
        console.log('Invalid price range');
        document.getElementById('min_price').value = '';
        document.getElementById('max_price').value = '';
        return;
    }
    if (!document.getElementById('choiceremprice')) {
        const filterId = min + '-' + max;
        const formData = new FormData();
        formData.append('price', filterId);
        fetch('api_filter_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            let li = document.createElement('li');
            li.setAttribute('id', 'choiceremprice');
            li.innerHTML = min + ' - ' + max;
            appfilters.appendChild(li);
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
    } else {
        console.log('Price filter already exists');
    }
    document.getElementById('min_price').value = '';
    document.getElementById('max_price').value = '';
});

// Remove filters
document.addEventListener('DOMContentLoaded', (event) => {
    // Attach event listener to parent
    appfilters.addEventListener('click', function(event) {
        const num = appfilters.childElementCount;
        const filterId = event.target.id.replace('choicerem', '');
        const formData = new FormData();
        formData.append('remove', filterId);
        fetch('api_filter_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const li = document.getElementById('choicerem' + filterId);
            if (li) {
                li.remove();
            }
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
            if (num == 1) {
                resetf.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// Reset filters

resetf.addEventListener('click', async function() {
    const formData = new FormData();
    formData.append('reset', '1');
    fetch('api_filter_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        resetf.style.display = 'none';
        appfilters.innerHTML = '';
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

