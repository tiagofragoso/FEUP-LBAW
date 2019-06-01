
let report_user_btn = document.querySelectorAll("#report-user-btn");


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
        console.log("response "+response);
        if(response == 200){
            
        }

})});
