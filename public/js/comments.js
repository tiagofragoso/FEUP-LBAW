import {request} from "./requests.js";

let commentLikeBtns = document.querySelectorAll('.like-comment-btn');

console.log(commentLikeBtns);

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