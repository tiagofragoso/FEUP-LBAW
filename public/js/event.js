async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

function getIDfromURL(){
    return window.location.pathname.split('/')[2];
}

document.getElementById('join-button').addEventListener('click', async () => {
    let url = '/api/events/'+ getIDfromURL()+'/join';
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
    if (response.errors){
        return;
    }
    if (response == 200){
        document.getElementById('join-button').textContent = 'Joined';
        document.getElementById('participants').textContent++;
    
    } else {
        document.getElementById('join-button').textContent = 'Join';
        document.getElementById('participants').textContent--;
    }
    document.getElementById('participants').innerHTML = document.getElementById('participants').textContent + ' <i class="mr-1 fas fa-users"></i>';
});