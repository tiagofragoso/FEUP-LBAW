function clearErrors(errors) {
    errors.forEach(id => {
        document.getElementById(id).innerHTML = "";
    });
}

function createErrors(errors, container) {
    errors.forEach(element => {
        let error = document.createElement('div');
        error.className = "error";
        error.textContent = element;
        document.getElementById(container).appendChild(error);
    });
}

async function request(url, request) {
    const response = await fetch(url, request);
    const data = await response.json();
    return data;
}

document.getElementById('profile-submit').addEventListener('click', async () => {
    clearErrors(['name-errors', 'email-errors', 'username-errors', 'birthdate-errors']);
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
        if (response.errors.name) createErrors(response.errors.name, 'name-errors');
        if (response.errors.email) createErrors(response.errors.email, 'email-errors');
        if (response.errors.username) createErrors(response.errors.username, 'username-errors');
        if (response.errors.birthdate) createErrors(response.errors.birthdate, 'birthdate-errors');
        return;
    }

    document.getElementById('general-message').classList.remove('d-none');
    document.querySelector('.user-name').textContent = requestBody.name;
    document.querySelector('.username').textContent = requestBody.username;
});

document.getElementById('password-submit').addEventListener('click', async () => {
    clearErrors(['password-errors', 'new-password-errors']);
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
        if (response.errors.password) createErrors(response.errors.password, 'password-errors');
        if (response.errors.new_password) createErrors(response.errors.new_password, 'new-password-errors');
        return;
    }

    document.getElementById('password-message').classList.remove('d-none');
    document.getElementById('passwordInput').value = "";
    document.getElementById('newpasswordInput').value = "";
    document.getElementById('repeatpasswordInput').value = "";
});