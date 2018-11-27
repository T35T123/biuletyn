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

 const numberToTime = num => {
	
			minute = Math.round(num * 100) % 100;
			hour = num - (num * 100 % 100) / 100;

			return {hour, minute};

 }

 const getTimeForCalc = time => {

		let minute, hour;
		
		if(!time){
			
			time = new Date();

			minute = time.getMinutes();
			hour = time.getHours();
		
		} else {

			let {hour: h, minute: m} = numberToTime(time);
			hour = h;
			minute = m;

		}

		return hour + minute/100;
 
 }

 const isLessonNow = time => {
	
		const timeForCalc = getTimeForCalc(time);
		
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

	const getIntervals = time => {
		
		const timeForCalc = getTimeForCalc(time);

		for(let i=0; i<lessons.length; i++){
		  
			let {start,end} = lessons[i];

			if(timeForCalc >= start && timeForCalc < end){
			
				return {start, end};

			}else if(timeForCalc >= end && timeForCalc < lessons[i+1].start){
				
				return {
					start: end,
					end: lessons[i+1].start
				};

			}

		}
	

	}

	setInterval(() => {
		
		let {start, end} = getIntervals();
					
		$('.time-interval--current_state').text(`Trwa ${ isLessonNow() ? 'lekcja' : 'przerwa' }`);

		let {hour: startHour, minute: startMinute} = numberToTime(start);
		let {hour: endHour, minute: endMinute} = numberToTime(end);

		$('.time-interval--begin').text(`${startHour}:${startMinute}`);
		$('.time-interval--end').text(`${endHour}:${endMinute}`);

	}, 1000);

	return {
		numberToTime,
		getTimeForCalc,
		getIntervals,
		isLessonNow
	}

})();

module.exports = Progress;
