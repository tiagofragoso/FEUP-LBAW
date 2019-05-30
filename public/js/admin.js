async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

let delete_buttons = document.querySelectorAll('#delete-report-btn');

let dismiss_buttons = document.querySelectorAll('#dismiss-report-btn');

let delete_event = document.querySelectorAll('#ban-event-btn');


delete_event.forEach(button => {
    button.addEventListener('click', async () => {
        let event_id = button.closest('#content').dataset.id;
        let url = '/api/events/'+event_id+'/ban';
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
        if(response == 200){
            button.closest('#content').firstChild.nextElementSibling.classList.remove('d-none');
        }

       

   
})});


delete_buttons.forEach(button => {
    button.addEventListener('click', async () => {
        let reports = JSON.parse(button.closest('.report-card').dataset.id);

        for (let report of reports) {

            let url = 'api/reports/' + report['id'];
            let type;
            let id;
            if (report.hasOwnProperty('event_id')) {
                type = 'event';
                id = report['event_id'];
            }
            else {
                type = 'user';
                id = report['reported_user'];
            }

            let requestBody = {
                status: button.textContent,
                type: type,
                id: id
            };

            const response = await request(
                url,
                {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                }
            );
            if (response == 200) {
                button.closest('.col-6').classList.add('text-center');
                button.closest('.col-6').nextElementSibling.classList.add('d-none');
                button.removeAttribute('id');
                button.classList.remove('ban-btn');
                button.classList.add('baned-btn');
            }
        }
    });
});




dismiss_buttons.forEach(button => {
    button.addEventListener('click', async () => {
        let reports = JSON.parse(button.closest('.report-card').dataset.id);

        for (let report of reports) {

            let url = 'api/reports/' + report['id'];
            let type;
            let id;
            if (report.hasOwnProperty('event_id')) {
                type = 'event';
                id = report['event_id'];
            }
            else {
                type = 'user';
                id = report['reported_user'];
            }


            let requestBody = {
                status: button.textContent,
                type: type,
                id: id
            };

            const response = await request(
                url,
                {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                }
            );
            if (response == 200) {
                button.closest('.col-6').classList.add('text-center');
                button.closest('.col-6').previousElementSibling.classList.add('d-none');
                button.removeAttribute('id');
                button.classList.remove('diss-btn');
                button.classList.add('dissed-btn');

            }
        }
    });
});
