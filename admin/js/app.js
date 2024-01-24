function fetchCall(resource, callBack, method = "GET") {
	const url = "./php/";
	fetch(url + resource, {
		method: method,
	})
		.then((res) => res.json())
		.then((data) => {
			callBack(data);
		})
		.catch((err) => console.log(err));
}
