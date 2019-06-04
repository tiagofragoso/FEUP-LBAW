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
		list.appendChild(getHr());
	}
}

function getHr() {
	const hr_row = document.createElement('div');
	hr_row.className = 'row';
	hr_row.innerHTML = '<div class="col-12"><hr class="mb-1 mt-1"></div>';
	return hr_row;
}

function createEl(user) {
	const href = `/users/${user['id']}`;
	const wrapper = document.createElement('div');
	wrapper.className = 'row';
	wrapper.innerHTML = `
		<div class="user-row col-11 mx-auto d-flex flex-row justify-content-between align-items-center">
			<div class="leftWrapper d-flex flex-row align-items-center">
				<img class="rounded-circle rounded-circle border border-light mr-3" width="35" height="35"></img>
				<div class="d-flex flex-column">
					<a class="name font-weight-bold"></a>
					<a class="username text-muted"></a>
				</div>
			</div>
			<button>Invite</button>
		</div>`;

	const pic = wrapper.querySelector('.leftWrapper > img');
	pic.setAttribute('src', '/assets/user.svg'); //change this?
	pic.setAttribute('href', href);

	if (!user['name']) {
		wrapper.querySelector('.name').remove();
	} else {
		wrapper.querySelector('.name').textContent = user['name'];
		wrapper.querySelector('.name').setAttribute('href', href);
	}
	wrapper.querySelector('.username').textContent = user['username']? '@' + user['username']: '';
	wrapper.querySelector('.username').setAttribute('href', href);
	return wrapper;
}