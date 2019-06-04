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
		<div class="user-row col-11 mx-auto d-flex flex-row justify-content-between align-items-center position-relative" data-id="${user['id']}">
			<div class="left-wrapper d-flex flex-row align-items-center">
				<a>
					<img class="rounded-circle rounded-circle border border-light mr-3" width="35" height="35"></img>
				</a>
				<div class="d-flex flex-column">
					<a class="name font-weight-bold"></a>
					<a class="username text-muted"></a>
				</div>
			</div>
			<div class="right-wrapper d-flex flex-row align-items-center">
				<div class="d-flex flex-column align-items-center">
					<form>
						<input id="p${user['id']}" type="radio" name="type" style="display: none" value="Participant" checked>
						<label class="invite-label p-2" for="p${user['id']}">
							<i class="fas fa-user"></i>
						</label>
						<input id="a${user['id']}" type="radio" name="type" style="display: none" value="Artist">
						<label class="invite-label p-2" for="a${user['id']}">
							<i class="fas fa-guitar"></i>
						</label>
						<input id="h${user['id']}" type="radio" name="type" style="display: none" value="Host">
						<label class="invite-label p-2" for="h${user['id']}">
							<i class="fas fa-star"></i>
						</label>
					</form>
					<span class="invite-type">PARTICIPANT</span>
				</div>
				<button class="btn btn-sm btn-secondary ml-3"><i class="fas fa-envelope"></i></button>
			</div>
		</div>`;

	const pic = wrapper.querySelector('.left-wrapper img');
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
	wrapper.querySelectorAll('input[type="radio"]').forEach(el => el.addEventListener('change', (e) => updateInviteType(e.target, wrapper)));

	wrapper.querySelector('.right-wrapper button').addEventListener('click', () => sendInvite(wrapper));
	return wrapper;
}

function updateInviteType(target, wrapper) {
	console.log('called');
	const label = target.getAttribute('value').toUpperCase();
	wrapper.querySelector('.invite-type').textContent = label;
}

function sendInvite(wrapper) {
	const id = wrapper.querySelector('.user-row').dataset.id;
	wrapper.querySelector('form').remove();
	const invited = document.createElement('span');
	invited.textContent = 'INVITED';
	invited.style = `border-bottom: 1px solid var(--grey); color: var(--grey);`;
	wrapper.querySelector('.right-wrapper > div').insertBefore(invited, wrapper.querySelector('.invite-type'));
	wrapper.querySelector('.right-wrapper button').setAttribute('disabled', 'disabled');
}