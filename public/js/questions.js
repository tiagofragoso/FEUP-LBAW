async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

let questionContent = document.querySelector('#questionFormTextarea');

if (questionContent !== null) {
    document.querySelector('.submit-question').addEventListener('click', postQuestion);
    document.querySelector('#question-confirmation-message').classList.add('d-none');
}

async function postQuestion(event) {
    event.preventDefault();

    let requestBody = {
        content: questionContent.value,
    }

    let event_id = document.querySelector('.submit-question').dataset.id;

    const response = await request (
        '/api/events/' + event_id + '/questions',
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestBody)
        }
    );

    if (response) { // if (response.status === 201) {
        console.log(response); 
        questionContent.value = "";
        document.querySelector('#question-confirmation-message').classList.remove('d-none');
    }
}
