const Progress = (() => {

	const lessons = [
		{start: 8, end: 8.45},
		{start: 8.5, end: 9.35},
		{start: 9.4, end: 10.25},
		{start: 10.35, end: 11.2},
		{start: 11.4, end: 12.25},
		{start: 12.35, end: 13.2},
		{start: 13.3, end: 14.15},
		{start: 14.2, end: 15.05},
		{start: 15.1, end:15.55}
	];

 const isLessonNow = time => {
	
		let minute, hour;
		
		if(!time){
			
			time = new Date();

			minute = time.getMinutes();
			hour = time.getHours();
		
		} else {

			minute = Math.round(time * 100) % 100;
			hour = time - (time * 100 % 100) / 100;

		}

		const timeForCalc = hour + minute/100;
		
		let isLesson = false;

		for(let i=0; i<lessons.length; i++){
		  
						let {start, end} = lessons[i];
						
					  if(timeForCalc >= start && timeForCalc < end){	
								isLesson = true;
								break;
						}

		}

	return isLesson;	

	}

	const calcProgressBarFreeSpace = () => {
	
		const progressBarFont = Number($('.time-progress').css('font-size').match('[0-9]+')[0]);
		const progressBarWidth = Number($('.time-progress').css('width').match('[0-9+]')[0]);

		const maxChars = Math.round(progressBarWidth/progressBarFont);

	
	}

	//setInterval(, 1000);

	return {
		isLessonNow
	}

})();

module.exports = Progress;
