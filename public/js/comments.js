
let commentContent = document.querySelector('#commentFormTextArea');
let commentLikeBtns = document.querySelectorAll('#like-comment-btn');


if (commentContent !== null) {
    console.log(commentContent);
    document.querySelector('.submit-comment').addEventListener('click', postComment);
}

async function postComment(event){
    event.preventDefault();
    
    let requestBody = {
        content: commentContent.value,
        parent: null
    }

    let post_id = document.querySelector('.submit-comment').dataset.id;

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
        //console.log(response);
        commentContent.value = "";
        insertComment(createComment(response));
    }
}
function createComment(response){
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

function insertComment(comment){
    
    let comments = document.querySelector('.comments-list');
    comments.insertBefore(comment, comments.childNodes[0]);
}

commentLikeBtns.forEach(button => {

    button.addEventListener('click', async () => {
        let textBtn = button.closest('.comment-footer').getElementsByTagName('button')[0].innerText;
        let comment_id = button.closest('.comment-wrapper').dataset.id;
        let numberLikes = button.closest('.comment-footer').getElementsByTagName('span')[0].textContent;
        let url = '/api/comments/' + comment_id + '/like';
        if (textBtn.trim().localeCompare("Like") == 0) {
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
                button.closest('.comment-footer').getElementsByTagName('button')[0].innerText= 'Liked';
                button.closest('.comment-footer').getElementsByTagName('span')[0].textContent++;
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
            if (response === 200) {

                button.closest('.comment-footer').getElementsByTagName('button')[0].innerText= 'Like';
                button.closest('.comment-footer').getElementsByTagName('span')[0].textContent--;
                
            }
        }


    })
});