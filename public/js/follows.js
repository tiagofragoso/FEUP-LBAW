import { request } from "./requests.js";

function clearModal() {
    document.querySelector('#followsModal .modal-body .container').innerHTML = '';
}

function getFollowCard(follow) {
    const card = document.createElement('div');
    card.className = 'row d-flex align-items-center mb-3';
    card.innerHTML = `
        <div class="col-2">
            <img src="/assets/user.svg" class="rounded-circle border border-light" />
        </div>
        <a href="users/${follow.id}" class="col-7 name"></a>
        <div class="col-3">
            <button class="btn btn-primary w-100">
                Follow
            </button>
        </div>
    `;
    card.querySelector('.name').textContent = follow.name;
    return card;
}

document.querySelector('.number-followers').addEventListener('click', async () => {
    document.querySelector('#followsModal .modal-title').textContent = 'Followers';

    let id = document.querySelector('.number-followers').dataset.id;

    const response = await request('/api/users/'+id+'/followers', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    });

    clearModal();
    if (response.data.followers.length == 0) {
        document.querySelector('#followsModal .modal-body .container').innerHTML = '<h4 class="text-center w-100">No results found</h4>';
    }
    else {
        response.data.followers.forEach(follower => {
            document.querySelector('#followsModal .modal-body .container').appendChild(getFollowCard(follower));
        });
    }

    $('#followsModal').modal('show');
});

document.querySelector('.number-following').addEventListener('click', async () => {
    document.querySelector('#followsModal .modal-title').textContent = 'Following';

    let id = document.querySelector('.number-followers').dataset.id;

    const response = await request('/api/users/'+id+'/following', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    });

    clearModal();
    if (response.data.following.length == 0) {
        document.querySelector('#followsModal .modal-body .container').innerHTML = '<h3 class="text-center w-100">No results found</h3>';
    }
    else {
        response.data.following.forEach(followed => {
            document.querySelector('#followsModal .modal-body .container').appendChild(getFollowCard(followed));
        });
    }

    $('#followsModal').modal('show');
});