document.addEventListener("DOMContentLoaded", wishlistFunctionality);
document.addEventListener("DOMContentLoaded", setLocationLoaded);
const wishlistSummary = document.querySelector(".wishlist-order-items");
const wishlistPageTotal = document.getElementById("wishlist-items-amount");
const wishlistDOMcontents = document.querySelector(".wishlist-contents");

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

function removeWishlistItem(id) {
	wishlist = wishlist.filter((wishlistItem) => wishlistItem.id != id);
}

wishlist.forEach((wishlistItem) => {
	fetchCall(`productdetails.php?prodid=${wishlistItem.id}`, responseProduct);
	function responseProduct(data) {
		const product = data.product[0];
		const wishlistPro = document.createElement("div");
		wishlistPro.className = "cart-pro";
		wishlistPro.setAttribute("data-id", wishlistItem.id);
		wishlistPro.innerHTML = `
            <div class="pro-name">
                <div class="pro-img">
                    <img src="${product.image}" alt="${product.name}">
                </div>
                <h4><span>${product.brand}</span> <span> ${product.name}</span></h4>
            </div>
            <div class="pro-price">
                <h4>Ksh. ${product.price}</h4>
            </div>
            <div class="pro-qty">
                <div class="stock-qty">${product.stock}</div>
            </div>
            <div class="add-to-cart-wishlist-pro" data-id="${wishlistItem.id}">
                Confirm
            </div>
            <div class="remove full-wishlist-remove-pro" data-id="${wishlistItem.id}">
                Remove
            </div>`;

		wishlistDOMcontents.append(wishlistPro);

		const wishlistSummaryPro = document.createElement("div");
		wishlistSummaryPro.className = "order-item-preview";
		wishlistSummaryPro.setAttribute("data-id", wishlistItem.id);
		wishlistSummaryPro.innerHTML = `
            <div class="bg-img">
                <img src="${product.image}" alt="">
            </div>
            <div class="item-details">
                <div class="item-title"><h3>${product.name}</h3></div>
                
                <div class="item-price">
                    <h3>Ksh. ${product.price}</h3>
                    <div class="item-qty" data-id="${wishlistItem.id}">X ${wishlistItem.amount}</div>
                </div>
            </div>`;
		wishlistSummary.append(wishlistSummaryPro);
	}
});

function wishlistFunctionality() {
	wishlistDOMcontents.addEventListener("click", function (e) {
		const element = e.target;
		const parent = e.target.parentElement;
		const parentId = e.target.parentElement.dataset.id;

		if (element.classList.contains("full-wishlist-remove-pro")) {
			removeWishlistItem(parentId);
			element.parentElement.remove();
			window.location.reload();
		}
		if (element.classList.contains("add-to-cart-wishlist-pro")) {
			fetchCall(
				`productdetails.php?prodid=${parentId}`,
				responseWProduct
			);
			function responseWProduct(data) {
				const product = data.product[0];
				getWProDetails(product);
			}
		}

		displayWishlistItemCount();
		setStorageItem("wishlist", wishlist);
	});
}

function getWProDetails(data) {
	window.location.href =
		"products.php" + "?name=" + data.name + "&getsearch=" + data.id;
}

var totalWishlistAmount = 0;
wishlist.forEach((wishlistitem) => {
	totalWishlistAmount += wishlistitem.price * wishlistitem.amount;
});
wishlistPageTotal.textContent = "Ksh. " + totalWishlistAmount.toFixed(2);
