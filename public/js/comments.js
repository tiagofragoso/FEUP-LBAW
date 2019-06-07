import {request} from "./requests.js";

let commentLikeBtns = document.querySelectorAll('.like-comment-btn');
let commentSections = document.querySelectorAll('.comment-section-posts');
let childSections = document.querySelectorAll('.child-comment-form'); 

childSections.forEach(section => {

    let button = section.querySelector('.submit-child-comment');
    let context = {};

    context.content = section.querySelector('textarea');
    context.comment_id = section.dataset.id;
    context.post_id = section.closest('.post-wrapper').dataset.id;
    context.divider = section;

    button.addEventListener('click', postChild.bind(context));
});

async function postChild(event) {
    event.preventDefault();

    if (this.content.value === "") return;

    let requestBody = {
        content: this.content.value,
        parent: this.comment_id
    }

    const response = await request(
        '/api/posts/' + this.post_id + '/comments',
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
        this.content.value = "";
        this.divider.parentNode.insertBefore(createChild(response.data), this.divider);
    }
    
}

commentSections.forEach(section => {

    let button = section.querySelector('.submit-comment');
    let context = {};

    context.content = section.querySelector('.textarea-parent');
    context.post_id = section.dataset.id;
    context.divider = section;


    button.addEventListener('click', postComment.bind(context));

});


export async function postComment(event) {

    event.preventDefault();

    if (this.content.value === "") return;

    let requestBody = {
        content: this.content.value,
        parent: null
    }

    const response = await request(
        '/api/posts/' + this.post_id + '/comments',
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
        this.content.value = "";
       this.divider.insertBefore(createComment(response.data), this.divider.querySelector('.dropdown-divider'));
    }
}

function createChild(response) {
    const comment = document.createElement('div');
    comment.className = 'pl-1 mt-3 align-items-start d-flex flex-row';
    comment.innerHTML = `
    <a href="/users/${response.user_id}">
        <img src="${response.photo?  response.photo: '/assets/user.svg'}" class="rounded-circle rounded-circle border border-light mr-3" width="30" height="30" />
    </a>
    <div class="comment-wrapper d-flex flex-column w-100" data-id ="${response.id}">
        <div class="comment-text px-3 py-2">
            <span>
                <a class="title-link mr-2" href="/users/${response.user_id}">
                    <span class=" author">${response.user}</span>
                </a>
                <span>
                </span>
            </span>
        </div>
        <div class="comment-footer ml-3">
            <span id="numberLikes"> 0 </span>
            <span> likes </span>
            •
            <button class="bg-transparent border-0 like-comment-btn" >
               Like
        </button>
            •
            <span>${response.date}</span>
        </div>
    </div>
    `;

    comment.querySelector('span span').textContent = response.content;
    let button = comment.querySelector('.like-comment-btn');
    button.addEventListener('click', commentLikes.bind(button));

    return comment;

}


function createComment(response) {
    const comment = document.createElement('div');
    comment.className = 'row col-12 comment align-items-start justify-content-center';
    comment.innerHTML = `
    <div class="row col-12 comment align-items-start justify-content-center">
        <div class="col-12 col-md-10 d-flex flex-row">
            <a href="/users/${response.user_id}">
                <img src="${response.photo? response.photo: '/assets/user.svg'}" class="rounded-circle rounded-circle border border-light mr-3" width="30" height="30" />
            </a>
            <div class="w-100 d-flex flex-column mb-2">
                <div class="comment-wrapper d-flex flex-column w-100" data-id="${response.id}">
                    <div class="comment-text px-3 py-2">
                        <span>
                            <a class="title-link mr-2" href=""/users/${response.user_id}"">
                                <span class=" author">${response.user}</span>
                            </a>
                            <span>                        
                            </span>
                        </span>
                    </div>
                    <div class="comment-footer ml-3">
                        <span class="numberLikes"> 0 </span>
                        <span> likes </span>
                        •
                        <button class="bg-transparent border-0 like-comment-btn">
                            Like
                        </button>
                        •
                        <button class="bg-transparent border-0 reply-comment-btn" type="button" data-toggle="collapse" data-target="#childcomments${response.id}"
                                aria-expanded="false" aria-controls="collapseExample">
                            Reply
                        </button>
                        •
                        <span>${response.date}</span>
                    </div>
                </div>
                    <div class="col-12 mt-3 justify-content-center align-items-center child-comment-form collapse" id="childcomments${response.id}" data-id="${response.id}">                
                        <div class="col-12 d-flex flex-row align-items-center">
                            <img src="${document.querySelector('#navbar-pic').getAttribute('src')}" class="rounded-circle rounded-circle border border-light mr-3"
                                width="30" height="30" />
                            <form class="position-relative w-100" action="#">
                                <textarea class="form-control position-relative w-100 pr-5" rows="1"
                                placeholder="Replying to ${response.user}" style="resize: none"></textarea>
                                <div
                                    class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
                                    <button class="submit-btn submit-child-comment" type="submit">
                                        <i class="fas fa-angle-double-right submit-comment-btn"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
     </div>`;


    comment.querySelector('span span').textContent = response.content;

    let button = comment.querySelector('.like-comment-btn');
    button.addEventListener('click', commentLikes.bind(button));

    let section = comment.querySelector('.child-comment-form');
    button = section.querySelector('.submit-child-comment');
    let context = {};

    context.content = section.querySelector('textarea');
    context.comment_id = section.dataset.id;
    context.post_id = response.post_id;
    context.divider = section;

    button.addEventListener('click', postChild.bind(context));

    return comment;
}

async function commentLikes(event) {

    let comment_id = this.closest('.comment-wrapper').dataset.id;
        let url = '/api/comments/' + comment_id + '/like';
        if (this.textContent.trim() === 'Like') {
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

            console.log(response)
            if (response.status === 200) {
                this.textContent = 'Liked';
                this.closest('.comment-footer').querySelector('span').textContent++;
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
            console.log(response)
            if (response.status === 200) {
                this.textContent = 'Like';
                this.closest('.comment-footer').querySelector('span').textContent--;
                
            }
        }

}

commentLikeBtns.forEach(button => {
    button.addEventListener('click', commentLikes.bind(button));
});