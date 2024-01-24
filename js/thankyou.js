function fetchCall(resource, callBack, method = "GET") {
	const url = "http://localhost/jwcommerce/php/";
	fetch(url + resource, {
		method: method,
	})
		.then((res) => res.json())
		.then((data) => {
			callBack(data);
		})
		.catch((err) => console.log(err));
}

function goHome() {
	sessionStorage.clear();
	window.location.replace("index.php");
}

const searchURL = window.location.search;
const urlQuery = new URLSearchParams(searchURL);

const txnId = urlQuery.get("txnid");
const cardName = urlQuery.get("cardholder");
const checkId = urlQuery.get("check");
const paidAmount = urlQuery.get("amount");

const transactionidcont = document.getElementById("transaction-id-cont");
const cardholder = document.getElementById("card-holder");
const userEmail = document.getElementById("user-email-dets");
const userContact = document.getElementById("user-contact-dets");
const userDelivAddress = document.getElementById("user-delivery-address");
const customerpaidamount = document.getElementById("customer-paid-amount");
transactionidcont.textContent = txnId;
cardholder.textContent = cardName;
customerpaidamount.textContent = "$" + paidAmount;

$(document).ready(function () {
	$.ajax({
		url: "./php/users.php",
		type: "GET",
		data: { userCheck: checkId },
		success: function (data) {
			const uData = JSON.parse(data).result;
			userEmail.textContent = uData.email;
			userContact.textContent = uData.phone_number;
			userDelivAddress.textContent =
				uData.country +
				",   " +
				uData.state +
				",  " +
				uData.city +
				",   " +
				uData.home_address;
		},
	});
});

const allproductsbought = document.getElementById("all-products-bought");
const checkout = JSON.parse(sessionStorage.getItem("checkout"));
checkout.forEach((checkoutItem) => {
	fetchCall(`productdetails.php?prodid=${checkoutItem.id}`, responseProduct);
	function responseProduct(data) {
		const product = data.product[0];
		const productDiv = document.createElement("div");
		productDiv.className = "product-div";
		productDiv.innerHTML = `
            <div class="pro-name">${product.name}</div>
            <div class="pro-quantity">
                <div class="actual-qty">${checkoutItem.amount}</div>
            </div>
            <div class="pro-amount">$${
				product.price * checkoutItem.amount
			}</div>
        `;
		allproductsbought.append(productDiv);
	}
});
