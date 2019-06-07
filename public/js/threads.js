import {request} from "./requests.js";

let threadContent = document.querySelector('#threadTextarea');

function insertThread(thread) {
    let threads = document.querySelector('.threads-list');
    threads.insertBefore(thread, threads.childNodes[0]);
}

function createThread(response) {
    const thread = document.createElement('div');
    thread.className = 'thread-wrapper';
    thread.innerHTML = 
    `<div class="row justify-content-center">
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
                                        <strong>thread</strong>.
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
                    <button type="button" data-toggle="collapse" data-target="#comments${response.id}" aria-expanded="false"
                        aria-controls="collapseExample" class="side-button btn btn-light w-100 h-100 flex-grow-2">
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-comment-alt"></i>
                        </div>
                    </button>
                </div>
            </div>
            <div class="row comment-section comment-section-threads collapse mb-3 border-top border-light pt-3" id="comments${response.id}" data-id="${response.id}">
                <div class="dropdown-divider col-12 col-md-10 mx-auto mt-2 mb-3"></div>
                <div class="row col-12 justify-content-center align-items-center">
                    <div class="col-12 col-md-10 d-flex flex-row align-items-center">
                        <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3"
                            width="30" height="30" />
                        <form class="position-relative w-100" action="#">
                            <textarea class="form-control position-relative w-100 pr-5"
                                rows="1" placeholder="Reply to this thread..." style="resize: none"></textarea>
                            <div
                                class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
                                <button class="submit-btn" type="submit">
                                    <i class="fas fa-angle-double-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `

    thread.querySelector('.card-text.mt-3').textContent = response.content;
    let section = thread.querySelector('.comment-section-threads');
    let button = section.querySelector('.submit-btn');

    let context = {};

    context.content = section.querySelector('textarea');
    context.thread_id = section.dataset.id;
    context.divider = section;

    button.addEventListener('click', commentHandler.bind(context));

    return thread;

}

function createThreadComment(response) {
    const comment = document.createElement('div');
    comment.className = 'row col-12 comment align-items-start justify-content-center';
    comment.innerHTML = `
    <div class="col-12 col-md-10 d-flex flex-row">
        <a href="/users/${response.user_id}">
        <img src="../assets/user.svg"
            class="rounded-circle rounded-circle border border-light mr-3"
            width="30" height="30" />
        </a>
        <div class="w-100 d-flex flex-column">
            <div class="comment-wrapper d-flex flex-column w-100">
                <div class="comment-text px-3 py-2">
                    <span>
                        <a class="title-link mr-2" href="/users/${response.user_id}">
                        <span class=" author">${response.user}</span>
                        </a>
                        <span>
                        <span>
                    </span>
                </div>
                <div class="comment-footer ml-3">                
                    <span>${response.date}</span>
                </div>
            </div>
        </div>
    </div>
    `

    comment.querySelector('span span').textContent = response.content;
    return comment;

}

if (threadContent !== null) {
    let button = document.querySelector('.submit-thread-button');
    button.addEventListener('click', async () => {
        event.preventDefault();

        if (threadContent.value === "") return;

        let requestBody = {
            content: threadContent.value
        }

        let event_id = button.dataset.id;

        const response = await request(
            '/api/events/' + event_id + '/threads',
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

        if (response.status === 201) {
            threadContent.value = "";
            insertThread(createThread(response.data))
        }
    })
}

let commentsSections = document.querySelectorAll('.comment-section-threads');

commentsSections.forEach(section => {
    let button = section.querySelector('.submit-btn');

    let context = {};

    context.content = section.querySelector('textarea');
    context.thread_id = section.dataset.id;
    context.divider = section;

    button.addEventListener('click', commentHandler.bind(context));
})

async function commentHandler(event) {
    event.preventDefault();

    if (this.content.value === "") return;

    let requestBody = {
        content : this.content.value
    }

    const response = await request (
        '/api/threads/' + this.thread_id + '/comments',
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

    if (response.status === 201) {
        this.content.value = "";
        let comment = createThreadComment(response.data);
        this.divider.insertBefore(comment, this.divider.querySelector('.dropdown-divider'));
    }
}