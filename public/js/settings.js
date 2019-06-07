import { clearErrors, createErrors, request } from "./requests.js";



document.getElementById('delete-account-btn').addEventListener('click',async() =>{
    const response = await request(
        '/api/profile/delete',
        {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        }
    );
    console.log(response);
    if(response.status == 200){
        console.log(document.getElementById('delete-account-btn'));
        document.getElementById('delete-account-btn').setAttribute("href","{{ url('/logout')}}");

    }

    

});
document.getElementById('profile-submit').addEventListener('click', async () => {
    clearErrors('.form-group-general');
    document.getElementById('general-message').classList.add('d-none');

    let requestBody = {
        name: document.getElementById('nameInput').value,
        email: document.getElementById('emailInput').value,
        username: document.getElementById('usernameInput').value,
        birthdate: document.getElementById('dateofbirthInput').value
    }

    const response = await request(
        '/api/profile',
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

    if (response.data.errors) {
        if (response.data.errors.name) {
            document.getElementById('nameInput').classList.add('is-invalid');
            createErrors(response.data.errors.name, 'name-errors');
        }
        if (response.data.errors.email) {
            document.getElementById('emailInput').classList.add('is-invalid');
            createErrors(response.data.errors.email, 'email-errors');
        }
        if (response.data.errors.username) {
            document.getElementById('usernameInput').classList.add('is-invalid');
            createErrors(response.data.errors.username, 'username-errors');
        }
        if (response.data.errors.birthdate) {
            document.getElementById('dateofbirthInput').classList.add('is-invalid');
            createErrors(response.data.errors.birthdate, 'birthdate-errors');
        }
        return;
    }

    document.getElementById('general-message').classList.remove('d-none');
    document.querySelector('.user-name').textContent = requestBody.name;
    document.querySelector('.username').textContent = requestBody.username;
});

document.getElementById('password-submit').addEventListener('click', async () => {
    clearErrors('.form-group-pass');
    document.getElementById('password-message').classList.add('d-none');

    let requestBody = {
        password: document.getElementById('passwordInput').value,
        new_password: document.getElementById('newpasswordInput').value,
        new_password_confirmation: document.getElementById('repeatpasswordInput').value
    }

    const response = await request(
        '/api/profile/password',
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

    if (response.data.errors) {
        if (response.data.errors.password) {
            document.getElementById('passwordInput').classList.add('is-invalid');
            createErrors(response.data.errors.password, 'password-errors');
        }
        if (response.data.errors.new_password) {
            document.getElementById('newpasswordInput').classList.add('is-invalid');
            createErrors(response.data.errors.new_password, 'new-password-errors');
        }
        return;
    }

    document.getElementById('password-message').classList.remove('d-none');
    document.getElementById('passwordInput').value = "";
    document.getElementById('newpasswordInput').value = "";
    document.getElementById('repeatpasswordInput').value = "";
});

const input = document.querySelector('#photo-input');
input.addEventListener('change', async () => {
    const file = input.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('photo', file);
        const response = await request(
            '/api/profile/photo',
            {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            }
        );
        console.log(response);
        if (response.status === 200) {
            document.querySelector('#upload-result').textContent = 'Uploaded successfuly';
            document.querySelector('#upload-result').className = 'text-success';
            const path = response.data.path;
            document.querySelector('#navbar-pic').setAttribute('src', '/storage/'+path);
            document.querySelector('#user-pic').setAttribute('src', '/storage/'+path);
        } else {
            document.querySelector('#upload-result').textContent = 'Error uploading file';
            document.querySelector('#upload-result').className = 'text-dange';
        }
    }
});