import {request} from "./requests.js";


let acquireTicketBtn = document.querySelector('.acquire-ticket-btn');
acquireTicketBtn.addEventListener('click',async () => {
   let event_id = acquireTicketBtn.dataset.id;
   let price = acquireTicketBtn.closest('.modal-content').dataset.id;
   console.log(price);
   let url = '/api/events/'+event_id+'/tickets';

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
console.log(response);
if (response.status === 200) {
    
}

});