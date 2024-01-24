document.addEventListener("DOMContentLoaded", getAllTransactions);
document.addEventListener("DOMContentLoaded", getInbusinessTrans);
document.addEventListener("DOMContentLoaded", getEarnings);
document.addEventListener("DOMContentLoaded", getSpending);
document.addEventListener("DOMContentLoaded", getCashIn);
document.addEventListener("DOMContentLoaded", getChart);

const transactionscontentscontents = document.querySelector(
	".transactions-contents-contents"
);
const latesttransactionsnumber = document.getElementById(
	"latest-transactions-number"
);
function getAllTransactions() {
	fetchCall("alltransactions.php", responseTransactions);
	function responseTransactions(data) {
		const transactions = data.alltransactions;
		const transactionsNo = data.totaltransactions;
		latesttransactionsnumber.textContent = transactionsNo;
		populateTransactions(transactions);
	}
}

function populateTransactions(transactions) {
	transactions.forEach((transaction) => {
		const prodid = transaction.product_id;
		const userid = transaction.customer_id;
		fetchCall(
			`transactiondetails.php?prodid=${prodid}&userid=${userid}`,
			fetchTransactionDets
		);
		function fetchTransactionDets(data) {
			const prods = data.transdets[0];
			const user = data.transdets[1];
			const transactionDiv = document.createElement("div");
			transactionDiv.className = "transaction-cdiv";

			const userName = document.createElement("div");
			userName.className = "trname";
			userName.textContent = transaction.customer_name;

			const userEmail = document.createElement("div");
			userEmail.className = "tremail";
			userEmail.textContent = user.email;

			const userContact = document.createElement("div");
			userContact.className = "trnumber";
			userContact.textContent = user.phone_number;

			const product = document.createElement("div");
			product.className = "trproduct";
			product.textContent = prods.name;

			const quantity = document.createElement("div");
			quantity.className = "trquantity";
			quantity.textContent = transaction.quantity;

			const paidAmount = document.createElement("div");
			paidAmount.className = "tramount";
			paidAmount.textContent =
				transaction.paid_amount_currency + transaction.paid_amount;

			const status = document.createElement("div");
			status.textContent = transaction.payment_status;
			if (
				transaction.payment_status == "succeeded" ||
				transaction.payment_status == "COMPLETED" ||
				transaction.payment_status == "paid"
			) {
				status.className = "trstatus active";
			} else {
				status.className = "trstatus inactive";
			}

			const coupon = document.createElement("div");
			coupon.textContent = transaction.coupon;
			coupon.className = "trcoupon";

			const Date = document.createElement("div");
			Date.className = "trdate";
			Date.textContent = transaction.created;

			transactionDiv.append(userName);
			transactionDiv.append(userEmail);
			transactionDiv.append(userContact);
			transactionDiv.append(product);
			transactionDiv.append(quantity);
			transactionDiv.append(paidAmount);
			transactionDiv.append(status);
			transactionDiv.append(coupon);
			transactionDiv.append(Date);
			transactionscontentscontents.append(transactionDiv);
		}
	});
}

function getInbusinessTrans() {
	fetchCall("inbusinesstrans.php", responseInbusiness);
	function responseInbusiness(data) {
		const inbusinesstransnumber = document.getElementById(
			"inbusiness-trans-number"
		);
		const inbusinesscontentscontents = document.querySelector(
			".inbusiness-contents-contents"
		);
		const inbusinesses = data.allinbusiness;
		const inbusinessNo = data.totalinbusiness;
		inbusinesstransnumber.textContent = inbusinessNo;

		inbusinesses.forEach((inbusiness) => {
			const inbusinessDiv = document.createElement("div");
			inbusinessDiv.className = "inbusiness-div";

			const amount = document.createElement("div");
			amount.className = "inamount-used";
			amount.textContent = "$" + inbusiness.amount;

			const company = document.createElement("div");
			company.className = "incompany";
			company.textContent = inbusiness.company;

			const purpose = document.createElement("div");
			purpose.className = "inpurpose";
			purpose.textContent = inbusiness.purpose;

			const date = document.createElement("div");
			date.className = "indate";
			date.textContent = inbusiness.date;

			inbusinessDiv.append(amount);
			inbusinessDiv.append(company);
			inbusinessDiv.append(purpose);
			inbusinessDiv.append(date);

			inbusinesscontentscontents.append(inbusinessDiv);
		});
	}
}

const searchtransactionbtn = document.getElementById("search-transaction-btn");
const transactionsearchinput = document.getElementById(
	"transaction-search-input"
);

searchtransactionbtn.addEventListener("click", () => {
	const search = transactionsearchinput.value;

	$.ajax({
		url: "../php/searchtrans.php",
		method: "GET",
		data: { query: search },
		success: function (data) {
			const results = JSON.parse(data).transactions;
			transactionscontentscontents.innerHTML = ``;
			populateTransactions(results);
		},
	});
});

var dataset = [];
var incomeTotal = 0;
function getEarnings() {
	var set = [];
	fetchCall("totalearnings.php", responseEarnings);
	function responseEarnings(data) {
		const amountearnedfrombsness = document.querySelector(
			".total-amount-made-contents"
		);
		const earnings = data.allearnings[0];
		let totalearn = parseFloat(earnings.totals);
		incomeTotal = totalearn;
		set.push(parseFloat(earnings.totals));
		amountearnedfrombsness.textContent =
			"$" + totalearn.toLocaleString("en-US");
	}
	dataset = set;
}

var expenseTotal = 0;
function getSpending() {
	fetchCall("totalspending.php", responseSpending);
	function responseSpending(data) {
		const amountspenttotal = document.querySelector(
			".total-amount-invested-contents"
		);
		if (data.allexpenses[0].totals != null) {
			const expenses = data.allexpenses[0];
			let totalexpense = parseFloat(expenses.totals);
			dataset.push(parseFloat(expenses.totals));
			expenseTotal = totalexpense;

			amountspenttotal.textContent =
				"$" + totalexpense.toLocaleString("en-US");
		} else {
			amountspenttotal.textContent = "$0.00";
		}
	}
}

function getCashIn() {
	const totalProfit = document.querySelector(".total-profit-contents");
	setTimeout(() => {
		const cashIn = incomeTotal - expenseTotal;
		if (cashIn < 0) {
			totalProfit.classList.add("loss");
			totalProfit.textContent = "$" + cashIn.toLocaleString("en-US");
		} else if (cashIn > 0) {
			totalProfit.classList.add("profit");
			totalProfit.textContent = "$" + cashIn.toLocaleString("en-US");
		}
	}, 1000);
}

const ctx = document.getElementById("myChart").getContext("2d");
function getChart() {
	setTimeout(() => {
		const myChart = new Chart(ctx, {
			type: "doughnut",
			data: {
				labels: ["Total Earned", "Total Spent"],
				datasets: [
					{
						label: "Overall income in '$'",
						data: dataset,
						backgroundColor: [
							"rgba(255, 99, 132, 1)",
							"rgba(54, 162, 235, 1)",
						],
					},
				],
			},
			options: {
				scales: {
					y: {
						beginAtZero: true,
					},
				},
			},
		});
	}, 1000);
}
