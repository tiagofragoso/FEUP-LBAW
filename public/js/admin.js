import {request} from "./requests.js";


document.querySelectorAll('#pending .card.report-card').forEach(e => {
    const id = e.dataset.id;
    const type = e.dataset.type;
    e.querySelector('#pending button.ban-btn').addEventListener('click', () => updateReport(e, id, type, 'Accepted'));
    e.querySelector('#pending button.diss-btn').addEventListener('click', () => updateReport(e, id, type, 'Declined'));
});

async function updateReport(element, id, type, status) {
    const url = `/api/${type}s/reports/${id}`;
    const response = await request(
        url,
        {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({answer: status})
        }
    );

    console.log(response);
    if(response.status === 200) {
        updateVisual(element, status);
    }
}

function updateVisual(element, status) {
    element.classList.add('card-fade');
	const div = element.querySelector('.card-footer > div');
	while (div.firstChild) {
		div.firstChild.remove();
	}
	const newDiv = document.createElement('div');
	newDiv.classList.add(['col-6', 'text-center']);
	newDiv.innerHTML = `<p class="my-0 ${status === 'Accepted'? 'baned-btn' : 'dissed-btn'} text-uppercase">
		${status === 'Accepted'? 'Banned': 'Dismissed'}
		</p>`;
	div.appendChild(newDiv);
}