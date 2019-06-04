async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

let postContent = document.querySelector('#postFormTextarea');

let pollOptions = document.querySelectorAll("input[type=radio][name=poll]");
let selectedOption = document.querySelector("input[type=radio][name=poll]:checked").closest('.row');

pollOptions.forEach(option => {
    let option_id = option.closest('.row').dataset.id;
    let post_id = option.closest('.container').dataset.id;
    option.addEventListener('click', async () => {
        let url = '/api/polls/'+post_id+'/votes/'+option_id;
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
        console.log(response);
        if (response == 200){
            let numberVotes = option.closest('.row').childNodes[3].dataset.id++;
            option.closest('.row').childNodes[3].innerText = numberVotes + " votes";
            console.log(option.closest('.row').childNodes[3].textContent);
            if (selectedOption !== null){
            selectedOption.removeAttribute('checked');
            selectedOption.closest('.row').childNodes[3].innerText = option.closest('.row').childNodes[3].dataset.id-- + " votes";
            }
        }
       

    })});


if (postContent !== null) {
    document.querySelector('.submit-post').addEventListener('click', postPost);
}

function createPost(response) {
    const post = document.createElement('div');
    post.className = 'post-wrapper';
    post.innerHTML = 
    ` <div class="row justify-content-center">
        <div class="card col-12 col-lg-9 mb-4 hover-shadow">
            <div class="row">
                <div class="col-12 col-md-10">
                    <div class="py-3 px-0 px-md-3 w-100">
                        <div class="row">
                            <div class="col-12 d-flex flex-row">
                                <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-2"
                                    width="30" height="30" />
                                <div class="d-flex flex-column">
                                    <p class="card-text mb-0">
                                        <a href="/users/${response.author_id}" class="badge badge-secondary">
                                            ${response.author}
                                        </a>
                                        created a
                                        <strong>post</strong>
                                    </p>
                                    <span class="post-date text-muted">
                                        ${response.date}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="card-text mt-3">
                            ${response.content}
                        </p>
                    </div>
                </div>
                <div
                    class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
                    <button type="button" class="btn btn-light w-100 h-100 flex-grow-2">
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-thumbs-up"></i>
                            <span>0</span>
                        </div>
                    </button>
                    <button type="button" data-toggle="collapse" data-target="#comments${response.id}" aria-expanded="false"
                        aria-controls="collapseExample" class="side-button btn btn-light w-100 h-100 flex-grow-2">
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-comment-alt"></i>
                            <span>0</span>
                        </div>
                    </button>
                </div>
            </div>
            <div class="row comment-section collapse mb-3 border-top border-light" id="comments${response.id}">
                <div class="row col-12 mt-3 justify-content-center align-items-center">
                    <div class="col-12 col-md-10 d-flex flex-row align-items-center">
                        <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3"
                            width="30" height="30" />
                        <form class="position-relative w-100" action="#">
                            <textarea class="form-control position-relative w-100 pr-5"å
                                rows="1" placeholder="Write a comment..." style="resize: none"></textarea>
                            <div
                                class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
                                <button class="submit-btn" type="submit">
                                    <i class="fas fa-angle-double-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown-divider col-12 col-md-10 mx-auto my-3"></div>
            </div>
        </div>
    </div>`;
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

    if (!response.errors) {
        console.log(response);
        postContent.value = "";
        insertPost(createPost(response));
    }

   
}