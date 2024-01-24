document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", requestNewPro);
document.addEventListener("DOMContentLoaded", requestTestimonials);
document.addEventListener("DOMContentLoaded", requestHeroPros);

function requestHeroPros() {
	fetchCall("heropros.php", responseHeroPros);
	function responseHeroPros(data) {
		if (data.hero) {
			const heroCardSection = document.querySelector(".hero-cards");
			populateHeroPros(data.hero, heroCardSection);
		}
	}
}

function requestFeatPro() {
	fetchCall("featured.php", responseFeatPro);
	function responseFeatPro(data) {
		if (data.featured) {
			const featureSection = document.getElementById("toppro");
			const topproCard = document.querySelector(".toppro-cards");
			const topslider = document.querySelector(".topslider");
			populatePros(data.featured, featureSection, topproCard, topslider);
		}
	}
}

function requestNewPro() {
	fetchCall("newpro.php", responseNewPro);
	function responseNewPro(data) {
		if (data.newpro) {
			const newSection = document.getElementById("newpro");
			const newproCard = document.querySelector(".newpro-cards");
			const newslider = document.querySelector(".newslider");
			populatePros(data.newpro, newSection, newproCard, newslider);
		}
	}
}

function requestTestimonials() {
	fetchCall("testimonials.php", responseTestimonial);
	function responseTestimonial(data) {
		if (data.testimonies) {
			const testimonialCards =
				document.querySelector(".testimonial-cards");
			testimonies = data.testimonies;
			testimonies.forEach((prod) => {
				const testimonialCard1 = document.createElement("div");
				testimonialCard1.className = "testimonial-card1";

				const testimonialTitle = document.createElement("div");
				testimonialTitle.className = "testimonial-title";

				const testimonialPic = document.createElement("div");
				testimonialPic.className = "testimonial-image-bg";
				const testimonialactualPic = document.createElement("img");
				testimonialactualPic.src = `http://localhost:8080${prod.image}`;
				testimonialPic.append(testimonialactualPic);

				const testimonialName = document.createElement("div");
				testimonialName.className = "testimonial-name";
				const testh4 = document.createElement("h4");
				testh4.textContent = prod.name;
				testimonialName.append(testh4);

				const testimonialDesc = document.createElement("div");
				testimonialDesc.className = "testimonial-desc";
				const testdescP = document.createElement("p");
				testdescP.textContent = prod.desc;
				testimonialDesc.append(testdescP);

				testimonialTitle.append(testimonialPic);
				testimonialTitle.append(testimonialName);
				testimonialCard1.append(testimonialTitle);
				testimonialCard1.append(testimonialDesc);

				testimonialCards.append(testimonialCard1);
			});
		}
	}
}
