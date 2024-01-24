document.addEventListener("DOMContentLoaded", requestHeroPros);
document.addEventListener("DOMContentLoaded", requestTestimonials);
document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", setLocationLoaded);

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

function populateHeroPros(products, peroCard) {
	if (products) {
		products.forEach((prod) => {
			const card = document.createElement("div");
			card.classList.add("hero-card1");
			card.addEventListener("click", getProDetails.bind(prod));

			const imgDiv = document.createElement("div");
			imgDiv.className = "card-img-bg";
			const theImg = document.createElement("img");
			theImg.src = `${prod.image}`;
			imgDiv.append(theImg);

			const proName = document.createElement("div");
			proName.className = "card-name";
			const name = document.createElement("h6");
			name.textContent = prod.name;
			const currentPrice = document.createElement("h3");
			currentPrice.className = "hero-card-price";
			currentPrice.textContent = `Ksh. ${prod.price}`;
			proName.append(name);
			proName.append(currentPrice);

			const sale = document.createElement("div");
			sale.className = "hero-card-sale";
			sale.textContent = "sale";

			card.append(imgDiv);
			card.append(proName);
			card.append(sale);

			peroCard.append(card);
		});
	}
}

function requestHeroPros() {
	fetchCall("heropros.php", responseHeroPros);
	function responseHeroPros(data) {
		if (data.hero) {
			const heroCardSection = document.querySelector(".hero-cards");
			populateHeroPros(data.hero, heroCardSection);
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
			testimonies.forEach((testimony) => {
				const testimonialCard1 = document.createElement("div");
				testimonialCard1.className = "testimonial-card1";

				const testimonialTitle = document.createElement("div");
				testimonialTitle.className = "testimonial-title";

				const testimonialName = document.createElement("div");
				testimonialName.className = "testimonial-name";
				const testh4 = document.createElement("h4");
				testh4.textContent = testimony.name;
				testimonialName.append(testh4);

				const testimonialDesc = document.createElement("div");
				testimonialDesc.className = "testimonial-desc";
				const testdescP = document.createElement("p");
				testdescP.textContent = testimony.desc;
				testimonialDesc.append(testdescP);

				testimonialTitle.append(testimonialName);
				testimonialCard1.append(testimonialTitle);
				testimonialCard1.append(testimonialDesc);

				testimonialCards.append(testimonialCard1);
			});
		}
	}
}
