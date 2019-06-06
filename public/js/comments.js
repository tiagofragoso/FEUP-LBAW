import {request} from "./requests.js";

let commentLikeBtns = document.querySelectorAll('.like-comment-btn');
let commentContent = document.querySelectorAll('.commentFormTextArea');

commentContent.forEach(content => {

    content.nextElementSibling.querySelector('.submit-comment').addEventListener('click',postComment);
});


async function postComment(event) {

    event.preventDefault();

    if (event.target.parentNode.parentNode.previousElementSibling.value !== "" &&
    event.target.parentNode.parentNode.previousElementSibling.value != undefined ){
    let requestBody = {
        content: event.target.parentNode.parentNode.previousElementSibling.value,
        parent: null
    }

    let post_id = event.target.parentNode.parentNode.querySelector('.submit-comment').dataset.id;
    const response = await request(
        '/api/posts/' + post_id + '/comments',
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
    if (!response.errors) {
        event.target.parentNode.parentNode.previousElementSibling.value = "";
        insertComment(createComment(response),post_id);
    }
}
}
function createComment(response) {
    const comment = document.createElement('div');
    comment.className = 'row col-12 comment align-items-start justify-content-center';
    comment.innerHTML = `
    <div class="col-12 col-md-10 d-flex flex-row">
        <a href="url('/users/${response.user_id}')}">
            <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3" width="30" height="30" />
        </a>
        <div class="w-100 d-flex flex-column">
            <div class="comment-wrapper d-flex flex-column w-100" data-id="${response.id}">
                <div class="comment-text px-3 py-2">
                    <span>
                        <a class="title-link mr-2" href="{{ url('/users/'.${response.user_id})}}">
                            <span class=" author">${response.user}</span>
                        </a>
                        ${response.content}
                    </span>
                </div>
                <div class="comment-footer ml-3">
                    <span id="numberLikes">0</span>
                    <span> likes </span>
                    •
                    <button class="bg-transparent border-0" id="like-comment-btn">
                       Like
                    </button>
                    •
                    <span>${response.date}</span>
                </div>
            </div>
        </div>
    </div>
</div>`;
    return comment;
}

function insertComment(comment,post_id) {
    
    let comments = document.getElementById("comments-list"+post_id);
    console.log(comments);
    comments.insertBefore(comment, comments.childNodes[0]);
}

commentLikeBtns.forEach(button => {

    button.addEventListener('click', async () => {
        let comment_id = button.closest('.comment-wrapper').dataset.id;
        let url = '/api/comments/' + comment_id + '/like';
        console.log(button.textContent);
        if (button.textContent.trim() === 'Like') {
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
            if (response.status === 200) {
                button.textContent = 'Liked';
                button.closest('.comment-footer').querySelector('span').textContent++;
            }
        } else {
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
            if (response.status === 200) {
                button.textContent = 'Like';
                button.closest('.comment-footer').querySelector('span').textContent--;
                
            }
        }


    })
});