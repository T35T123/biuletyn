(() => {


	const slides = [...$('.contests-slider>article')];

	let activeSlide;

	let speed = 5000;
	let delay = 10000;

	const initSlide = () => {

		activeSlide = 0;
		slides.forEach(s => {
			$(s).hide();
			modifyTransform(s, '0px', '100vh');
			modifyTransition(s, speed);
			$(s).css('position', 'relative')
		});

		modifyTransform($(slides[0]), '0px', '0px');
		$(slides[0]).show();

		setTimeout(() => {

			slideRight(slides[0]);

		}, delay);

	}

	const modifyTransform = (element, x, y) => $(element).css('transform', `translate(${x}, ${y})`);
	const modifyTransition = (element, speed) => $(element).css('transition', `transform ${speed}ms ease 0s`);


	const slideReset = slide => {

		$(slide).hide();
		modifyTransform(slide, '0px', '100vh');

		slide.setAttribute('state', 'reset');

	}

	const slideUp = slide => {

		$(slide).show();
		slide.setAttribute('state', 'active');

		modifyTransition(slide, speed);
		modifyTransform(slide, '0px', '0px');

	}

	const slideRight = slide => {

		modifyTransition(slide, speed);
		modifyTransform(slide, '100vh', '0px');

		slide.setAttribute('state', 'hiding');

		activeSlide = activeSlide < slides.length - 1 ? activeSlide+1 : 0;

	}

	$('.contests-slider>article').on('transitionend', function(){

		if(this.getAttribute('state') == 'active'){

			setTimeout(() => slideRight(this), delay);

		}

		if(this.getAttribute('state') == 'hiding'){
			
			slideReset(this);
			slideUp(slides[activeSlide]);

		}

	});

	if(slides.length > 1) initSlide();


})();
