import { request } from "./requests.js";
import { createActivityEventCard } from "./activity_event_card.js";
import { postComment } from "./comments.js";
import { likePost } from "./posts.js";

let page = 2;
let requesting = false;

/**
 * Infinite scrolling
 */
document.addEventListener('scroll', () => {
    if ((($(document).height()-$(window).height())-$(window).scrollTop() < 5) && !requesting) {
        getActivity();
    }
});

async function getActivity() {
    requesting = true;
    const response = await request('/api/feed?page='+page, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    });

    if (response.status == 200) {
        Object.values(response.data).forEach(activity => {
            createActivityCard(activity);
        });

        if (Object.keys(response.data).length > 0)
            page++;
    }

    requesting = false;
}

function createActivityCard(activity) {
    if (activity.type === 'Owner' || activity.type === 'Participant' || activity.type === 'Host') {
        const participationActivity = createParticipationActivity(activity);
        document.getElementById('activity-container').appendChild(participationActivity);
    }
    else {
        const postActivity = createPostActivityCard(activity);
        document.getElementById('activity-container').appendChild(postActivity);
    }
}

function createParticipationActivity(activity) {
    const participationActivity = document.createElement('div');
    participationActivity.className = 'col-12 mb-5';

    participationActivity.innerHTML = `
        <div class="activity-message mb-2">
            @if (Auth::user()->id == $participation->user_id)
            You have 
            @else
            <a href="{{ url('users/'.$participation->user_id) }}" class="user-tag">@<span>{{ $participation->username }}</span></a> has 
            @endif
            @if ($participation->type == 'Owner')
            created an event.
            @elseif ($participation->type == 'Participant')
            joined an event.
            @elseif ($participation->type == 'Host')
            started hosting an event
            @endif
        </div>

        <div class="nested-event-card"></div>
    `;

    if (activity.user_id == self)
        participationActivity.querySelector('.activity-message').innerHTML = 'You have ';
    else {
        participationActivity.querySelector('.activity-message').innerHTML = `
            <a href="users/${activity.user_id}" class="user-tag">@<span class="username"></span></a> has
        `;
        participationActivity.querySelector('.activity-message .username').textContent = activity.username;
    }

    if (activity.type == 'Owner')
        participationActivity.querySelector('.activity-message').innerHTML += 'created an event.';
    else if (activity.type == 'Host')
        participationActivity.querySelector('.activity-message').innerHTML += 'started hosting an event.';
    else if (activity.type == 'Participant')
        participationActivity.querySelector('.activity-message').innerHTML += 'joined an event.';

    participationActivity.querySelector('.nested-event-card').appendChild(createActivityEventCard(activity));

    return participationActivity;
}

function createPostActivityCard(activity) {
    const postActivity = document.createElement('div');
    postActivity.className = 'col-12 mb-5';

    postActivity.innerHTML = `
        <div class="activity-message mb-2">
            <a href="users/${activity.author_id}" class="user-tag">@<span>${activity.username}</span></a> has posted on an event you joined.
        </div>

        <div class="card container-fluid hover-shadow" tabindex="-1">
            <div class="row post-card-header align-items-center">
                <div class="col-12">
                    <a href="events/${activity.event_id}">
                        <h5 class="mb-0 event-title px-0 px-md-3"></h5>
                    </a>
                </div>
            </div>

            <div class="nested-post"></div>
        </div>
    `;

    postActivity.querySelector('.event-title').textContent = activity.event_title;

    activity.date = moment(new Date(activity.date)).format('MMM DD | HH:mm')
    postActivity.querySelector('.nested-post').appendChild(createActivityPost(activity));

    return postActivity;
}

function createActivityPost(activity) {
    const post = document.createElement('div');
    post.className = 'post-wrapper';
    post.dataset.id = activity.id;
    post.innerHTML =` 
        <div class="row justify-content-center">
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
                                            <a href="/users/${activity.author_id}" class="badge badge-secondary author-name"></a>
                                            created a
                                            <strong>post</strong>.
                                        </p>
                                        <span class="post-date text-muted"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text mt-3 post-content"></p>
                            <div class="extra-content"></div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
                        <button type="button" class="btn btn-light w-100 h-100 flex-grow-2 like-post-btn" data-id="${activity.id}">
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="far fa-thumbs-up"></i>
                                <span class="likes-container"></span>
                            </div>
                        </button>
                        <button type="button" data-toggle="collapse" data-target="#comments${activity.id}"
                            aria-expanded="false" 
                            class="side-button btn btn-light w-100 h-100 flex-grow-2">
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="far fa-comment-alt"></i>
                                <span class="comments-container"></span>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="row comment-section comment-section-posts collapse mb-3 border-top border-light pt-3" id="comments${activity.id}" data-id="${activity.id}">
                    <div class="col-12" id="comments-list${activity.id}">
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
        </div>
    `;

    post.querySelector('.author-name').textContent = activity.author_name;
    post.querySelector('.post-date').textContent = activity.date;
    post.querySelector('.post-content').textContent = activity.content;
    post.querySelector('.likes-container').textContent = activity.likes;
    post.querySelector('.comments-container').textContent = activity.comments;

    if (activity.type == 'Poll') {
        post.querySelector('.extra-content').appendChild(createPollContent(activity.id, activity.poll_title, activity.poll_options));
    }
    else if (activity.type == 'File') {
        post.querySelector('.extra-content').appendChild(createFileContent(activity.post_file));
    }

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

function createPollContent(id, title, pollOptions) {
    const pollContent = document.createElement('div');
    pollContent.innerHTML = `
        <p class="card-text mt-3">
            <strong class="poll-title"></strong>
        </p>
        <div class="container poll-container" data-id="${id}">
        </div>
    `;

    pollContent.querySelector('.poll-title').textContent = title;

    pollOptions.forEach(pollOption => {
        pollContent.querySelector('.poll-container').appendChild(createPollOption(id, pollOption));
    });

    const info = document.createElement('div');
    info.className = 'text-danger d-none poll-error-message';
    info.textContent = 'To vote on an event\'s poll, you need to participate in the event!';
    pollContent.querySelector('.poll-container').appendChild(info);

    return pollContent;
}

function createPollOption(post_id, pollOption) {
    const pollOptionContainer = document.createElement('div');
    pollOptionContainer.className = 'row align-items-center mb-2';
    pollOptionContainer.dataset.id = pollOption.id;
    pollOptionContainer.innerHTML = `
        <div class="input-group col-12 col-sm-8">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="poll${post_id}" aria-label="">
                </div>
            </div>
            <span type="text" class="form-control option-name"></span>
        </div>
        <div
            class="col-12 col-sm-4 ml-5 ml-sm-0 mt-1 mt-sm-0 text-muted" id="pollVotes" data-id="${pollOption.votes}">
            ${pollOption.votes} votes
        </div>
    `;

    pollOptionContainer.querySelector('.option-name').textContent = pollOption.name;
    pollOptionContainer.querySelector('input').checked = pollOption.voted;

    return pollOptionContainer;
}

function createFileContent(file) {
    const fileContainer = document.createElement('a');
    fileContainer.href = '#';
    fileContainer.className = 'card-text mt-3 title-link';
    fileContainer.innerHTML = `
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="far fa-file-alt"></i></span>
            </div>
            <div class="form-control"> <strong class="file-name"></strong> </div>
        </div>
    `;
    fileContainer.querySelector('.file-name').textContent = file.file;
    return fileContainer;
}