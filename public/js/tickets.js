import { request } from "./requests.js";


let acquireTicketBtn = document.querySelector('.acquire-ticket-btn');
acquireTicketBtn.addEventListener('click', async () => {

    let event_id = acquireTicketBtn.dataset.id;
    let price = acquireTicketBtn.closest('.modal-content').dataset.id;
    console.log(price);
    let url = '/api/events/' + event_id + '/tickets';
   

    let requestBody = { price: price }
    const response = await request(
        url,
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
    if (response.status === 200) {

        acquireTicketBtn.closest('.modal-content').querySelector('.modal-body').innerText = 'Ticket acquired with success!';
        acquireTicketBtn.classList.add('d-none');
        acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').innerText = 'Close';
        acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').classList.replace('btn-danger','btn-primary');
    } else if (response.status === 403){
        
        acquireTicketBtn.closest('.modal-content').querySelector('.modal-body').innerText = 'You have to join the event before you buy a ticket!';
        acquireTicketBtn.classList.add('d-none');
        acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').innerText = 'Close';
        acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').classList.replace('btn-danger','btn-primary');

        $('#acquireTicketModal').on('hidden.bs.modal', function (e) {
            acquireTicketBtn.classList.remove('d-none');
            acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').classList.replace('btn-primary','btn-danger');
            acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').innerText = 'Cancel';
            acquireTicketBtn.closest('.modal-content').querySelector('.modal-body').innerText = 'Price: ' + response.data.price;
          })

    } else if (response.status === 422) {
        acquireTicketBtn.closest('.modal-content').querySelector('.modal-body').innerText = 'You have already acquired a ticket to this event!';
        acquireTicketBtn.classList.add('d-none');
        acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').innerText = 'Close';
        acquireTicketBtn.closest('.modal-footer').querySelector('.cancel-btn').classList.replace('btn-danger','btn-primary');
    }
});
