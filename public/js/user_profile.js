async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    console.log(data);
    return data;
}
function getIDfromURL(){
    return window.location.pathname.split('/')[2];
}


document.getElementById('follow-button').addEventListener('click', async () => {
    let url = '/api/users/'+ getIDfromURL()+'/follows';
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
});