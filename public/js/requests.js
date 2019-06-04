export function clearErrors(formId) {
    let form = document.querySelector(formId);
    form.querySelectorAll('.errors-container').forEach(errorContainer => {
        errorContainer.innerHTML = "";
    });
    form.querySelectorAll('input').forEach(input => {
        input.classList.remove('is-invalid');
    });
}

export function createErrors(errors, container) {
    errors.forEach(element => {
        let error = document.createElement('div');
        error.className = 'error';
        error.textContent = element;
        document.getElementById(container).appendChild(error);
    });
}

export async function request(url, request) {
    const response = await fetch(url, request);
    let status = response.status;
    const data = await response.json();
    return {
        'status': status,
        'data': data
    };
}

