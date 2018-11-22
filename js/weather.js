const fetchWeather = () => {

	axios
		.get('http://api.openweathermap.org/data/2.5/weather?q=Grudzi%C4%85dz,pl&appid=26a46156bdb0abc12e10bdd1ffad81d6')
		.then(res => {

			const {weather: [{icon}], main: {temp: t, humidity: h, pressure: p}} = res.data;

			weather_icon.src = `http://openweathermap.org/img/w/${icon}.png`;
			temperature.innerHTML = `${Math.round((t - 273) * 10) / 10}&degc`;
			humidity.innerHTML = h;
			pressure.innerHTML = p;

		});

}

document.addEventListener('DOMContentLoaded', () => {

	fetchWeather();

});