(() => {

	const domain = "/";

	setInterval(() => {
	
		axios.get(`${domain}?last_modification`).then(({data: {time}}) => {
		
			if(time != localStorage.getItem('last_modification')){
				
				localStorage.setItem('last_modification', time);

				window.location = domain; 

			}

		});

	}, 5000);

})();
