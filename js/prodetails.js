const prodetailswishlistadd = document.getElementById(
	"prodetails-wishlist-add"
);
const prodetailscartadd = document.getElementById("prodetails-cart-add");
const prodetailscartincramount = document.getElementById(
	"prodetails-amount-cart-incr"
);
const prodetailscartdecramount = document.getElementById(
	"prodetails-amount-cart-decr"
);
const prodetailsamountcart = document.getElementById("prodetails-amount-cart");

function getProDetails() {
	localStorage.setItem("prodetailspro", JSON.stringify(this));
	localStorage.setItem("proName", this.name);
	localStorage.setItem("proBrand", this.brand);
	localStorage.setItem("proShortDesc", this.shortdesc);
	localStorage.setItem("proPrice", this.price);
	// localStorage.setItem("proPrevPrice", this.prevprice);
	localStorage.setItem("proFullImage", this.image);
	localStorage.setItem("proSmallImage1", this.smallimg1);
	localStorage.setItem("proSmallImage2", this.smallimg2);
	localStorage.setItem("proSmallImage3", this.smallimg3);
	localStorage.setItem("proFullDesc", this.fulldesc);
	localStorage.setItem("proCategoryId", this.category_id);
	localStorage.setItem("proId", this.id);
	localStorage.setItem("proStock", this.stock);

	window.location.href = "prodetails.html";
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
	const thes = JSON.parse(localStorage.getItem("prodetailspro"));
	let WItem = wishlist.find((wishlistItem) => wishlistItem.id === thes.id);
	if (!WItem) {
		product = { ...thes, amount: 1, size: 42, stock: thes.stock };
		wishlist = [...wishlist, product];
	}

	displayWishlistItemCount();
	setStorageItem("wishlist", wishlist);
});

prodetailscartadd.addEventListener("click", () => {
	const thus = JSON.parse(localStorage.getItem("prodetailspro"));

	console.log(thus);
	let Item = cart.find((cartItem) => cartItem.id === thus.id);
	if (!Item) {
		product = { ...thus, amount: newwamount, size: 42, stock: thus.stock };
		cart = [...cart, product];
		addtoCartDOM(product);
	} else {
		const amount = increaseAmount(thus.id);
		const items = [
			...miniCartDomContents.querySelectorAll(".cart-item-amount"),
		];
		const newAmount = items.find((value) => value.dataset.id === thus.id);
		newAmount.textContent = amount;
	}

	displayCartItemCount();
	displayCartTotal();
	setStorageItem("cart", cart);
	setStorageItem("checkout", cart);
});

fetchCall(
	`category.php?catid=${localStorage.getItem("proCategoryId")}`,
	responseCategory
);
function responseCategory(data) {
	const proCategoryPath = document.getElementById("pro-category-path");
	proCategoryPath.textContent = data.name;
	if (data.name == "Men's") {
		proCategoryPath.href = "mens.html";
	} else if (data.name == "Women's") {
		proCategoryPath.href = "womens.html";
	} else if (data.name == "Kids") {
		proCategoryPath.href = "kids.html";
	} else if (data.name == "Sale") {
		proCategoryPath.href = "sale.html";
	} else if (data.name == "Collection") {
		proCategoryPath.href = "collection.html";
	}
}

const proNamePath = document.getElementById("pro-name-path");
proNamePath.textContent = localStorage.getItem("proName");

const proFullName = document.querySelector(".pro-full-title");
proFullName.innerHTML = ``;
const h1 = document.createElement("h1");
const proBrand = document.createElement("span");
proBrand.className = "brand";
proBrand.textContent = localStorage.getItem("proBrand");
h1.append(proBrand);
const proName = document.createElement("span");
proName.className = "prod-name";
proName.textContent = localStorage.getItem("proName");
h1.append(proName);
proFullName.append(h1);

const proPagePrice = document.querySelector(".pro-page-price");
proPagePrice.innerHTML = ``;
const currentProPrice = document.createElement("h4");
currentProPrice.textContent = "$" + localStorage.getItem("proPrice");
// const prevProPrice = document.createElement("strike");
// prevProPrice.textContent = "$" + localStorage.getItem("proPrevPrice");
proPagePrice.append(currentProPrice);
// proPagePrice.append(prevProPrice);

const shortDesc = document.querySelector(".short-desc");
shortDesc.innerHTML = ``;
const shorth3 = document.createElement("h3");
shorth3.textContent = localStorage.getItem("proShortDesc");
shortDesc.append(shorth3);

const proReportStock = document.querySelector(".stock-report");
proReportStock.innerHTML = ``;
const stockReport = document.createElement("div");
if (localStorage.getItem("proStock") > 10) {
	stockReport.className = "btn-instock";
	stockReport.textContent = "InStock";
} else if (
	localStorage.getItem("proStock") <= 10 &&
	localStorage.getItem("proStock") > 0
) {
	stockReport.className = "btn-soldout";
	stockReport.textContent =
		"Only " + localStorage.getItem("proStock") + " remaining";
} else {
	stockReport.className = "btn-soldout";
	stockReport.textContent = "SoldOut";
}
proReportStock.append(stockReport);
document.title = localStorage.getItem("proName").toUpperCase();

const ShoeFullImage = document.querySelector(".shoe-full-image");
ShoeFullImage.innerHTML = ``;
const FullProdImage = document.createElement("img");
FullProdImage.className = "full-prod-image";
FullProdImage.src = localStorage.getItem("proFullImage");
ShoeFullImage.append(FullProdImage);

const shoeSmallDisplay = document.querySelector(".shoe-small-display");
shoeSmallDisplay.innerHTML = ``;
const shoeSmall1 = document.createElement("div");
shoeSmall1.innerHTML = ``;
shoeSmall1.classList.add("shoe-small1");
const shoeSmall1Img = document.createElement("img");
shoeSmall1Img.className = "shoesmall1";
shoeSmall1Img.src = localStorage.getItem("proFullImage");
shoeSmall1.setAttribute(
	"onclick",
	`changeImage(document.querySelector(".shoesmall1"))`
);
shoeSmall1.append(shoeSmall1Img);

const shoeSmall2 = document.createElement("div");
shoeSmall2.innerHTML = ``;
shoeSmall2.className = "shoe-small1";
const shoeSmall2Img = document.createElement("img");
shoeSmall2Img.className = "shoesmall2";
shoeSmall2Img.src = localStorage.getItem("proSmallImage1");
shoeSmall2.setAttribute(
	"onclick",
	`changeImage(document.querySelector(".shoesmall2"))`
);
shoeSmall2.append(shoeSmall2Img);

const shoeSmall3 = document.createElement("div");
shoeSmall3.innerHTML = ``;
shoeSmall3.className = "shoe-small1";
const shoeSmall3Img = document.createElement("img");
shoeSmall3Img.className = "shoesmall3";
shoeSmall3Img.src = localStorage.getItem("proSmallImage2");
shoeSmall3.setAttribute(
	"onclick",
	`changeImage(document.querySelector(".shoesmall3"))`
);
shoeSmall3.append(shoeSmall3Img);

const shoeSmall4 = document.createElement("div");
shoeSmall4.innerHTML = ``;
shoeSmall4.className = "shoe-small1";
const shoeSmall4Img = document.createElement("img");
shoeSmall4Img.className = "shoesmall4";
shoeSmall4Img.src = localStorage.getItem("proSmallImage3");
shoeSmall4.setAttribute(
	"onclick",
	`changeImage(document.querySelector(".shoesmall4"))`
);
shoeSmall4.append(shoeSmall4Img);

shoeSmallDisplay.appendChild(shoeSmall1);
shoeSmallDisplay.appendChild(shoeSmall2);
shoeSmallDisplay.appendChild(shoeSmall3);
shoeSmallDisplay.appendChild(shoeSmall4);

const proFullDescription = document.querySelector(".pro-specs-content");
const descriptionP = document.createElement("p");
descriptionP.textContent = localStorage.getItem("proFullDesc");
proFullDescription.append(descriptionP);

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
