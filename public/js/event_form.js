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