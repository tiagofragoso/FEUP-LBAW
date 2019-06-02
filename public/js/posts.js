async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

let postContent = document.querySelector('#postFormTextarea');


if (postContent !== null) {
    document.querySelector('.submit-post').addEventListener('click', postPost);
}

async function postPost(event) {
    event.preventDefault();
    console.log('uhuh post');

    let postType;
    if (document.querySelector('#text').checked) {
        postType = 'Post';
    } else if (document.querySelector('#poll').checked) {
        postType = 'Poll';
    } else if (document.querySelector('#file').checked) {
        postType = 'File';
    }

    let requestBody = {
        content: postContent.value,
        type: postType
    }

    let event_id = document.querySelector('.submit-post').dataset.id;

    const response = await request (
        '/api/events/' + event_id + '/posts',
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

        console.log(response);

}