// console.error('Reloaded');

document.querySelector('#date-dropdown').addEventListener("click", (event) => {
	event.stopPropagation();
});

const startDateLabel = document.querySelector('#start-date-label');
const endDateLabel = document.querySelector('#end-date-label');

const startDateInput = document.querySelector('input[name="start_date"');
const endDateInput = document.querySelector('input[name="end_date"');

const datepicker = $('#date-dropdown').datepicker({
	language: 'en',
	minDate: new Date(),
	timepicker: true,
	toggleSelected: false,
	dateFormat: 'dd-mm-yy',
	dateTimeSeparator: ' at ',
	timeFormat: 'hh:ii',
	clearButton: true,
	range: true,
	onSelect: (date, dates, _y) => {
		if (date[0] && date[1]) {
			const split = date.split(',');
			startDateLabel.textContent = split[0];
			startDateInput.value = dates[0].toISOString();
			if (split[1]) {
				endDateLabel.textContent = split[1];
				endDateInput.value = dates[1].toISOString();
			}
		} else if (date[0]) {
			startDateLabel.textContent = date;
		}
	}
}).data('datepicker');

let oldDates = [];

if (startDateInput.value) {
	oldDates[0] = new Date(startDateInput.value);
} 
if (endDateInput.value) {
	oldDates[1] = new Date(endDateInput.value);
}

if (oldDates.length)
	datepicker.selectDate(oldDates);

datepicker.el.querySelector('span[data-action="clear"]').addEventListener('click', () => {
	startDateLabel.textContent = 'Start date';
	startDateInput.value = '';
	endDateLabel.textContent = 'End date';
	endDateInput.value = '';
});

document.querySelector('#photo').addEventListener('change', (event) => {
	const input = event.target;
	if (input.files && input.files[0]) {
		const imgEl = document.querySelector('#img');
		const reader = new FileReader();
		reader.onload = (e) => {
			imgEl.src = e.target.result;
		};
		reader.readAsDataURL(input.files[0]);
	}
});