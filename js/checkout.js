document.addEventListener("DOMContentLoaded", setLocationLoaded);
const checkoutOrderItems = document.querySelector(".checkout-order-items");
const checkoutTotal = document.getElementById("checkout-total-amount");
const transactionClose = document.getElementById("transaction-close");
const transaction = document.getElementById("transaction");

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

checkout.forEach((checkoutItem) => {
	fetchCall(`productdetails.php?prodid=${checkoutItem.id}`, responseCProduct);
	function responseCProduct(data) {
		const product = data.product[0];
		const checkoutSummary = document.createElement("div");
		checkoutSummary.className = "checkout-order-item-preview";
		checkoutSummary.setAttribute("data-id", checkoutItem.id);
		checkoutSummary.innerHTML = `
            <div class="bg-img">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="item-details">
                <div class="item-title"><h3>${product.name}</h3></div>
                <div class="item-price">
                    <h3>Ksh. ${product.price}</h3>
                    <div class="item-qty">X ${checkoutItem.amount}</div>
                </div>
            </div>`;
		checkoutOrderItems.append(checkoutSummary);
	}
});

var totalCheckoutAmount = 0;
checkout.forEach((checkoutitem) => {
	totalCheckoutAmount += checkoutitem.price * checkoutitem.amount;
});
checkoutTotal.textContent = "Ksh. " + totalCheckoutAmount.toFixed(2);
const payableamounttotal = document.getElementById("payable-amount-total");
const usershippingfee = document.getElementById("user-shipping-fee");
const userCheckout = document.getElementById("userCheckout").value;

const useraddressdets = document.getElementById("user-address-dets");
const shippadresstitleicon = document.getElementById("shippadresstitleicon");
const usernamedets = document.getElementById("user-name-dets");

$(document).ready(function () {
	$.ajax({
		url: "./php/users.php",
		type: "GET",
		data: { userCheck: userCheckout },
		success: function (data) {
			const uData = JSON.parse(data).result;
			if (uData.phone_number === null) {
				usernamedets.innerHTML =
					"<h2>" +
					uData.Fname +
					" " +
					uData.Lname +
					"<span style='color:red;'>Please enter your contact in the accounts page</span></h2>";
			} else {
				usernamedets.innerHTML =
					"<h2>" +
					uData.Fname +
					" " +
					uData.Lname +
					"<span>" +
					uData.phone_number +
					"</span></h2>";
			}
			if (uData.home_address === null) {
				shippadresstitleicon.innerHTML =
					'<iconify-icon icon="bi:x-octagon" width="16"></iconify-icon>';
				useraddressdets.innerHTML =
					"<h2 style='color:red;'>Please add your address in the accounts page</h2>";
			} else {
				shippadresstitleicon.innerHTML =
					'<iconify-icon icon="subway:tick" width="16"></iconify-icon>';
				useraddressdets.innerHTML =
					"<h2>" +
					uData.state +
					",&nbsp;&nbsp;&nbsp; " +
					uData.city +
					"," +
					"</h2><h2>" +
					uData.home_address +
					"</h2>";
			}
		},
	});
});

// $(document).ready(function () {
// 	$.ajax({
// 		url: "./php/shippingfee.php",
// 		type: "GET",
// 		data: { userCheck: userCheckout },
// 		success: function (data) {
// 			if (data) {
// 				const shipFee = JSON.parse(data).fee;
// 				payableamounttotal.textContent =
// 					"Ksh. " + (totalCheckoutAmount + shipFee).toFixed(2);
// 				usershippingfee.textContent = "Ksh. " + shipFee.toFixed(2);
// 			}
// 		},
// 	});
// });

const productId = [];
const productQty = [];
const productSize = [];
checkout.forEach((prod) => {
	productId.push(prod.id);
	productQty.push(prod.amount);
	productSize.push(prod.size);
});

$(document).ready(function () {
	$("#mpesa_no").on("input", function () {
		if ($(this).val().length == 12) {
			$("#checkout-submit-dets").attr("disabled", false);
		} else {
			$("#checkout-submit-dets").attr("disabled", true);
		}
	});

	$("#checkout-submit-dets").on("click", function () {
		const mpesaNo = document.getElementById("mpesa_no").value;

		if (mpesaNo.length != 12) {
			$("#mpesa_no").css("border", "1px solid red");
			$("#mpesa_no").css("box-shadow", "0 0 5px red");
			$(".valid-no-error").css("display", "block");
		} else {
			$("#checkout-submit-dets").attr("disabled", true);
			$("#mpesa_no").css("border", "1px solid #999");
			$("#mpesa_no").css("box-shadow", "none");
			$(".valid-no-error").css("display", "none");

			$.ajax({
				url: "./daraja-api/stkpush.php",
				type: "POST",
				context: document.body,
				data: {
					prodId: productId,
					qty: productQty,
					userId: userCheckout,
					number: mpesaNo,
				},
				success: function (data) {
					const checkoutRequestID =
						JSON.parse(data).checkoutRequestID;
					const responseCode = JSON.parse(data).responseCode;
					$("#confirm-paid").css("display", "block");
					$("#confirm-paid").on("click", function () {
						window.location.href =
							"./daraja-api/confirm.php?checkoutRequestID=" +
							checkoutRequestID +
							"&responseCode=" +
							responseCode +
							"&prodId=" +
							productId +
							"&qty=" +
							productQty +
							"&userId=" +
							userCheckout;
					});
				},
			});
		}
	});
});

transactionClose.addEventListener("click", () => {
	transaction.style.display = "none";
});
