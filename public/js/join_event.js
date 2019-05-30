async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

let buttons = document.querySelectorAll('.join-btn');
function updateVisual(join) {
    if (join) {
        this.classList.replace('joined', 'join');
        this.textContent = 'Join';
        this.classList.replace('btn-outline-primary', 'btn-primary');
    } else {
        this.classList.replace('join', 'joined');
        this.textContent = 'Joined';
        this.classList.replace('btn-primary', 'btn-outline-primary');
    }
}


buttons.forEach(button => {
    let event_id = button.dataset.id;
    button.addEventListener('click', async () => {
        let url = '/api/events/'+ event_id + '/join';
        if (button.classList.contains('join')) {
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
                updateVisual.call(button, false);
            }
        } else if (button.classList.contains('joined')) {
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
                updateVisual.call(button, true);
            } 
        }
    });
});