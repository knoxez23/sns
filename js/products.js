document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", setLocationLoaded);
const prodetailscartincramount = document.getElementById("prod-incr-cart-amnt");
const prodetailscartdecramount = document.getElementById("prod-decr-cart-amnt");
const prodetailswishlistadd = document.getElementById("prod-wishlist-add");
const prodetailsamountcart = document.getElementById("prod-amount-cart");
const prodetailscartadd = document.getElementById("prod-cart-add");
const shoesize = document.getElementById("shoe-size");
const alertSize = document.querySelector(".alert-size");

const proURL = window.location.search;
const urlParams = new URLSearchParams(proURL);

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}
fetchCall(
	`productdetails.php?prodid=${urlParams.get("getsearch")}`,
	responseProduct
);
function responseProduct(data) {
	const product = data.product[0];
	fetchCall(`category.php?catid=${product.category_id}`, responseCategory);
	function responseCategory(data) {
		const proCategoryPath = document.getElementById("pro-category-path");
		proCategoryPath.textContent = data.name;
		if (data.name == "Men's") {
			proCategoryPath.href = "mens.php";
		} else if (data.name == "Women's") {
			proCategoryPath.href = "womens.php";
		} else if (data.name == "Kids") {
			proCategoryPath.href = "kids.php";
		} else if (data.name == "Sale") {
			proCategoryPath.href = "sale.php";
		} else if (data.name == "Collection") {
			proCategoryPath.href = "collection.php";
		}
	}

	const proNamePath = document.getElementById("pro-name-path");
	proNamePath.textContent = product.name;

	const proFullName = document.querySelector(".pro-full-title");
	proFullName.innerHTML = ``;
	const h1 = document.createElement("h1");
	const proBrand = document.createElement("span");
	proBrand.className = "brand";
	proBrand.textContent = product.brand;
	h1.append(proBrand);
	const proName = document.createElement("span");
	proName.className = "prod-name";
	proName.textContent = product.name;
	h1.append(proName);
	proFullName.append(h1);

	const proPagePrice = document.querySelector(".pro-page-price");
	proPagePrice.innerHTML = ``;
	const currentProPrice = document.createElement("h4");
	currentProPrice.textContent = "Ksh. " + product.price;
	// const prevProPrice = document.createElement("strike");
	// prevProPrice.textContent = "Ksh. " + product.prevprice;
	proPagePrice.append(currentProPrice);
	// proPagePrice.append(prevProPrice);

	const shortDesc = document.querySelector(".short-desc");
	shortDesc.innerHTML = ``;
	const shorth3 = document.createElement("h3");
	shorth3.textContent = product.shortdesc;
	shortDesc.append(shorth3);

	const proReportStock = document.querySelector(".stock-report");
	proReportStock.innerHTML = ``;
	const stockReport = document.createElement("div");
	if (product.stock > 10) {
		stockReport.className = "btn-instock";
		stockReport.textContent = "InStock";
	} else if (product.stock <= 10 && product.stock > 0) {
		stockReport.className = "btn-soldout";
		stockReport.textContent = "Only " + product.stock + " remaining";
	} else {
		stockReport.className = "btn-soldout";
		stockReport.textContent = "SoldOut";
	}
	proReportStock.append(stockReport);
	document.title = product.name.toUpperCase();

	const ShoeFullImage = document.querySelector(".shoe-full-image");
	ShoeFullImage.innerHTML = ``;
	const FullProdImage = document.createElement("img");
	FullProdImage.className = "full-prod-image";
	FullProdImage.src = product.image;
	FullProdImage.alt = product.name;
	ShoeFullImage.append(FullProdImage);

	const shoeSmallDisplay = document.querySelector(".shoe-small-display");
	shoeSmallDisplay.innerHTML = ``;

	// Create and append the first small shoe image
	const shoeSmall1 = document.createElement("div");
	shoeSmall1.innerHTML = ``;
	shoeSmall1.classList.add("shoe-small1");
	const shoeSmall1Img = document.createElement("img");
	shoeSmall1Img.className = "shoesmall1";
	shoeSmall1Img.src = product.image;
	shoeSmall1Img.alt = product.name;
	shoeSmall1.setAttribute(
		"onclick",
		`changeImage(document.querySelector(".shoesmall1"))`
	);
	shoeSmall1.append(shoeSmall1Img);

	shoeSmallDisplay.appendChild(shoeSmall1);

	// Check if the second small shoe image is set
	if (product.smallimg1 != null) {
		// Create and append the second small shoe image
		const shoeSmall2 = document.createElement("div");
		shoeSmall2.innerHTML = ``;
		shoeSmall2.className = "shoe-small1";
		const shoeSmall2Img = document.createElement("img");
		shoeSmall2Img.className = "shoesmall2";
		shoeSmall2Img.src = product.smallimg1;
		shoeSmall2Img.alt = product.name;
		shoeSmall2.setAttribute(
			"onclick",
			`changeImage(document.querySelector(".shoesmall2"))`
		);
		shoeSmall2.append(shoeSmall2Img);

		shoeSmallDisplay.appendChild(shoeSmall2);
	}


	const proFullDescription = document.querySelector(".pro-specs-content");
	const descriptionP = document.createElement("p");
	descriptionP.textContent = product.fulldesc;
	proFullDescription.append(descriptionP);
}

let newwamount = 1;

prodetailscartincramount.addEventListener("click", () => {
	newwamount = newwamount + 1;
	prodetailsamountcart.textContent = newwamount;
});

prodetailscartdecramount.addEventListener("click", () => {
	if (newwamount > 1) {
		newwamount = newwamount - 1;
		prodetailsamountcart.textContent = newwamount;
	}
});

prodetailswishlistadd.addEventListener("click", () => {
	const proURL = window.location.search;
	const urlParams = new URLSearchParams(proURL);

	fetchCall(
		`productdetails.php?prodid=${urlParams.get("getsearch")}`,
		responseProductDetails
	);
	function responseProductDetails(data) {
		const thes = data.product[0];
		let WItem = wishlist.find(
			(wishlistItem) => wishlistItem.id === thes.id
		);
		if (!WItem) {
			product = {
				id: thes.id,
				amount: 1,
				size: actualSize,
				price: thes.price,
			};
			wishlist = [...wishlist, product];
		}

		displayWishlistItemCount();
		setStorageItem("wishlist", wishlist);
	}
});

function increaseAmountt(id) {
	let newAmount;
	cart = cart.map((cartItem) => {
		if (cartItem.id === id) {
			newAmount = cartItem.amount + newwamount;
			cartItem = { ...cartItem, amount: newAmount };
		}
		return cartItem;
	});
	return newAmount;
}

prodetailscartadd.addEventListener("click", () => {
	if (shoesize.value == "") {
		alertSize.style.display = "block";
	} else {
		alertSize.style.display = "none";
		const proURL = window.location.search;
		const urlParams = new URLSearchParams(proURL);

		fetchCall(
			`productdetails.php?prodid=${urlParams.get("getsearch")}`,
			responseProductDetails
		);
		function responseProductDetails(data) {
			const thes = data.product[0];
			let Item = cart.find((cartItem) => cartItem.id === thes.id);
			if (!Item) {
				prod = {
					id: thes.id,
					amount: newwamount,
					size: shoesize.value,
					price: thes.price,
				};
				cart = [...cart, prod];
				addtoCartDOM(thes.id, prod);
			}

			displayCartItemCount();
			displayCartTotal();
			setStorageItem("cart", cart);
			setStorageItem("checkout", cart);
		}
	}
});

const specs = document.querySelectorAll(".pro-specs-title");
specs.forEach((spec) => {
	spec.addEventListener("click", () => {
		spec.classList.toggle("active");

		const specContent = spec.nextElementSibling;
		if (spec.classList.contains("active")) {
			specContent.style.maxHeight = specContent.scrollHeight + "px";
		} else specContent.style.maxHeight = 0;
	});
});
