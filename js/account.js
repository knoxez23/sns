document.addEventListener("DOMContentLoaded", setLocationLoaded);
const accountDetailsBtn = document.getElementById(
	"account-details-account-page"
);
const accountDetails = document.getElementById("account-details-section");
const orderDetailsBtn = document.getElementById("order-details-account-page");
const orderDetails = document.getElementById("order-details-section");

accountDetailsBtn.addEventListener("click", () => {
	accountDetails.style.display = "block";
	orderDetails.style.display = "none";
	accountDetailsBtn.style.borderColor = "#000";
	orderDetailsBtn.style.borderColor = "#ccc";
});

orderDetailsBtn.addEventListener("click", () => {
	accountDetails.style.display = "none";
	orderDetails.style.display = "block";
	accountDetailsBtn.style.borderColor = "#ccc";
	orderDetailsBtn.style.borderColor = "#000";
});

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

function deleteLocalstorage() {
	var privateLocalstorage = [];
	privateLocalstorage = window.localStorage;
	console.log(privateLocalstorage);
	locationPath = privateLocalstorage.prolocpath;
	locationSearch = privateLocalstorage.prolocsearch;
}

const uid = document.getElementById("someuid").value;

fetchCall(`updateaccount.php?uid=${uid}`, responseDetails);
function responseDetails(data) {
	const uDets = data.details[0];
	const contact = document.getElementById("user-phone-no");
	contact.textContent = uDets.phone_number;
	const doB = document.getElementById("user-dob");
	doB.textContent = uDets.dob;
	const userState = document.getElementById("user-state");
	userState.textContent = uDets.state;
	const userCity = document.getElementById("user-city");
	userCity.textContent = uDets.city;
	const userAddress = document.getElementById("user-address");
	userAddress.textContent = uDets.home_address;
}

function updateValues(element, column, id) {
	var value = element.innerText;

	$.ajax({
		url: "./php/updateaccount.php",
		method: "POST",
		data: { value: value, column: column, id: id },
		success: function (result) {
			element.style.borderColor = "initial";
			$(".success-update-message-account").css("display", "block");
			setTimeout(function () {
				$(".success-update-message-account").css("display", "none");
			}, 2500);
		},
	});
}

function activate(element) {
	element.style.borderColor = "red";
}

const allordersmade = document.getElementById("all-orders-made");

fetchCall(`orders.php?uid=${uid}`, responseOrders);
function responseOrders(data) {
	if (data) {
		const orders = data.orders;
		orders.forEach((order) => {
			// console.log(order)
			const proid = JSON.stringify(order.product_id);
			fetchCall(`productdetails.php?prodid=${proid}`, responsePros);
			function responsePros(data) {
				const prod = data.product[0];
				// console.log(prod)
				const orderDiv = document.createElement("div");
				orderDiv.className = "order-preview";
				orderDiv.innerHTML = `
                    <div class="pro-order">
                        <div class="bg-image">
                            <img src="${prod.image}" alt="${prod.name}">
                        </div>
                        <div class="pro-details">
                            <h3>${prod.brand + " " + prod.name}</h3>
                            <h5>SIze: ${order.size}</h5>
                            <h5>Quantity: ${order.quantity}</h5>
                        </div>
                    </div>
                `;
				const orderStatus = document.createElement("div");
				orderStatus.className = "order-status";
				if (order.status === 1) {
					orderStatus.innerHTML = `
                        <h3>Closed</h3>
                        <h4>Purchased and Delivered</h4>
                    `;
				} else {
					orderStatus.innerHTML = `
                        <h3>Open</h3>
                        <h4>Delivery is ongoing</h4>
                    `;
				}
				orderDiv.append(orderStatus);
				const deliveryDate = document.createElement("div");
				deliveryDate.className = "delivery-date";
				if (order.delivery_date === null) {
					deliveryDate.innerHTML = `
                    <h3>Ongoing</h3>
                    `;
				} else {
					deliveryDate.innerHTML = `
                    <h3>${order.delivery_date}</h3>
                    `;
				}
				orderDiv.append(deliveryDate);

				allordersmade.append(orderDiv);
			}
		});
	}
}
