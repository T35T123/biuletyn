(() => {

	const domain = window.location.href;

	setInterval(() => {
	
		axios.get(`${domain}?last_modification`).then(({data: {time}}) => {
		
			if(time != localStorage.getItem('last_modification')){
				
				localStorage.setItem('last_modification', time);

				window.location.reload(); 

			}

		});

	}, 5000);

})();
