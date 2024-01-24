document.addEventListener("DOMContentLoaded", init);
document.addEventListener("DOMContentLoaded", displayWishlistItemCount);
const bttmCatalogSection = document.querySelector(".bottom-catalog-section");
const miniCartOverlay = document.getElementById("mini-cart-overlay");
const miniCart = document.getElementById("mini-cart");
const emptyCartMessage = document.querySelector(".no-pros-cart-empty-mesage");
const miniCartDomContents = document.querySelector(".mini-cart-top-products");
const cartItemCountDOM = document.querySelector(".cart-qty");
const wishlistCountDOM = document.querySelector(".wishlist-qty");
const cartTotal = document.getElementById("cart-total-amount");
const minicartTotal = document.getElementById("mini-cart-total");
const body = document.querySelector(".wrapper");
const newssucc = document.getElementById("news-succ");
const newserr = document.getElementById("news-err");
let lastScroll = 0;
document.addEventListener('DOMContentLoaded', function () {
	var filterIcon = document.getElementById('filter-icon');
	var filtersAside = document.querySelector('.left-section');

	filterIcon.addEventListener('click', function () {
		filtersAside.classList.toggle('show-filters');
		filtersAside.classList.toggle('floating-filters');
	});
});

function goToAccountPage() {
	window.location.href = "account.php";
}

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

const emptyMiniCartMessage = document.querySelector(
	".no-pros-minicart-message"
);

const formatPrice = (price) => {
	let formattedPrice = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",
	}).format((price / 100).toFixed(2));
	return formattedPrice;
};

const getStorageItem = (item) => {
	let storageItem = sessionStorage.getItem(item);
	if (storageItem) {
		storageItem = JSON.parse(sessionStorage.getItem(item));
	} else {
		storageItem = [];
	}
	return storageItem;
};

const setStorageItem = (name, item) => {
	sessionStorage.setItem(name, JSON.stringify(item));
};

let cart = getStorageItem("cart");
let checkout = getStorageItem("checkout");
let wishlist = getStorageItem("wishlist");

function init() {
	displayCartItemCount();
	displayWishlistItemCount();
}

function increaseAmount(id) {
	let newAmount;
	cart = cart.map((cartItem) => {
		if (cartItem.id === id) {
			newAmount = cartItem.amount + 1;
			cartItem = { ...cartItem, amount: newAmount };
		}
		return cartItem;
	});
	return newAmount;
}

function decreaseAmount(id) {
	let newAmount;
	cart = cart.map((cartItem) => {
		if (cartItem.id === id) {
			if (cartItem.amount != 1) {
				newAmount = cartItem.amount - 1;
				cartItem = { ...cartItem, amount: newAmount };
			} else {
				newAmount = 1;
				cartItem = { ...cartItem, amount: newAmount };
			}
		}
		return cartItem;
	});
	return newAmount;
}

function removeItem(id) {
	cart = cart.filter((cartItem) => cartItem.id != id);
	checkout = checkout.filter((checkoutItem) => checkoutItem.id != id);
}

function addToCart() {
	let Item = cart.find((cartItem) => cartItem.id === this.id);
	if (!Item) {
		product = { id: this.id, amount: 1, price: this.price };
		cart = [...cart, product];
		addtoCartDOM(this.id, product);
	} else {
		const amount = increaseAmount(this.id);
		const items = [
			...miniCartDomContents.querySelectorAll(".cart-item-amount"),
		];
		const newAmount = items.find((value) => value.dataset.id === this.id);
		newAmount.textContent = amount;
	}

	displayCartItemCount();
	displayCartTotal();
	setStorageItem("cart", cart);
	setStorageItem("checkout", cart);
}

function displayCartItemCount() {
	const amount = cart.reduce((total, cartItem) => {
		return (total += cartItem.amount);
	}, 0);
	cartItemCountDOM.textContent = amount;
}

function displayWishlistItemCount() {
	const amount = wishlist.reduce((total, wishlistItem) => {
		return (total += wishlistItem.amount);
	}, 0);
	wishlistCountDOM.textContent = amount;
}

function addToWishlist() {
	let WItem = wishlist.find((wishlistItem) => wishlistItem.id === this.id);
	if (!WItem) {
		product = { id: this.id, amount: 1, price: this.price };
		wishlist = [...wishlist, product];
	}

	displayWishlistItemCount();
	setStorageItem("wishlist", wishlist);
}

$(document).ready(function () {
	$("#search").click(function () {
		var search = $("#search-input").val();
		window.location.href = "search.php?q=" + search;
	});
});

window.addEventListener("scroll", () => {
	const currentScroll = window.pageYOffset;

	if (currentScroll <= 0) {
		body.classList.remove("scroll-up");
	}

	if (currentScroll > lastScroll && !body.classList.contains("scroll-down")) {
		body.classList.remove("scroll-up");
		body.classList.add("scroll-down");
	}

	if (currentScroll < lastScroll && body.classList.contains("scroll-down")) {
		body.classList.remove("scroll-down");
		body.classList.add("scroll-up");
	}

	lastScroll = currentScroll;
});

const newsletteremailsubmit = document.getElementById(
	"newsletter-email-submit"
);

newsletteremailsubmit.addEventListener("click", () => {
	const newletteremailvalue = document.getElementById(
		"newletter-email-value"
	).value;
	if (newletteremailvalue === "") {
		console.log("No");
	} else {
		$.ajax({
			url: "./php/newsletter.php",
			type: "POST",
			data: { email: newletteremailvalue },
			success: function (data) {
				if (data == "Success") {
					newssucc.style.display = "block";
					setTimeout(() => {
						newssucc.style.display = "none";
					}, 2000);
				} else {
					newserr.style.display = "block";
					setTimeout(() => {
						newserr.style.display = "none";
					}, 2000);
				}
			},
		});
	}
});

function populateCatalogue(products, catalogueParent) {
	if (products) {
		const catalogue = document.createElement("div");
		catalogue.className = "catalog-products";

		products.forEach((product) => {
			const prodCard = document.createElement("div");
			prodCard.className = "productcard";

			const prodImage = document.createElement("div");
			prodImage.className = "productimg";
			prodImage.addEventListener("click", getProDetails.bind(product));
			const proActualImg = document.createElement("img");
			proActualImg.src = `${product.image}`;
			prodImage.append(proActualImg);

			const prodDetails = document.createElement("div");
			prodDetails.className = "prodetails";
			const prodTitlePrice = document.createElement("div");
			prodTitlePrice.className = "productTitlePrice";
			const brand = document.createElement("div");
			brand.className = "brand";
			brand.textContent = product.brand;
			const protitle = document.createElement("div");
			protitle.className = "title";
			protitle.textContent = product.name;
			protitle.addEventListener("click", getProDetails.bind(product));
			const catprice = document.createElement("div");
			catprice.className = "price";
			catprice.textContent = `Ksh. ${product.price}`;
			const addcart = document.createElement("div");
			addcart.className = "btn-addtocart";
			addcart.textContent = "Add to Cart";
			addcart.addEventListener("click", addToCart.bind(product));

			prodTitlePrice.append(brand);
			prodTitlePrice.append(protitle);
			prodTitlePrice.append(catprice);
			prodDetails.append(prodTitlePrice);
			prodDetails.append(addcart);

			const favBtn = document.createElement("button");
			favBtn.className = "favorite";
			favBtn.addEventListener("click", addToWishlist.bind(product));
			favBtn.innerHTML = "<i class = 'fa-regular fa-heart'></i>";

			prodCard.append(prodImage);
			prodCard.append(prodDetails);
			prodCard.append(favBtn);

			catalogue.append(prodCard);
		});
		catalogueParent.append(catalogue);
	}
}

function populatePros(products, proCard) {
	if (products) {
		products.forEach((prod) => {
			const card = document.createElement("div");
			card.classList.add("product", "swiper-slide");

			const cardImg = document.createElement("div");
			cardImg.className = "card-image-bg";
			cardImg.addEventListener("click", getProDetails.bind(prod));
			const theImg = document.createElement("img");
			theImg.src = prod.image;
			theImg.alt = prod.name;
			cardImg.append(theImg);

			const favori = document.createElement("div");
			favori.className = "pro-like";
			favori.addEventListener("click", addToWishlist.bind(prod));
			const like = document.createElement("i");
			like.className = "fa-regular fa-heart";
			like.style.color = "#fff";
			favori.append(like);

			const proName = document.createElement("div");
			proName.className = "pro-title";
			const name = document.createElement("h4");
			name.textContent = prod.name;
			proName.append(name);

			const proPrice = document.createElement("div");
			proPrice.className = "pro-price";
			const currentPrice = document.createElement("h4");
			currentPrice.textContent = `Ksh. ${prod.price}`;
			// const prevPrice = document.createElement("h4");
			// const strikth = document.createElement("strike");
			// strikth.textContent = `Ksh. ${prod.prevprice}`;
			// prevPrice.append(strikth);
			proPrice.append(currentPrice);
			// proPrice.append(prevPrice);

			const addCart = document.createElement("div");
			addCart.className = "pro-add-to-cart";
			const cartBtn = document.createElement("button");
			cartBtn.className = "btn-addtocart";
			cartBtn.textContent = "Add to Cart";
			cartBtn.addEventListener("click", addToCart.bind(prod));
			addCart.append(cartBtn);

			card.append(cardImg);
			card.append(favori);
			card.append(proName);
			card.append(proPrice);
			card.append(addCart);

			proCard.append(card);
		});
	}
}

function pagination(querySet, page, pros) {
	var trimStart = (page - 1) * pros;
	var trimEnd = trimStart + pros;
	var trimmedData = querySet.slice(trimStart, trimEnd);
	var pages = Math.ceil(querySet.length / pros);

	return {
		querySet: trimmedData,
		pages: pages,
	};
}

var state = {
	page: 1,
	pros: 12,
	window: 5,
};

function pageButtons(pages, CataParent) {
	var paginationWrapper = document.querySelector(".pagination");
	paginationWrapper.innerHTML = ``;

	var maxLeft = state.page - Math.floor(state.window / 2);
	var maxRight = state.page + Math.floor(state.window / 2);

	var previousPage = state.page;

	if (maxLeft < 1) {
		maxLeft = 1;
		maxRight = state.window;
	}

	if (maxRight > pages) {
		maxLeft = pages - (state.window - 1);

		if (maxLeft < 1) {
			maxLeft = 1;
		}
		maxRight = pages;
	}

	paginationWrapper.innerHTML += `<button class="prev-page pagin-btn">Prev</button>`;

	for (var page = maxLeft; page <= maxRight; page++) {
		paginationWrapper.innerHTML += `<button value=${page} class="page ${page} pagin-btn">${page}</button>`;
	}

	if (state.page != pages) {
		paginationWrapper.innerHTML += `<button value=${page} class="next-page pagin-btn">Next</button>`;
	}

	$("." + previousPage).addClass("active-btn-page");

	$(".page").on("click", function () {
		$(bttmCatalogSection).empty();
		$("." + previousPage).removeClass("active-btn-page");
		state.page = Number($(this).val());
		var currentPage = state.page;
		$("." + currentPage).addClass("active-btn-page");
		previousPage = currentPage;
		var theData = pagination(CataParent, state.page, state.pros);
		populateCatalogue(theData.querySet, bttmCatalogSection);
	});

	$(".next-page").on("click", function () {
		if (state.page != pages) {
			$(bttmCatalogSection).empty();
			$("." + previousPage).removeClass("active-btn-page");
			state.page = state.page + 1;
			var currentPage = state.page;
			$("." + currentPage).addClass("active-btn-page");
			previousPage = currentPage;
			var theData = pagination(CataParent, state.page, state.pros);
			populateCatalogue(theData.querySet, bttmCatalogSection);
		}
	});

	$(".prev-page").on("click", function () {
		$(bttmCatalogSection).empty();
		if (state.page > 1) {
			$("." + previousPage).removeClass("active-btn-page");
			state.page = state.page - 1;
			var currentPage = state.page;
			$("." + currentPage).addClass("active-btn-page");
			previousPage = currentPage;
		}
		var theData = pagination(CataParent, state.page, state.pros);
		populateCatalogue(theData.querySet, bttmCatalogSection);
	});
}

function requestFeatPro() {
	fetchCall("featured.php", responseFeatPro);
	function responseFeatPro(data) {
		if (data.featured) {
			const topproCard = document.querySelector(".toppro-cards");
			populatePros(data.featured, topproCard);
		}
	}
}

function getProDetails() {
	window.location.href =
		"products.php" + "?name=" + this.name + "&getsearch=" + this.id;
}
