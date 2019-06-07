import {request} from './requests.js';

let questions = document.querySelectorAll('.unanswered-question');

function createQuestion(response) {
    const question = document.createElement('li');
    question.className = 'list-group-item';
    question.innerHTML = `
    <a class="pl-0 text-decoration-none qa-question dropdown-toggle" data-toggle="collapse" href="#" role="button" data-target="#question${response.question_id}" aria-expanded="false" aria-controls="collapseExample">
    </a>
    <div class="collapse" id="question${response.question_id}">
    <p class="text-muted">
    </p>
    </div>
    `
    question.querySelector('a').textContent = response.question;
    question.querySelector('p').textContent = response.content;
    return question;
}

function insertQuestion(question) {
    let answeredQuestions = document.querySelector('.answered-questions-list');
    answeredQuestions.insertBefore(question, answeredQuestions.childNodes[0]);
}

questions.forEach(question => {

    let button = question.querySelector('.answer-button');
    let textarea = question.querySelector('textarea');
    let questionText = question.querySelector('.qa-question');

    button.addEventListener('click', async () => {
        event.preventDefault();
        let question_id = button.dataset.id;

        let requestBody = {
            content: textarea.value,
        }

        const response = await request (
            '/api/questions/' + question_id + '/answer',
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

        if (response.status === 201) {
            response.data['question'] = questionText.textContent;
            question.remove();
            document.querySelector('.nAnswered').textContent++;
            document.querySelector('.nUnanswered').textContent--;
            insertQuestion(createQuestion(response.data));
        }
    });

});