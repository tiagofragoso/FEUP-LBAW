// console.error('Reloaded');

// const startDatepicker = $('#start_date').datepicker({
// 	language: 'en',
// 	minDate: new Date(),
// 	timepicker: true,
// 	dateFormat: 'dd-mm-yy',
// 	timeFormat: 'hh:ii',
// 	clearButton: true,
// 	onSelect: (_x, date, _y) => {
// 		if (endDatepicker.date < date) {
// 			endDatepicker.selectDate(date);
// 		}
// 		endDatepicker.update('minDate', date);
// 	}
// }).data('datepicker');

// const endDatepicker = $('#end_date').datepicker({
// 	language: 'en',
// 	minDate: new Date(),
// 	timepicker: true,
// 	dateFormat: 'dd-mm-yy',
// 	timeFormat: 'hh:ii',
// 	clearButton: true
// }).data('datepicker');

// const oldStartdate = document.querySelector('#start_date').dataset.oldValue;
// const oldEnddate = document.querySelector('#end_date').dataset.oldValue;

// console.log(oldStartdate, oldEnddate);

// if (oldStartdate) {
// 	startDatepicker.selectDate(new Date(oldStartdate));
// }

// if (oldEnddate) {
// 	endDatepicker.selectDate(new Date(oldEnddate));
// }

document.querySelector('#photo').addEventListener('change', (event) => {
	const input = event.target;
	if (input.files && input.files[0]) {
		const imgEl = document.querySelector('#img');
		const reader = new FileReader();
		reader.onload = (e) => {
			imgEl.src = e.target.result;
			/*
			new Cropper(imgEl, {
				viewMode: 3,
				aspectRatio: 16 / 9,
				crop(event) {
					console.log(event.detail.x);
					console.log(event.detail.y);
					console.log(event.detail.width);
					console.log(event.detail.height);
					console.log(event.detail.rotate);
					console.log(event.detail.scaleX);
					console.log(event.detail.scaleY);
				}
			});
			*/
		};
		reader.readAsDataURL(input.files[0]);
	}
});