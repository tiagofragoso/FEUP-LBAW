import { request } from "./requests.js";
import { createPost } from "./posts.js";

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
        
    }
    else {
        const postActivity = createPostActivityCard(activity);
        document.getElementById('activity-container').appendChild(postActivity);
    }
}

function createPostActivityCard(activity) {
    console.log(activity);
    
    const postActivity = document.createElement('div');
    postActivity.className = 'col-12 mb-5';

    postActivity.innerHTML = `
        <div class="activity-message mb-2">
            <a href="users/${activity.author_id}" class="user-tag">@<span>${activity.author}</span></a> has posted on an event you joined.
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

    if (activity.type == 'Post') {
        postActivity.querySelector('.nested-post').appendChild(createPost(activity));
    }

    return postActivity;
}