import { request } from './requests.js';

const INVITE_URL = '/api/invites';
const FOLLOWING_URL = INVITE_URL + '/following';
const SEARCH_URL = INVITE_URL + '/search';

const EVENT_ID = document.querySelector('#content').dataset.id;

if (document.querySelector('#invite-btn')) {
	const searchBox = document.querySelector('#invite-search input[type="text"][name="query"]');
	searchBox.addEventListener('input', () => onQueryChange(searchBox.value));

	const searchButton = document.querySelector('#invite-search button');
	searchButton.addEventListener('click', e => {
		e.preventDefault();
		onQueryChange(searchBox.value);
	});

	const noResultsEl = document.querySelector('#invite-list #no-results');

	document.querySelector('#invite-btn').addEventListener('click', async () => {
		const response = await fetchFollowing();
		if (response.status === 200)
			populateModal(response.data);
		else
			populateModal([]);
	});

	async function fetchFollowing() {
		const url = FOLLOWING_URL + `?event_id=${encodeURIComponent(EVENT_ID)}`;
		const response = await request(url, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
				'Accept': 'application/json'
			}
		});
		return response;
	}

	async function fetchUsers(query) {
		const url = SEARCH_URL + `?event_id=${encodeURIComponent(EVENT_ID)}&query_term=${encodeURIComponent(query)}`;
		const response = await request(url, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
				'Accept': 'application/json'
			}
		});
		return response;
	}


	async function onQueryChange(query) {
		query = query.trim();
		let response;
		if (query !== '') {
			response = await fetchUsers(query);
		} else {
			response = await fetchFollowing();
		}
		if (response.status === 200)
			populateModal(response.data);
		else
			populateModal([]);
	}

	function populateModal(data) {
		const list = document.querySelector('#invite-list');
		if (data.length === 0)
			document.querySelector('#invite-list #no-results').style.display = 'block';
		else
			document.querySelector('#invite-list #no-results').style.display = 'none';

		while (list.lastChild != noResultsEl) {
			list.lastChild.remove();
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
					<span class="invite-type">PARTICIPANT</span>
				</div>
				<button class="btn btn-sm btn-secondary ml-3"><i class="fas fa-envelope"></i></button>
			</div>
		</div>`;

		const pic = wrapper.querySelector('.left-wrapper img');
		const refEl = wrapper.querySelector('.right-wrapper .invite-type');

		if (!user['invited']) {
			if (user['part'] && user['part'] !== 'Participant') {
				wrapper.querySelector('.right-wrapper button').setAttribute('disabled', 'disabled');
				const joined = document.createElement('span');
				joined.textContent = user['part'].toUpperCase();
				joined.style = `border-bottom: 1px solid var(--grey); color: var(--grey);`;
				wrapper.querySelector('.right-wrapper > div').insertBefore(joined, wrapper.querySelector('.invite-type'));
				wrapper.querySelector('.invite-type').remove();
				wrapper.querySelector('.right-wrapper button').setAttribute('disabled', 'disabled');
			} else {
				const form = document.createElement('form');
				form.innerHTML = `
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
				</label>`;
				if (user['part']) {
					form.querySelector('input[value="Participant"]').setAttribute('disabled', null);
					form.querySelector('input[value="Participant"]').removeAttribute('checked');
					form.querySelector('input[value="Artist"]').setAttribute('checked', null);
					wrapper.querySelector('.invite-type').textContent = 'ARTIST';
				}
				form.querySelectorAll('input[type="radio"]').forEach(el => el.addEventListener('change', (e) => updateInviteType(e.target, wrapper)));
				wrapper.querySelector('.right-wrapper > div').insertBefore(form, refEl);
			}
		} else {
			let text;
			switch (user['invite_status']) {
				case 'Pending':
					text = 'INVITED';
					break;
				case 'Accepted':
					text = 'ACCEPTED';
					break;
				case 'Declined':
					text = 'DECLINED';
					break;
			}
			wrapper.querySelector('.invite-type').textContent = user['invite_type'].toUpperCase();
			const invited = document.createElement('span');
			invited.textContent = text;
			invited.style = `border-bottom: 1px solid var(--grey); color: var(--grey);`;
			wrapper.querySelector('.right-wrapper > div').insertBefore(invited, wrapper.querySelector('.invite-type'));
			wrapper.querySelector('.right-wrapper button').setAttribute('disabled', 'disabled');
		}

		pic.setAttribute('src', '/assets/user.svg'); //change this?
		pic.parentElement.setAttribute('href', href);

		if (!user['name']) {
			wrapper.querySelector('.name').remove();
		} else {
			wrapper.querySelector('.name').textContent = user['name'];
			wrapper.querySelector('.name').setAttribute('href', href);
		}
		wrapper.querySelector('.username').textContent = user['username'] ? '@' + user['username'] : '';
		wrapper.querySelector('.username').setAttribute('href', href);

		wrapper.querySelector('.right-wrapper button').addEventListener('click', () => sendInvite(wrapper));
		return wrapper;
	}

	function updateInviteType(target, wrapper) {
		const label = target.getAttribute('value').toUpperCase();
		wrapper.querySelector('.invite-type').textContent = label;
	}

	async function sendInvite(wrapper) {
		const invited_id = wrapper.querySelector('.user-row').dataset.id;
		const form = wrapper.querySelector('form');
		const type = form.querySelector('input[type="radio"]:checked').getAttribute('value');
		const response = await request(INVITE_URL, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
				'Accept': 'application/json'
			},
			body: JSON.stringify({ 'event_id': EVENT_ID, 'invited_id': invited_id, 'type': type })
		});

		if (response.status === 201) {
			form.remove();
			const invited = document.createElement('span');
			invited.textContent = 'INVITED';
			invited.style = `border-bottom: 1px solid var(--grey); color: var(--grey);`;
			wrapper.querySelector('.right-wrapper > div').insertBefore(invited, wrapper.querySelector('.invite-type'));
			wrapper.querySelector('.right-wrapper button').setAttribute('disabled', 'disabled');
		}

	}
}

