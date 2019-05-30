import { clearErrors, createErrors, request } from "./requests.js";

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

    if (response.errors) {
        if (response.errors.name) {
            document.getElementById('nameInput').classList.add('is-invalid');
            createErrors(response.errors.name, 'name-errors');
        }
        if (response.errors.email) {
            document.getElementById('emailInput').classList.add('is-invalid');
            createErrors(response.errors.email, 'email-errors');
        }
        if (response.errors.username) {
            document.getElementById('usernameInput').classList.add('is-invalid');
            createErrors(response.errors.username, 'username-errors');
        }
        if (response.errors.birthdate) {
            document.getElementById('dateofbirthInput').classList.add('is-invalid');
            createErrors(response.errors.birthdate, 'birthdate-errors');
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

    if (response.errors) {
        if (response.errors.password) {
            document.getElementById('passwordInput').classList.add('is-invalid');
            createErrors(response.errors.password, 'password-errors');
        }
        if (response.errors.new_password) {
            document.getElementById('newpasswordInput').classList.add('is-invalid');
            createErrors(response.errors.new_password, 'new-password-errors');
        }
        return;
    }

    document.getElementById('password-message').classList.remove('d-none');
    document.getElementById('passwordInput').value = "";
    document.getElementById('newpasswordInput').value = "";
    document.getElementById('repeatpasswordInput').value = "";
});