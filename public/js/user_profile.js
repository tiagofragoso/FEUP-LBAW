async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

let user_id = document.querySelector(".username").dataset.id;
let followers = document.querySelector(".number-followers");

let button = document.getElementById('follow-button');

function updateVisualFollow(follow) {
    if (button != null) {
        if (follow) {
            button.classList.replace('following', 'follow');
            button.textContent = 'Follow';
            button.classList.replace('btn-oultine-secondary', 'btn-secondary');
            followers.textContent--;
        } else {
            button.classList.replace('follow', 'following');
            button.textContent = 'Following';
            button.classList.replace('btn-secondary', 'btn-outline-secondary');
            followers.textContent++;
        } 
    }
}

if (button != null) {
    button.addEventListener('click', async () => {
        let url = '/api/users/'+ user_id + '/follows';
        if (button.classList.contains('follow')) {
            const response = await request(
                url,
                {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                }
            );
            if (response === 200) {
                updateVisualFollow(false);
            }
        } else if (button.classList.contains('following')) {
            const response = await request(
                url,
                {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                }
            );
            if (response === 200) {
                updateVisualFollow(true);
            }
        }
    });
}

