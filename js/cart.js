document.addEventListener("DOMContentLoaded", fullCartFunctionality);
document.addEventListener("DOMContentLoaded", setLocationLoaded);
const cartSummary = document.querySelector(".order-items");
const cartPageTotal = document.getElementById("cart-total-amount");
const cartProductsDOM = document.querySelector(".cart-contents");

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

{
	/* <div class="decr cart-qty-actions cart-amount-decrease" data-id="${cartItem.id}"><i class="fa-solid fa-minus"></i></div> */
}
{
	/* <div class="incr cart-qty-actions cart-amount-increase" data-id="${cartItem.id}"><i class="fa-solid fa-plus"></i></div> */
}

cart.forEach((cartItem) => {
	fetchCall(`productdetails.php?prodid=${cartItem.id}`, responseCProduct);
	function responseCProduct(data) {
		const product = data.product[0];
		const cartPro = document.createElement("div");
		cartPro.className = "cart-pro";
		cartPro.setAttribute("data-id", cartItem.id);
		cartPro.innerHTML = `
            <div class="pro-name">
                <div class="pro-img">
                    <img src="${product.image}" alt="${product.name}">
                </div>
                <h4><span>${product.brand}</span><span> ${
			product.name
		}</span></h4>
            </div>
            <div class="pro-price">
                <h4>Ksh. ${product.price}</h4>
            </div>
            <div class="pro-qty">
                <div class="cart-qty-amount" data-id="${cartItem.id}">${
			cartItem.amount
		}</div>
            </div>
            <div class="pro-total">
                <h4>Ksh. ${(product.price * cartItem.amount).toFixed(2)}</h4>
            </div>
            <div class="remove full-cart-remove-pro" data-id="${cartItem.id}">
                Remove
            </div>`;
		cartProductsDOM.append(cartPro);

		const cartSummaryPro = document.createElement("div");
		cartSummaryPro.className = "order-item-preview";
		cartSummaryPro.setAttribute("data-id", cartItem.id);
		cartSummaryPro.innerHTML = `
            <div class="bg-img">
                <img src="${product.image}" alt="">
            </div>
            <div class="item-details">
                <div class="item-title"><h3>${product.name}</h3></div>
                <div class="item-size"><h4>Size: ${cartItem.size}</h4></div>
                <div class="item-price">
                    <h3>Ksh. ${product.price}</h3>
                    <div class="item-qty">X ${cartItem.amount}</div>
                </div>
            </div>`;
		cartSummary.append(cartSummaryPro);
	}
});

// function increaseAmountt(id){
//     let newAmount;
//     cart = cart.map((cartItem)=>{
//         if(cartItem.id === id){
//             console.log("Success")
//             newAmount = cartItem.amount + 1;
//             cartItem = {...cartItem, amount: newAmount};
//         }
//         return cartItem
//     });
//     return newAmount;
// }

// function decreaseAmountt(id){
//     let newAmount;
//     cart = cart.map((cartItem)=>{
//         if(cartItem.id === id){
//             if(cartItem.amount != 1){
//                 newAmount = cartItem.amount - 1;
//                 cartItem = {...cartItem, amount: newAmount};
//             }
//             else {
//                 newAmount = 1;
//                 cartItem = {...cartItem, amount: newAmount};
//             }
//         }
//         return cartItem
//     });
//     return newAmount;
// }

function fullCartFunctionality() {
	cartProductsDOM.addEventListener("click", function (e) {
		const element = e.target;
		const parent = e.target.parentElement;
		const parentId = e.target.parentElement.dataset.id;

		if (element.classList.contains("full-cart-remove-pro")) {
			removeItem(parentId);
			element.parentElement.remove();
			window.location.reload();
		}

		if (!cart) {
			emptyCartMessage.style.display = "block";
		}

		// if(element.classList.contains("cart-amount-increase") || parent.classList.contains("cart-amount-increase")){
		//     const newAmount = increaseAmountt(parentId);
		//     element.nextElementSibling.textContent = newAmount;
		// }

		// if(element.classList.contains("cart-amount-decrease") || parent.classList.contains("cart-amount-decrease")){
		//     const newAmount = decreaseAmountt(parentId);
		//     element.previousElementSibling.textContent = newAmount;
		// }

		displayCartItemCount();
		setStorageItem("cart", cart);
		setStorageItem("checkout", cart);
	});
}

var totalCartAmount = 0;
cart.forEach((cartitem) => {
	totalCartAmount += cartitem.price * cartitem.amount;
});
cartPageTotal.textContent = "Ksh. " + totalCartAmount.toFixed(2);
