/**
 * Navbar scroll transition.
 */
(new IntersectionObserver((e,o) => {
    if (document.querySelector('.navbar-toggler').classList.contains('collapsed')) {
        if (e[0].intersectionRatio > 0){
            document.querySelector('nav').classList.remove('stuck');
            document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal-white.svg';
            document.querySelector('nav').classList.remove('border');
        } else {
            document.querySelector('nav').classList.add('stuck');
            document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal.svg';
            document.querySelector('nav').classList.add('border');
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
    document.querySelector('nav').classList.toggle('stuck');

    if (document.querySelector('nav').classList.contains('stuck'))
        document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal.svg';
    else
        document.querySelector('.navbar-brand img').src = '../assets/logo-horizontal-white.svg';
});