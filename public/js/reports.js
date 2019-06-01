
let report_user_btn = document.querySelectorAll("#report-user-btn");
let report_event_btn = document.querySelectorAll("#report-event-btn");

report_user_btn.forEach(button => {
    button.addEventListener('click', async () => { 
         
        let user_id = button.closest('#content').dataset.id;
        console.log(user_id);
        let url = '/api/users/'+user_id+'/report';

        const response = await request(
            url,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            }
        );
        if(response == 200){
            
        }

})});


report_event_btn.forEach(button => {
    button.addEventListener('click', async () => { 
         
        let event_id = button.closest('#content').dataset.id;
        let url = '/api/events/'+event_id+'/report';

        const response = await request(
            url,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            }
        );
        if(response == 200){
            
        }

})});
