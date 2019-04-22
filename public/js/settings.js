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

function request(url, request, handler) {
    fetch(url, request)
    .then(response => {
        return response.json();
    })
    .then(handler)
    .catch(error => {
        console.log(error);
    });
}

document.getElementById('profile-submit').addEventListener('click', () => {
    clearErrors(['name-errors', 'email-errors', 'username-errors', 'birthdate-errors']);

    let requestBody = {
        name: document.getElementById('nameInput').value,
        email: document.getElementById('emailInput').value,
        username: document.getElementById('usernameInput').value,
        birthdate: document.getElementById('dateofbirthInput').value
    }

    request(
        '/api/profile',
        {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestBody)
        },
        response => {
            if (response.errors) {
                if (response.errors.name) createErrors(response.errors.name, 'name-errors');
                if (response.errors.email) createErrors(response.errors.email, 'email-errors');
                if (response.errors.username) createErrors(response.errors.username, 'username-errors');
                if (response.errors.birthdate) createErrors(response.errors.birthdate, 'birthdate-errors');
                return;
            }
        }
    );
});

document.getElementById('password-submit').addEventListener('click', () => {
    clearErrors(['password-errors', 'new-password-errors']);

    let requestBody = {
        password: document.getElementById('passwordInput').value,
        new_password: document.getElementById('newpasswordInput').value,
        new_password_confirmation: document.getElementById('repeatpasswordInput').value
    }

    request(
        '/api/profile/password',
        {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestBody)
        },
        response => {
            if (response.errors) {
                if (response.errors.password) createErrors(response.errors.password, 'password-errors');
                if (response.errors.new_password) createErrors(response.errors.new_password, 'new-password-errors');
                return;
            }
        }
    );
});