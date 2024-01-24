document.addEventListener("DOMContentLoaded", getAllCustomers);
document.addEventListener("DOMContentLoaded", getAllUsers);

const customercontentscontents = document.querySelector(
	".customer-contents-contents"
);
const allcustomersnumber = document.getElementById("all-customers-number");
function getAllCustomers() {
	fetchCall("alltransactions.php", responseTransactions);
	function responseTransactions(data) {
		const customers = data.alltransactions;
		const customersNo = data.totaltransactions;
		allcustomersnumber.textContent = customersNo;
		populateCustomers(customers);
	}
}

function populateCustomers(customers) {
	customers.forEach((customer) => {
		const prodid = customer.product_id;
		const userid = customer.customer_id;
		fetchCall(
			`transactiondetails.php?prodid=${prodid}&userid=${userid}`,
			fetchTransactionDets
		);
		function fetchTransactionDets(data) {
			const prod = data.transdets[0];
			const user = data.transdets[1];
			const customerDiv = document.createElement("div");
			customerDiv.className = "customer-div";

			const userName = document.createElement("div");
			userName.className = "cfname";
			userName.textContent = customer.customer_name;

			const userEmail = document.createElement("div");
			userEmail.className = "cemail";
			userEmail.textContent = user.email;

			const userContact = document.createElement("div");
			userContact.className = "cnumber";
			userContact.textContent = user.phone_number;

			const status = document.createElement("div");
			status.textContent = customer.payment_status;
			if (
				customer.payment_status == "succeeded" ||
				customer.payment_status == "COMPLETED" ||
				customer.payment_status == "paid"
			) {
				status.className = "cstatus active";
			} else {
				status.className = "cstatus inactive";
			}

			const product = document.createElement("div");
			product.className = "cproduct";
			product.textContent = prod.name;

			const quantity = document.createElement("div");
			quantity.className = "cquantity";
			quantity.textContent = customer.quantity;

			const paidAmount = document.createElement("div");
			paidAmount.className = "camount";
			paidAmount.textContent =
				customer.paid_amount_currency + customer.paid_amount;

			const Date = document.createElement("div");
			Date.className = "cdate";
			Date.textContent = customer.created;

			customerDiv.append(userName);
			customerDiv.append(userEmail);
			customerDiv.append(userContact);
			customerDiv.append(status);
			customerDiv.append(product);
			customerDiv.append(quantity);
			customerDiv.append(paidAmount);
			customerDiv.append(Date);

			customercontentscontents.append(customerDiv);
		}
	});
}

const userscontentscontents = document.querySelector(
	".users-contents-contents"
);
const allusersnumber = document.getElementById("all-users-number");
function getAllUsers() {
	fetchCall("allusers.php", responseUsers);
	function responseUsers(data) {
		const users = data.allusers;
		const usersNo = data.totalusers;
		allusersnumber.textContent = usersNo;
		populateUsers(users);
	}
}

function populateUsers(users) {
	users.forEach((user) => {
		const userDiv = document.createElement("div");
		userDiv.className = "user-div";

		const userName = document.createElement("div");
		userName.className = "ufname";
		userName.textContent = user.Fname + " " + user.Lname;

		const userEmail = document.createElement("div");
		userEmail.className = "uemail";
		userEmail.textContent = user.email;

		const status = document.createElement("div");
		status.textContent = user.state;
		status.className = "ustatus";

		const userContact = document.createElement("div");
		userContact.className = "unumber";
		userContact.textContent = user.phone_number;

		const country = document.createElement("div");
		country.className = "ucountry";
		country.textContent = user.country;

		const Date = document.createElement("div");
		Date.className = "udate";
		Date.textContent = user.date;

		userDiv.append(userName);
		userDiv.append(userEmail);
		userDiv.append(status);
		userDiv.append(userContact);
		userDiv.append(country);
		userDiv.append(Date);

		userscontentscontents.append(userDiv);
	});
}
