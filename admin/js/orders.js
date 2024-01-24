document.addEventListener("DOMContentLoaded", getAllPendingOrders);
document.addEventListener("DOMContentLoaded", getAllClosedOrders);

function getAllPendingOrders() {
	fetchCall("allpendingorders.php", responsePending);
	function responsePending(data) {
		const pendingNo = document.getElementById("pending-orders-number");
		const orders = data.pendingorders;
		const ordersNo = data.totalpending;
		pendingNo.textContent = ordersNo;
		orders.forEach((order) => {
			const productId = order.product_id;
			const userId = order.customer_id;
			fetchCall(
				`getorderdetails.php?prodid=${productId}&userId=${userId}`,
				fetchOrderDetails
			);
			function fetchOrderDetails(data) {
				const allpendingOrders = document.querySelector(
					".pending-contents-contents"
				);
				const pro = data.orderdets[0];
				const user = data.orderdets[1];
				const pendingDiv = document.createElement("div");
				pendingDiv.className = "pending-div";

				const orderDiv = document.createElement("div");
				orderDiv.className = "orderId";
				orderDiv.textContent = "#SN" + order.id + "OI";

				const userName = document.createElement("div");
				userName.className = "fname";
				userName.textContent = user.Fname;

				const userEmail = document.createElement("div");
				userEmail.className = "email";
				userEmail.textContent = user.email;

				const userAddress = document.createElement("div");
				userAddress.className = "address";
				userAddress.textContent =
					user.state + ", " + user.city + ", " + user.home_address;

				const userNumber = document.createElement("div");
				userNumber.className = "number";
				userNumber.textContent = user.phone_number;

				const productName = document.createElement("div");
				productName.className = "product";
				productName.textContent = pro.name;

				const productQty = document.createElement("div");
				productQty.className = "quantity";
				productQty.textContent = order.quantity;

				const ostatusDiv = document.createElement("div");
				ostatusDiv.className = "status";
				const ostatus = document.createElement("select");
				ostatus.setAttribute("name", "status");
				ostatus.addEventListener("change", closeOrder.bind(order));
				ostatus.innerHTML = `                
                    <option value="pending">Pending</option>
                    <option value="complete">Close</option>
                `;
				ostatusDiv.append(ostatus);

				const orderDate = document.createElement("div");
				orderDate.className = "date";
				orderDate.textContent = order.date;

				pendingDiv.append(orderDiv);
				pendingDiv.append(userName);
				pendingDiv.append(userEmail);
				pendingDiv.append(userAddress);
				pendingDiv.append(userNumber);
				pendingDiv.append(productName);
				pendingDiv.append(productQty);
				pendingDiv.append(ostatusDiv);
				pendingDiv.append(orderDate);

				allpendingOrders.append(pendingDiv);
			}
		});
	}
}

function getAllClosedOrders() {
	fetchCall("allclosedorders.php", responseClosed);
	function responseClosed(data) {
		const allclosedOrders = document.querySelector(
			".closed-contents-contents"
		);
		const closedNo = document.getElementById("closed-orders-number");
		const orders = data.closedorders;
		const ordersNo = data.totalclosed;
		closedNo.textContent = ordersNo;
		orders.forEach((order) => {
			const productId = order.product_id;
			const userId = order.customer_id;
			fetchCall(
				`getorderdetails.php?prodid=${productId}&userId=${userId}`,
				fetchOrderDetails
			);
			function fetchOrderDetails(data) {
				const pro = data.orderdets[0];
				const user = data.orderdets[1];
				const pendingDiv = document.createElement("div");
				pendingDiv.className = "closed-div";

				const orderDiv = document.createElement("div");
				orderDiv.className = "clorderId";
				orderDiv.textContent = "#SN" + order.id + "OI";

				const userName = document.createElement("div");
				userName.className = "clfname";
				userName.textContent = user.Fname;

				const userEmail = document.createElement("div");
				userEmail.className = "clemail";
				userEmail.textContent = user.email;

				const userAddress = document.createElement("div");
				userAddress.className = "claddress";
				userAddress.textContent =
					user.state + ", " + user.city + ", " + user.home_address;

				const userNumber = document.createElement("div");
				userNumber.className = "clnumber";
				userNumber.textContent = user.phone_number;

				const productName = document.createElement("div");
				productName.className = "clproduct";
				productName.textContent = pro.name;

				const productQty = document.createElement("div");
				productQty.className = "clquantity";
				productQty.textContent = order.quantity;

				const ostatusDiv = document.createElement("div");
				ostatusDiv.className = "clstatus active";
				ostatusDiv.textContent = "Delivered";

				const orderDate = document.createElement("div");
				orderDate.className = "cldate";
				orderDate.textContent = order.delivery_date;

				pendingDiv.append(orderDiv);
				pendingDiv.append(userName);
				pendingDiv.append(userEmail);
				pendingDiv.append(userNumber);
				pendingDiv.append(userAddress);
				pendingDiv.append(productName);
				pendingDiv.append(productQty);
				pendingDiv.append(ostatusDiv);
				pendingDiv.append(orderDate);

				allclosedOrders.append(pendingDiv);
			}
		});
	}
}

function closeOrder() {
	const orderId = this.id;
	$.ajax({
		url: "./php/changeorderstatus.php",
		method: "POST",
		data: { orderid: orderId },
		success: function () {
			window.location.reload();
		},
	});
}
