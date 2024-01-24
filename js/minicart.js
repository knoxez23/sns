document.addEventListener("DOMContentLoaded", init);
const cartIcon = document.getElementById("cart");

cartIcon.addEventListener("mouseover", () => {
	miniCartOverlay.style.display = "block";
	miniCart.onmouseleave = () => {
		miniCartOverlay.style.display = "none";
	};
});

function init() {
	displayCartTotal();
	setUpCartFunctionality();
	displayCartItemsDOM();
}

function addtoCartDOM(id, product) {
	fetchCall(`productdetails.php?prodid=${id}`, responseProduct);
	function responseProduct(data) {
		const prod = data.product[0];
		emptyMiniCartMessage.style.display = "none";
		const miniCartPro = document.createElement("div");
		miniCartPro.className = "product-mini-cart";
		miniCartPro.setAttribute("data-id", id);
		miniCartPro.innerHTML = `
        <div class="pro-details">
            <h4>${prod.name}</h4>
            <h5><span class="cart-item-amount" data-id="${id}">${product.amount}</span> X Ksh. ${prod.price}</h5>
        </div>
        <div class="pro-image">
            <img src="${prod.image}" alt="${prod.name}">
        </div>
        <div class="remove remove-mini-cart-pro" data-id="${id}"><iconify-icon icon="akar-icons:cross" width="16"></iconify-icon></div>`;

		miniCartDomContents.append(miniCartPro);
	}
}

function setUpCartFunctionality() {
	miniCartDomContents.addEventListener("click", function (e) {
		const element = e.target;
		const parent = e.target.parentElement;
		const id = e.target.dataset.id;
		const parentId = e.target.parentElement.dataset.id;

		if (
			parent.classList.contains("remove-mini-cart-pro") ||
			element.classList.contains("remove-mini-cart-pro")
		) {
			removeItem(parentId);
			parent.parentElement.remove();
		}
		if (!cart) {
			emptyMiniCartMessage.style.display = "block";
		}

		displayCartItemCount();
		displayCartTotal();
		setStorageItem("cart", cart);
		setStorageItem("checkout", cart);
	});
}

function displayCartTotal() {
	let total = cart.reduce((total, cartItem) => {
		return (total += cartItem.price * cartItem.amount);
	}, 0);
	minicartTotal.textContent = "Ksh. " + total.toFixed(2);
}

function displayCartItemsDOM() {
	cart.forEach((cartItem) => {
		addtoCartDOM(cartItem.id, cartItem);
	});
}
