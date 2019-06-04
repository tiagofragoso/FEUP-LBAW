import {request} from "/requests.js";
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
 * Search fields onchange events.
 */
document.querySelectorAll('.dropdownField').forEach(element => {
    element.addEventListener('click', () => {
        document.querySelectorAll('*[data-field="'+element.dataset.field+'"]').forEach(element2 => {
            element2.classList.toggle('btn-outline-primary');
            element2.classList.toggle('btn-primary');
        });
    });
});

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
    if ((($(document).height()-$(window).height())-$(window).scrollTop() < 0) && !requesting) {
        requesting = true;

        const response = await request(getQueryString(), {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        let data = response.data;

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
    
    console.log(requestObj.search);
    if (requestObj.search != null) {
        query += '&search=' + requestObj.search;
    }
    return query;
}