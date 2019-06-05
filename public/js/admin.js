import {request} from "./requests.js";

let delete_buttons = document.querySelectorAll('#delete-report-btn');

let dismiss_buttons = document.querySelectorAll('#dismiss-report-btn');


delete_buttons.forEach(button => {
    button.addEventListener('click', async () => {
        let id = button.closest('.report-card').dataset.id;
        let type = button.closest('.report-card').dataset.type;

            let requestBody = {
                status: button.textContent,
                type: type,
                id: id
            };

            const response = await request(
                '/api/reports',
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

            if (response.status == 200) {
                button.closest('.col-6').classList.add('text-center');
                button.closest('.col-6').nextElementSibling.classList.add('d-none');
                button.removeAttribute('id');
                button.classList.remove('ban-btn');
                button.classList.add('baned-btn');
            }
    });
});




dismiss_buttons.forEach(button => {
    button.addEventListener('click', async () => {
        let id = button.closest('.report-card').dataset.id;
        let type = button.closest('.report-card').dataset.type;

            let requestBody = {
                status: button.textContent,
                type: type,
                id: id
            };

            const response = await request(
                '/api/reports',
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

            if (response.status == 200) {
                button.closest('.col-6').classList.add('text-center');
                button.closest('.col-6').previousElementSibling.classList.add('d-none');
                button.removeAttribute('id');
                button.classList.remove('diss-btn');
                button.classList.add('dissed-btn');

            }
    });
});
