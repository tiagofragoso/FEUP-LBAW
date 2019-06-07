import {request} from "./requests.js";
import {getEventCard} from './event_card.js';

let stuck = true;
let requesting = false;

/**
 * Navbar scroll transition.
 */
(new IntersectionObserver((e,o) => {
    if (document.querySelector('.navbar-toggler').classList.contains('collapsed')) {
        if (e[0].intersectionRatio > 0){
            document.querySelector('nav').classList.remove('stuck');
            document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal-white.svg';
            document.querySelector('nav').classList.remove('border-navbar');
            stuck = true;
        } else {
            document.querySelector('nav').classList.add('stuck');
            document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal.svg';
            document.querySelector('nav').classList.add('border-navbar');
            stuck = false;
        };
    }
})).observe(document.querySelector('.trigger'));

/**
 * Navbar toggler click event.
 */
document.querySelector('.navbar-toggler').addEventListener('click', () => {
    let navbar = document.querySelector('nav');
    
    if (!stuck) {
        return;
    }

    navbar.classList.toggle('stuck');

    if (navbar.classList.contains('stuck'))
        document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal.svg';
    else
        document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal-white.svg';
});

/**
 * Search filters hide event
 */

document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
    dropdown.addEventListener("click", (event) => {
        event.stopPropagation();
    });
});

/**
 * Search fields onchange events.
 */
document.getElementById('search-input').addEventListener('change', function () {
    requestObj.search = this.value;
});

$('.datepicker-here').each((i, dt) => {
    dt.modified = false;
    $(dt).datepicker({
        onSelect: function (formattedDate, date, inst) {
            if (date.length === 2) {
                updateButtons('dropdownDate', 'Date', moment(date[0]).format('DD-MM-YYYY') + ' - ' + moment(date[1]).format('DD-MM-YYYY'));
                requestObj.start_date = moment(date[0]).toISOString();
                requestObj.end_date = moment(date[1]).toISOString();
                resetRequest();
                search();
            }
            else {
                requestObj.start_date = '';
                requestObj.end_date = '';
                updateButtons('dropdownDate', 'Date', '');
                resetRequest();
                search();
            }
        }
    });
});

document.querySelectorAll('.location-input').forEach(input => {
    input.addEventListener('change', () => {
        requestObj.location = input.value;
        updateInputs('dropdownLocation', 'Location', input.value, input.value, 'location', '.location-input');
        resetRequest();
        search();
    });
});

document.querySelectorAll('.start-price-input').forEach(input => {
    input.addEventListener('change', () => {
        requestObj.start_price = input.value;
        updateInputs('dropdownPrice', 'Price', input.value, getPrice(), 'start_price', '.start-price-input');
        resetRequest();
        search();
    });
});

document.querySelectorAll('.end-price-input').forEach(input => {
    input.addEventListener('change', () => {
        requestObj.end_price = input.value;
        updateInputs('dropdownPrice', 'Price', input.value, getPrice(), 'end_price', '.end-price-input');
        resetRequest();
        search();
    });
});

document.querySelectorAll('*[aria-labelledby="dropdownCategory"] .dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
        updateList(item, 'dropdownCategory', 'Category', item.dataset.value, item.textContent, 'category');
        resetRequest();
        search();
    });
});

document.querySelectorAll('*[aria-labelledby="dropdownStatus"] .dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
        updateList(item, 'dropdownStatus', 'Status', item.dataset.value, item.textContent, 'status');
        resetRequest();
        search();
    });
});

document.querySelectorAll('*[aria-labelledby="dropdownSort"] .dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
        updateList(item, 'dropdownSort', 'Sort by', item.dataset.value, item.textContent, 'sort_by');
        resetRequest();
        search();
    });
});

function updateInputs(ariaLabel, title, value, placeholder, field, className) {
    updateButtons(ariaLabel, title, placeholder);
    document.querySelectorAll(className).forEach(input => {
        input.value = value;
    });
}

function getPrice() {
    let placeholder = '';
    if (requestObj.start_price === '')
        placeholder += 'any';
    else
        placeholder += requestObj.start_price + '€';

    placeholder += ' - ';

    if (requestObj.end_price === '')
        placeholder += 'any';
    else
        placeholder += requestObj.end_price + '€';

    return placeholder === 'any - any' ? '' : placeholder;
}

function updateList(item, ariaLabel, title, value, placeholder, field) {
    if (item.classList.contains('active')) {
        removeActive('*[aria-labelledby="' + ariaLabel + '"]');
        updateButtons(ariaLabel, title, '');
        requestObj[field] = '';
        return;
    }
    
    removeActive('*[aria-labelledby="' + ariaLabel + '"]');
    setActive('*[aria-labelledby="' + ariaLabel + '"]', value)
    updateButtons(ariaLabel, title, placeholder);
    requestObj[field] = value;
}

function updateButtons(fieldName, title, value) {
    if (value === '') {
        document.querySelectorAll('*[data-field="' + fieldName + '"]').forEach(element => {
            element.classList.add('btn-outline-primary');
            element.classList.remove('btn-primary');
            element.querySelector('span').textContent = title;
            element.title = "";
        });
        return;
    }

    document.querySelectorAll('*[data-field="' + fieldName + '"]').forEach(element => {
        element.classList.remove('btn-outline-primary');
        element.classList.add('btn-primary');
        element.querySelector('span').textContent = value;
        element.title = value;
    });
}

function setActive(container, value) {
    document.querySelectorAll(container).forEach(list => {
        list.querySelector('*[data-value="' + value + '"').classList.add('active')
    });
}

function removeActive(container) {
    document.querySelectorAll(container).forEach(list => {
        let item;
        if ((item = list.querySelector('.active')) !== null) {
            item.classList.remove('active');
        }
    });
}

/**
 * Search submit events.
 */
document.getElementById('button-go').addEventListener('click', queryTextRequest);

document.getElementById('search-input').addEventListener('keypress', e => {
    var key = e.which || e.keyCode;
    if (key === 13) {
        queryTextRequest();
    }
});

function queryTextRequest() {
    let query = document.getElementById('search-input').value;
    requestObj.search = query;

    if (query === "")
        document.getElementById('search-query').textContent = "Trending events";
    else
        document.getElementById('search-query').textContent = query;

    resetRequest();
    search();
    document.getElementById('card-container').scrollIntoView({
        behavior: 'smooth'
    });
}

/**
 * Infinite scrolling
 */
document.addEventListener('scroll', () => {
    if ((($(document).height()-$(window).height())-$(window).scrollTop() < 5) && !requesting) {
        search();
    }
});

/**
 * Search request
 */
function resetRequest() {
    document.getElementById('card-container').innerHTML = '';
    requestObj.page = 1;
}

async function search() {
    requesting = true;
    const response = await request(getQueryString(), {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    });

    if (response.data.data.length === 0 && requestObj.page === 1 && document.getElementById('no-results') === null) {
        let noResults = document.createElement('h3');
        noResults.id = 'no-results';
        noResults.className = 'w-100 text-center';
        noResults.textContent = 'No results were found.';
        document.getElementById('card-container').appendChild(noResults);
    }
    else {
        response.data.data.forEach((event) => {
            const photo = event.photo? '/storage/' + event.photo: '/assets/event-placeholder.png';
            let card = getEventCard(event.id, event.title, event.start_date, event.location, event.price, photo);
            document.getElementById('card-container').appendChild(card);
        });
    }

    if (response.data.data.length > 0)
        requestObj.page++;

    requesting = false;
}

function getQueryString() {
    let query = '/api/search?page=' + requestObj.page;

    if (requestObj.search != '') {
        query += '&search=' + requestObj.search;
    }

    if (requestObj.start_date !== '') {
        query += '&start_date=' + requestObj.start_date;
    }

    if (requestObj.end_date !== '') {
        query += '&end_date=' + requestObj.end_date;
    }

    if (requestObj.location !== '') {
        query += '&location=' + requestObj.location;
    }

    if (requestObj.start_price !== '') {
        query += '&start_price=' + requestObj.start_price;
    }

    if (requestObj.end_price !== '') {
        query += '&end_price=' + requestObj.end_price;
    }

    if (requestObj.category !== '') {
        query += '&category=' + requestObj.category;
    }

    if (requestObj.status !== '') {
        query += '&status=' + requestObj.status;
    }

    if (requestObj.sort_by !== '') {
        query += '&sort_by=' + requestObj.sort_by;
    }

    return query;
}