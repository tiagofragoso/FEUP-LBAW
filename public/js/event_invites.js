import { request } from './requests.js';

const FOLLOWING_URL = '/api/profile/following';

document.querySelector('#invite-btn').addEventListener('click', async () => {
	const data = await request(FOLLOWING_URL, {
		method: 'GET',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
			'Accept': 'application/json'
		}
	});
	console.log(data);
	populateModal(data.data);
});

function populateModal(data) {
	const list = document.querySelector('#invite-list');
	while (list.firstChild) {
		list.firstChild.remove();
	}
	for (let user of data) {
		list.appendChild(createEl(user));
	}
}

function createEl(user) {
	const wrapper = document.createElement('div');
	wrapper.className = 'row';
	wrapper.innerHTML = '<div class="user-row col-12 d-flex flex-row justify-content-between"></div>';
	const content = wrapper.querySelector('.user-row');
	for (let p in user) {
		const el = document.createElement('p');
		el.textContent = user[p];
		content.appendChild(el);
	}
	return wrapper;
}