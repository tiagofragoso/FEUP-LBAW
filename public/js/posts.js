import { request } from "./requests.js";
import { postComment } from "./comments.js"

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





function createPost(response) {
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
                                            ${response.author}
                                        </a>
                                        ${response.type !== 'File'? 'created a' : 'uploaded a'}
                                        <strong>${response.type.toLowerCase()}</strong>.
                                    </p>
                                    <span class="post-date text-muted">
                                       ${response.date}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="post-content card-text mt-3">
                            ${response.content}
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

async function likePost(event) {
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


function createFile(response) {

    const post = createPost(response);

    const el = document.createElement('a');
    el.setAttribute('href', '/storage/' + response.file);
    el.setAttribute('download', response.fileName);
    el.classList.add('card-text', 'mt-3', 'title-link');
    el.innerHTML = `<div class="input-group mb-3">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="far fa-file-alt"></i></span>
    </div>
    <div class="form-control font-weight-bold">
    </div>
    </div>`;
    el.querySelector('.form-control').appendChild(document.createTextNode(response.fileName));
    post.querySelector('.post-content').parentNode.appendChild(el);

    return post;
}

function createPoll(response) {
    const post = createPost(response);
    const p = document.createElement('p');
    p.classList.add('card-text', 'mt-3', 'font-weight-bold');
    p.textContent = response.title;
    const div = document.createElement('div');
    div.classList.add('container', 'poll-container');
    div.setAttribute('data-id', response.id);
    const pollOptions = JSON.parse(response.poll_options);
    for (let o of pollOptions) {
        const optDiv = document.createElement('div');
        optDiv.classList.add('row', 'align-items-center', 'mb-2');
        optDiv.setAttribute('data-id', o.id);
        optDiv.innerHTML = `<div class="input-group col-12 col-sm-8">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="radio"
                    aria-label="">
            </div>
        </div>
        <span class="form-control"></span>
    </div>
    <div
        class="col-12 col-sm-4 ml-5 ml-sm-0 mt-1 mt-sm-0 text-muted" id="pollVotes" data-id="0">
        0 votes
    </div>
    <div class="text-danger d-none poll-error-message">To vote on an event's poll, you need to participate in the event!</div>
    `;
        optDiv.querySelector('input[type="radio"]').setAttribute('name', response.id);
        optDiv.querySelector('span.form-control').textContent = o.name;
        div.appendChild(optDiv);
    }
    post.querySelector('.post-content').parentNode.appendChild(p);
    post.querySelector('.post-content').parentNode.appendChild(div);
    
    return post;
}

postLikeBtns.forEach(button => {
    button.addEventListener('click', likePost.bind(button));
});

if (document.querySelector('.post-type')) {
    const postTypeTitle = document.querySelector('#posts .card-title');
    const pollWrapper = document.querySelector('#poll-wrapper');
    const fileWrapper = document.querySelector('#file-wrapper');

    document.querySelector('.submit-post').addEventListener('click', (e) => makePost(e));

    document.querySelectorAll('.post-type input[type="radio"][name="post-type"]').forEach(el => el.addEventListener('change', () => changeTab(el.getAttribute('value'))));
    pollWrapper.querySelectorAll('.poll-option-input .poll-option-close-btn').forEach(el => el.addEventListener('click', () => tryToRemove(el)));
    const addPollOption = pollWrapper.querySelector('.add-poll-option .poll-option-close-btn');
    addPollOption.addEventListener('click', () => insertPollOption());
    const fileInput = fileWrapper.querySelector('#file-input');
    fileInput.addEventListener('change', () => uploadedFile());

    function changeTab(value) {
        switch (value) {
            case 'text':
                postTypeTitle.textContent = 'Create a post';
                showPost();
                break;
            case 'poll':
                postTypeTitle.textContent = 'Create a poll';
                showPoll();
                break;
            case 'file':
                postTypeTitle.textContent = 'Upload a file';
                showFile();
                break;
        }
        document.querySelector('.post-error').classList.add('d-none');
    }

    function showPost() {
        fileWrapper.classList.add('d-none');
        pollWrapper.classList.add('d-none');
    }

    function showPoll() {
        pollWrapper.classList.remove('d-none');
        fileWrapper.classList.add('d-none');
    }

    function showFile() {
        fileWrapper.classList.remove('d-none');
        pollWrapper.classList.add('d-none');
    }

    function tryToRemove(element) {
        const l = pollWrapper.querySelectorAll('.poll-option-input').length;
        if (l > 2) {
            const input = element.parentNode;
            input.remove();
        }
    }

    function insertPollOption() {
        const ref = addPollOption.parentNode;
        pollWrapper.insertBefore(getNewPollOption(), ref);
    }

    function getNewPollOption() {
        const el = document.createElement('div');
        el.classList.add('poll-option-input', 'col-12', 'col-sm-8', 'mt-2', 'position-relative');
        el.innerHTML = `<button class="btn poll-option-close-btn position-absolute ml-2"><i class="fas fa-times"></i></button>
    <input class="form-control pl-5" type="text" placeholder="Option" maxlength="30">`;
        el.querySelector('button').addEventListener('click', () => tryToRemove(el.firstChild));
        return el;
    }

    function uploadedFile() {
        const file = fileInput.files[0];
        if (file) {
            const el = fileWrapper.querySelector('#uploaded-file');
            if (el) {
                el.querySelector('span:last-of-type').textContent = file.name;
            } else {
                const newEl = createFileEl(file.name);
                fileWrapper.querySelector('div').insertBefore(newEl, fileWrapper.querySelector('label[for="file-input"]'));
            }
            fileWrapper.querySelector('label[for="file-input"] > span:last-of-type').textContent = 'Upload another file';
        } else {
            const el = fileWrapper.querySelector('#uploaded-file');
            if (el) {
                el.remove();
            } 
            fileWrapper.querySelector('label[for="file-input"] > span:last-of-type').textContent = 'Upload a file';
        }
    }

    function createFileEl(name) {
        const el = document.createElement('div');
        el.setAttribute('id', 'uploaded-file');
        el.classList.add('d-flex', 'flex-row', 'align-items-center', 'mb-2');
        el.innerHTML = `<span class="btn poll-option-close-btn ml-2"><i class="fas fa-file-alt"></i></span>`;
        const sp = document.createElement('span');
        sp.classList.add('ml-3');
        sp.textContent = name;
        el.appendChild(sp);
        return el;
    }

    async function makePost(event) {
        event.preventDefault();
        document.querySelector('.post-error').classList.add('d-none');
        const content = postContent.value.trim();

        if (content == '') {
            showError('Post content can\'t be empty');
            return;
        }

        let postType;
        if (document.querySelector('#text').checked) {
            postType = 'Post';
        } else if (document.querySelector('#poll').checked) {
            postType = 'Poll';
        } else if (document.querySelector('#file').checked) {
            postType = 'File';
        }

        const formData = new FormData();
        formData.append('type', postType);
        formData.append('content', content);

        if (postType === 'Poll') {
            const title = pollWrapper.querySelector('input[name="title"]');
            if (title.value.trim() != '') {
                formData.append('title', title.value.trim());
            } else {
                showError('Post content can\'t be empty');
                return;
            }
            let validOptions = [];
            pollWrapper.querySelectorAll('.poll-option-input').forEach(el => {
                const input = el.querySelector('input').value.trim();
                if (input != '')
                    validOptions.push(input);
            });
            if (validOptions.length >= 2) {
                formData.append('poll_options', JSON.stringify(validOptions));
            } else {
                showError('Add at least 2 valid options');
                return;
            }
        } else if (postType === 'File') {
            const file = fileInput.files[0];
            if (file) {
                formData.append('file', file);
            } else {
                showError('File upload error');
                return;
            }
        }

        let event_id = document.querySelector('.submit-post').dataset.id;

        const response = await request(
            '/api/events/' + event_id + '/posts',
            {
                method: 'POST',
                headers: {
                    //'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            }
        );
        console.log(response);
        if (response.status === 201) {
            switch (response.data.type) {
                case 'Post':
                    insertPost(createPost(response.data));
                    break;
                case 'Poll':
                    insertPost(createPoll(response.data));
                    break;
                case 'File':
                    insertPost(createFile(response.data));
                    break;
            }
            resetForm();
        } else {
            if (response.data instanceof String) {
                showError(response.data);
            } else {
                showError('Error submiting post');
            }
        }
    }
    
    function resetForm() {
        document.querySelector('.post-error').classList.add('d-none');
        postContent.value = "";
        pollWrapper.querySelector('input[name="title"]').value = "";
        let opts = pollWrapper.querySelectorAll('.poll-option-input');
        while (opts.length > 2) {
            opts[0].remove();
            opts = pollWrapper.querySelectorAll('.poll-option-input');
        }
        opts.forEach(e => e.querySelector('input').value = "");
        fileInput.value = "";
        uploadedFile();
    }

    function showError(message) {
        document.querySelector('.post-error').classList.remove('d-none');
        document.querySelector('.post-error').textContent = message;
    }

}

