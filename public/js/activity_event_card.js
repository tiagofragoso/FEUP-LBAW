import { joinHandler } from "./join_event.js";

export function createActivityEventCard(event) {
    const eventCard = document.createElement('div');
    eventCard.className = 'activity-event-card d-flex align-items-center hover-shadow';
    eventCard.tabIndex = '-1';
    eventCard.innerHTML = `
        <div class="w-25 h-100 overflow-hidden d-flex justify-content-center">
            <img class="h-100" src="../assets/event-placeholder.png" alt="event placeholder image">
        </div>
        <div class="d-flex align-items-center w-75">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <a href="events/${event.id}" class="col-12 event-link">
                        <h5 class="event-title"></h5>
                    </a>

                    <div class="col-7 col-md-9 mt-4">
                        <div class="text-muted event-date"></div>
                        <div class="text-muted event-location"></div>
                    </div>

                    <div class="col-5 col-md-3 mt-4 join-btn-container"></div>
                </div>
            </div>
        </div>
    `;

    eventCard.querySelector('.event-title').textContent = event.title;
    eventCard.querySelector('.event-date').textContent = moment(new Date(event.start_date)).format('D MMM YYYY');
    eventCard.querySelector('.event-location').textContent = event.location;

    if (event.joined) {
        eventCard.querySelector('.join-btn-container').innerHTML = `
            <button type="button" class="btn btn-outline-primary join-btn joined w-100" data-id="${event.id}">
                Joined
            </button>
        `;
    }
    else {
        eventCard.querySelector('.join-btn-container').innerHTML = `
            <button type="button" class="btn btn-primary join-btn join w-100" data-id="${event.id}">
                Join
            </button>
        `;
    }
    eventCard.querySelector('.join-btn').addEventListener('click', joinHandler.bind(eventCard.querySelector('.join-btn'), event.id));

    return eventCard;
}