(() => {


	const slides = [...$('.contests-slider>article')];

	let activeSlide;
	let activeSlideOffsetY = 0;

	let speed = 4000;
	let delay = 30000;

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

			if($(slides[0]).height() + activeSlideOffsetY > $('#contests').height()){
				
				activeSlideOffsetY -= $('#contests').height() - $('.contests-title > h1').height()
					- Number($('.contests-title > h1').css('padding').match('^[0-9]{2}')[0])*2 -10;
				setTimeout(() => slideUp(slides[0], activeSlideOffsetY), delay);

				console.log('offset: ', activeSlideOffsetY
									 );

			}	else {

					setTimeout(() => slideRight(slides[0], activeSlideOffsetY), delay);
			
			}

		}, delay);

	}

	const modifyTransform = (element, x, y) => $(element).css('transform', `translate(${x}, ${y})`);
	const modifyTransition = (element, speed) => $(element).css('transition', `transform ${speed}ms ease 0s`);


	const slideReset = slide => {

		$(slide).hide();
		modifyTransform(slide, '0px', '100vh');

		slide.setAttribute('state', 'reset');

	}

	const slideUp = (slide, offset=0) => {

		$(slide).show();
		slide.setAttribute('state', 'active');

		modifyTransition(slide, speed);
		modifyTransform(slide, '0px', `${offset}px`);

	}

	const slideRight = (slide, offsetY) => {

		modifyTransition(slide, speed);
		modifyTransform(slide, '100vh', `${offsetY}px`);

		slide.setAttribute('state', 'hiding');

		activeSlide = activeSlide < slides.length - 1 ? activeSlide+1 : 0;

	}

	$('.contests-slider>article').on('transitionend', function(){

		if(this.getAttribute('state') == 'active'){

			if($(this).height() + activeSlideOffsetY > $('#contests').height()){
				
				activeSlideOffsetY -= $('#contests').height() - $('.contests-title > h1').height()
					- Number($('.contests-title > h1').css('padding').match('^[0-9]{2}')[0])*2 -10;
				setTimeout(() => slideUp(this, activeSlideOffsetY), delay);

			}	else {

					setTimeout(() => slideRight(this, activeSlideOffsetY), delay);
			
			}

		}

		if(this.getAttribute('state') == 'hiding'){
			
			slideReset(this);
			activeSlideOffsetY = 0;
			slideUp(slides[activeSlide]);

		}

	});

	if(slides.length > 1) initSlide();


})();
