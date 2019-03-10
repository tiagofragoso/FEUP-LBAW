/**
 * Navbar scroll transition.
 */
(new IntersectionObserver((e,o) => {
    if (e[0].intersectionRatio > 0){
        document.querySelector('nav').classList.remove('stuck');
    } else {
        document.querySelector('nav').classList.add('stuck');
    };
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