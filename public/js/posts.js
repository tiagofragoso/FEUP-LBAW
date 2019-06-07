import {request} from "./requests.js";
import {postComment} from "./comments.js"

let postContent = document.querySelector('#postFormTextarea');
let postLikeBtns = document.querySelectorAll('.like-post-btn');

let polls = document.querySelectorAll(".poll-container");
polls.forEach(function (poll) {
    let pollName = 'poll' + poll.dataset.id;
    let pollOptions = poll.querySelectorAll("input[type=radio][name=" + pollName + "]");
    let selectedOption = null;


    if (poll.querySelector("input[type=radio][name=" + pollName + "]:checked") !== null)
        selectedOption = poll.querySelector("input[type=radio][name=" + pollName + "]:checked").closest('.row');

    pollOptions.forEach(option => {
        let option_id = option.closest('.row').dataset.id;
        let post_id = option.closest('.container').dataset.id;
        option.addEventListener('click', async () => {
            let url = '/api/polls/' + post_id + '/votes';
            let requestBody = { pollOption: option_id };
            const response = await request(
                url,
                {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                }
            );
            if (response.status == 200) {
                poll.querySelector('.poll-error-message').classList.add('d-none');
                option.closest('.row').childNodes[3].dataset.id++;
                option.closest('.row').childNodes[3].innerText = option.closest('.row').childNodes[3].dataset.id + " votes";
                if (selectedOption !== null) {
                    selectedOption.closest('.row').childNodes[3].dataset.id--;
                    selectedOption.closest('.row').childNodes[3].textContent = selectedOption.closest('.row').childNodes[3].dataset.id + " votes";
                }
                selectedOption = option;
            }
            else if (response.status == 403) {
                poll.querySelector('.poll-error-message').classList.remove('d-none');

            }


        })
    });
});



if (postContent !== null) {
    document.querySelector('.submit-post').addEventListener('click', postPost);
}

export function createPost(response) {
    const post = document.createElement('div');
    post.className = 'post-wrapper';
    post.dataset.id = response.id;
    post.innerHTML =
        ` <div class="row justify-content-center">
        <div class="card col-12 col-lg-9 mb-4 hover-shadow">
            <div class="row">
                <div class="col-12 col-md-10">
                    <div class="py-3 px-0 px-md-3 w-100">
                        <div class="row">
                            <div class="col-12 d-flex flex-row">
                                <img src="../assets/user.svg"
                                    class="rounded-circle rounded-circle border border-light mr-2" width="30"
                                    height="30" />
                                <div class="d-flex flex-column">
                                    <p class="card-text mb-0">
                                        <a href="/users/${response.author_id}" class="badge badge-secondary">
                                            ${response.author_name}
                                        </a>
                                        created a
                                        <strong>post</strong>.
                                    </p>
                                    <span class="post-date text-muted">
                                       ${response.date}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="card-text mt-3">
                            
                        </p>
                    </div>
                </div>
                <div
                    class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
                    <button type="button" class="btn btn-light w-100 h-100 flex-grow-2 like-post-btn" data-id="${response.id}">
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-thumbs-up"></i>
                            <span>0</span>
                        </div>
                    </button>
                    <button type="button" data-toggle="collapse" data-target="#comments${response.id}"
                        aria-expanded="false" 
                        class="side-button btn btn-light w-100 h-100 flex-grow-2">
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-comment-alt"></i>
                            <span>0</span>
                        </div>
                    </button>
                </div>
            </div>
            <div class="row comment-section comment-section-posts collapse mb-3 border-top border-light pt-3" id="comments${response.id}" data-id="${response.id}">
                <div class="col-12" id="comments-list${response.id}">
                </div>
                <div class="dropdown-divider col-12 col-md-10 mx-auto mb-3 mt-2"></div>
                <div class="row col-12 mt-3 justify-content-center align-items-center">
                    <div class="col-12 col-md-10 d-flex flex-row align-items-center">
                        <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3"
                            width="30" height="30" />
                        <form class="position-relative w-100" action="">
                            <textarea class="form-control position-relative w-100 pr-5 textarea-parent" rows="1"
                                placeholder="Write a comment..." style="resize: none"></textarea>
                            <div
                                class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
                                <button class="submit-btn submit-comment" type="submit">
                                    <i class="fas fa-angle-double-right submit-comment-btn"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>`;

    post.querySelector('.card-text.mt-3').textContent = response.content;
    let section = post.querySelector('.comment-section-posts');
    let button = section.querySelector('.submit-comment');
    let context = {};

    context.content = section.querySelector('.textarea-parent');
    context.post_id = section.dataset.id;
    context.divider = section;


    button.addEventListener('click', postComment.bind(context));

    let like = post.querySelector('.like-post-btn');
    like.addEventListener('click', likePost.bind(like));

    return post;
}

function insertPost(post) {
    let posts = document.querySelector('.posts-list');
    posts.insertBefore(post, posts.childNodes[0]);
}

async function postPost(event) {
    event.preventDefault();

    let postType;
    if (document.querySelector('#text').checked) {
        postType = 'Post';
    } else if (document.querySelector('#poll').checked) {
        postType = 'Poll';
    } else if (document.querySelector('#file').checked) {
        postType = 'File';
    }

    if (postContent.value === "") return;

    let requestBody = {
        content: postContent.value,
        type: postType
    }

    let event_id = document.querySelector('.submit-post').dataset.id;

    const response = await request(
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

    if (response.status === 201) {
        postContent.value = "";
        insertPost(createPost(response.data));
    }


}

export async function likePost(event) {
    let i = this.querySelector('i');
    let postId = this.dataset.id;
    let numberLikes = this.querySelector('span').textContent;
    let url = '/api/posts/' + postId + '/like';
    if (i.classList.contains('far')) {
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
            i.classList.replace('far', 'fas');
            this.querySelector('span').textContent++;
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
            i.classList.replace('fas', 'far');
            this.querySelector('span').textContent--;
        }
    }
}


postLikeBtns.forEach(button => {

    button.addEventListener('click', likePost.bind(button));
});