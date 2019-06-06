import {request} from "./requests.js";


document.querySelectorAll('#pending .card.report-card').forEach(e => {
    const id = e.dataset.id;
    const type = e.dataset.type;
    e.querySelector('#pending button.ban-btn').addEventListener('click', () => updateReport(e, id, type, 'Accepted'));
    e.querySelector('#pending button.diss-btn').addEventListener('click', () => updateReport(e, id, type, 'Declined'));
});

async function updateReport(element, id, type, status) {
    const url = `/api/${type}s/reports/${id}`;
    const response = await request(
        url,
        {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({answer: status})
        }
    );

    console.log(response);
    if(response.status === 200) {
        updateVisual(element, status);
    }
}

function updateVisual(element, status) {
    element.classList.add('card-fade');
	const div = element.querySelector('.card-footer > div');
	while (div.firstChild) {
		div.firstChild.remove();
	}
	const newDiv = document.createElement('div');
	newDiv.classList.add(['col-6', 'text-center']);
	newDiv.innerHTML = `<p class="my-0 ${status === 'Accepted'? 'baned-btn' : 'dissed-btn'} text-uppercase">
		${status === 'Accepted'? 'Banned': 'Dismissed'}
		</p>`;
	div.appendChild(newDiv);
}

// let delete_buttons = document.querySelectorAll('#delete-report-btn');

// let dismiss_buttons = document.querySelectorAll('#dismiss-report-btn');

// let ban_user_buttons = document.querySelectorAll('#ban-user-btn');
// let ban_event_buttons = document.querySelectorAll('#ban-event-btn');


// ban_user_buttons.forEach(button => {
//     button.addEventListener('click', async () => {  
//         let user_id = button.closest('#content').dataset.id;
//         let url = '/api/users/'+user_id+'/ban';
//         const response = await request(
//             url,
//             {
//                 method: 'PUT',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                     'Accept': 'application/json'
//                 }
//             }
//         );
//         if(response.status == 200){
//             document.querySelector('.banned-alert').classList.remove('d-none');
//         }

// })});



// ban_event_buttons.forEach(button => {
//     button.addEventListener('click', async () => {
//         let event_id = button.closest('#content').dataset.id;
//         let url = '/api/events/'+event_id+'/ban';
//         const response = await request(
//             url,
//             {
//                 method: 'PUT',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                     'Accept': 'application/json'
//                 }
//             }
//         );
//         console.log(response);
//         if(response.status == 200){
//             document.querySelector('.banned-alert').classList.remove('d-none');
//         }

       

   
// })});


// delete_buttons.forEach(button => {
//     button.addEventListener('click', async () => {
//         let id = button.closest('.report-card').dataset.id;
//         let type = button.closest('.report-card').dataset.type;

//             let requestBody = {
//                 status: button.textContent,
//                 type: type,
//                 id: id
//             };

//             const response = await request(
//                 '/api/reports',
//                 {
//                     method: 'PUT',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                         'Accept': 'application/json'
//                     },
//                     body: JSON.stringify(requestBody)
//                 }
//             );

//             if (response.status == 200) {
//                 button.closest('.col-6').classList.add('text-center');
//                 button.closest('.col-6').nextElementSibling.classList.add('d-none');
//                 button.removeAttribute('id');
//                 button.classList.remove('ban-btn');
//                 button.classList.add('baned-btn');
//             }
//     });
// });




// dismiss_buttons.forEach(button => {
//     button.addEventListener('click', async () => {
//         let id = button.closest('.report-card').dataset.id;
//         let type = button.closest('.report-card').dataset.type;

//             let requestBody = {
//                 status: button.textContent,
//                 type: type,
//                 id: id
//             };

//             const response = await request(
//                 '/api/reports',
//                 {
//                     method: 'PUT',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                         'Accept': 'application/json'
//                     },
//                     body: JSON.stringify(requestBody)
//                 }
//             );

//             if (response.status == 200) {
//                 button.closest('.col-6').classList.add('text-center');
//                 button.closest('.col-6').previousElementSibling.classList.add('d-none');
//                 button.removeAttribute('id');
//                 button.classList.remove('diss-btn');
//                 button.classList.add('dissed-btn');

//             }
//     });
// });
