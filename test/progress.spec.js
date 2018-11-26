const {expect} = require('chai');

const {isLessonNow} = require('../js/progress');

describe('Progress bar test', () => {

	it('Should return lesson', () => {
		
		const hours = [
						8,
						8.3,
						8.55,
						9.2,
						9.34,
						9.40,
						10,
						10.24,
						10.35,
						11.1,
						11.4,
						12,
						12.35,
						12.59,
						13.30,
						13.59,
						14.20,
						14.59,
						15.10,
						15.3,
						15.54
			];

			hours.forEach(h => {
				expect(isLessonNow(h)).to.equal(true);						 
			});

	});

	it('Should return break', () => {
		
		const hours = [
			8.45,
			8.49,
			9.35,
			9.39,
			10.25,
			10.34,
			11.20,
			11.39,
			12.25,
			12.34,
			13.20,
			13.29,
			14.15,
			14.19,
			15.05,
			15.09
		];
	
		hours.forEach(h => {
			expect(isLessonNow(h)).to.equal(false);
		});

	});

});
