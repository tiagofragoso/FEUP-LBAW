import {request} from "./requests.js";

const INVITE_URL = '/api/invites/';

document.querySelectorAll('.report-card:not(.card-fade)').forEach(e => {
	const id = e.dataset.id;
	e.querySelector('button.ban-btn').addEventListener('click', () => updateInvite(e, id, 'Declined'));
	e.querySelector('button.diss-btn').addEventListener('click', () => updateInvite(e, id, 'Accepted'));
});

async function updateInvite(element, id, status) {
	const url = INVITE_URL + id;
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

	if (response.status === 200) {
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
	newDiv.innerHTML = `<p class="my-0 ${status === 'Declined'? 'baned-btn' : 'dissed-btn'} text-uppercase">
		${status}
		</p>`;
	div.appendChild(newDiv);
}