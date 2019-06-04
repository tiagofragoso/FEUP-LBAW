import {request} from "./requests.js";
import {getEventCard} from './event_card.js';

/**
 * Navbar scroll transition.
 */
let stuck = true;

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
// document.querySelectorAll('.dropdownField').forEach(element => {
//     element.addEventListener('click', () => {
//         document.querySelectorAll('*[data-field="'+element.dataset.field+'"]').forEach(element2 => {
//             element2.classList.toggle('btn-outline-primary');
//             element2.classList.toggle('btn-primary');
//         });
//     });
// });

document.getElementById('location-input').addEventListener('change', function () {
    updateButtons('dropdownLocation', 'Location', this.value);
    requestObj.location = this.value;
});

document.getElementById('start-price-input').addEventListener('change', function () {
    requestObj.start_price = this.value;
    updateButtons('dropdownPrice', 'Price', getPrice());
});

document.getElementById('end-price-input').addEventListener('change', function () {
    requestObj.end_price = this.value;
    updateButtons('dropdownPrice', 'Price', getPrice());
});

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

document.querySelectorAll('*[aria-labelledby="dropdownCategory"] .dropdown-item').forEach(item => {
    updateList(item, 'dropdownCategory', 'Category', item.dataset.value, item.textContent, 'category');
});

document.querySelectorAll('*[aria-labelledby="dropdownStatus"] .dropdown-item').forEach(item => {
    updateList(item, 'dropdownStatus', 'Status', item.dataset.value, item.textContent, 'status');
});

document.querySelectorAll('*[aria-labelledby="dropdownSort"] .dropdown-item').forEach(item => {
    updateList(item, 'dropdownSort', 'Sort by', item.dataset.value, item.textContent, 'sort_by');
});

function updateList(item, ariaLabel, title, value, placeholder, field) {
    item.addEventListener('click', () => {
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
    });
}

function updateButtons(fieldName, title, value) {
    if (value === '') {
        document.querySelectorAll('*[data-field="' + fieldName + '"]').forEach(element => {
            element.classList.add('btn-outline-primary');
            element.classList.remove('btn-primary');
            element.querySelector('span').textContent = title;
        });
        return;
    }

    document.querySelectorAll('*[data-field="' + fieldName + '"]').forEach(element => {
        element.classList.remove('btn-outline-primary');
        element.classList.add('btn-primary');
        element.querySelector('span').textContent = value;
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
 * Search submit button event.
 */
document.getElementById('button-go').addEventListener('click', () => {
    let query = document.getElementById('search-input').value;

    if (query === "") {
        document.getElementById('search-query').textContent = "Trending event";
        return;
    }

    document.getElementById('search-query').textContent = query;
});

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

let requesting = false;
document.addEventListener('scroll', async () => {
    if ((($(document).height()-$(window).height())-$(window).scrollTop() < 5) && !requesting) {
        requesting = true;

        const data = await request(getQueryString(), {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        data.data.forEach((event) => {
            let card = getEventCard(event.id, event.title, event.start_date, event.location, event.price);
            document.getElementById('card-container').appendChild(card);
        });

        if (data.data.length > 0)
            requestObj.page++;

        requesting = false;
    }
});

function getQueryString() {
    let query = '/api/search?page='+requestObj.page;

    if (requestObj.search != null) {
        query += '&search=' + requestObj.search;
    }

    return query;
}