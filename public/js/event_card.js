export function getEventCard(id, title, start_date, location, price, photo) {
    let card = document.createElement('div');
    card.className = 'col-12 col-md-6 col-lg-4';

    card.innerHTML = `
        <a href="events/${id}" class="event-card mb-5 hover-shadow link" tabindex="-1">
            <header class="w-100 position-relative event-header d-flex align-items-center">
                <img src="${photo}" class="w-100" alt="">
                <div class="position-absolute w-100 h-100 gradient-overlay"></div>
                <h6 class="position-absolute event-title px-3"></h6>
            </header>
            <article class="event-info py-2">
                <div class="container-fluid">
                    <div class="row d-flex align-items-center mt-1">
                        <i class="col-1 far fa-calendar-alt"></i>
                        <div class="col-10 event-date"></div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex align-items-center mt-1">
                        <i class="col-1 fas fa-map-marker-alt"></i>
                        <div class="col-10 event-location"></div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex align-items-center mt-1">
                        <i class="col-1 fas fa-ticket-alt"></i>
                        <div class="col-10 event-price"></div>
                    </div>
                </div>
            </article>
        </a>
    `;

    card.querySelector('.event-title').textContent = title;
    card.querySelector('.event-date').textContent = moment(start_date).format('ddd, d MMM Y') || "Unscheduled";
    card.querySelector('.event-location').textContent = location;
    card.querySelector('.event-price').textContent = price;
    return card;
}