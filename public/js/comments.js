let commentLikeBtns = document.querySelectorAll('#like-comment-btn');

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