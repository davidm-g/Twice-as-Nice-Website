const filtersbrd = document.querySelectorAll('[id^="choicebrd"]');
const filterssz = document.querySelectorAll('[id^="choicesz"]');
const filterscond = document.querySelectorAll('[id^="choicecond"]');
const filterscat = document.querySelectorAll('[id^="choicecats"]');

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
            fetch('apis/api_filter_items.php', {
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

            fetch('apis/api_updateItems.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                document.getElementById('random_items').innerHTML = data;
                attachWishlistListeners();
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
            fetch('apis/api_filter_items.php', {
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

            fetch('apis/api_updateItems.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                document.getElementById('random_items').innerHTML = data;
                attachWishlistListeners();
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
            fetch('apis/api_filter_items.php', {
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

            fetch('apis/api_updateItems.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                document.getElementById('random_items').innerHTML = data;
                attachWishlistListeners();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            console.log('Element with id ' + 'choiceremcond' + filterId + ' already exists');
        }
    });
});

// Filters for category
filterscat.forEach(filtercat => {
    filtercat.addEventListener('click', async function() {
        let id = filtercat.id.replace('choicecats', '');
        const formData = new FormData();
        formData.append('category', id);
        fetch('apis/api_filter_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (!document.getElementById('choiceremcats')) {
                let li = document.createElement('li');
                li.setAttribute('id', 'choiceremcats');
                li.innerHTML = data;
                appfilters.appendChild(li);
            }
            else {
                document.getElementById('choiceremcats').innerHTML = data;
            }
            console.log(data);
            resetf.style.display = 'flex';
        })
        .catch(error => {
            console.error('Error:', error);
        });
        
        fetch('apis/api_updateItems.php', {
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            document.getElementById('random_items').innerHTML = data;
            attachWishlistListeners();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});


// Filter for price
pricefilter.addEventListener('submit', function(event) {
    event.preventDefault(); // prevent the form from submitting and refreshing the page
    let min = document.getElementById('min_price').value;
    let max = document.getElementById('max_price').value;
    if ((min == '' && max == '') || ((min != '' && max != '') && (min >= max))) {
        console.log('Invalid price range');
        document.getElementById('min_price').value = '';
        document.getElementById('max_price').value = '';
        return;
    }
    const filterId = min + '-' + max;
    const formData = new FormData();
    formData.append('price', filterId);
    fetch('apis/api_filter_items.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (!document.getElementById('choiceremprice')) {
            let li = document.createElement('li');
            li.setAttribute('id', 'choiceremprice');
            li.innerHTML = min + ' - ' + max;
            appfilters.appendChild(li);
        }
        else {
            document.getElementById('choiceremprice').innerHTML = min + ' - ' + max;
        }
        console.log(data);
        resetf.style.display = 'flex';
    })
    .catch(error => {
        console.error('Error:', error);
    });

    fetch('apis/api_updateItems.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        document.getElementById('random_items').innerHTML = data;
        attachWishlistListeners();
    })
    .catch(error => {
        console.error('Error:', error);
    });
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
        fetch('apis/api_filter_items.php', {
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

        fetch('apis/api_updateItems.php', {
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            document.getElementById('random_items').innerHTML = data;
            attachWishlistListeners();
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
    fetch('apis/api_filter_items.php', {
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

    fetch('apis/api_updateItems.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        document.getElementById('random_items').innerHTML = data;
        attachWishlistListeners();
    })
    .catch(error => {
        console.error('Error:', error);
    });
});