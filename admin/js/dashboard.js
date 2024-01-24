document.addEventListener("DOMContentLoaded", getNewsletter);
document.addEventListener("DOMContentLoaded", getGoals);
document.addEventListener("DOMContentLoaded", getTransactions);
document.addEventListener("DOMContentLoaded", getEarnings);
document.addEventListener("DOMContentLoaded", getSpending);
document.addEventListener("DOMContentLoaded", getSoldPros);
document.addEventListener("DOMContentLoaded", getCustomersNo);
document.addEventListener("DOMContentLoaded", getSiteViews);
document.addEventListener("DOMContentLoaded", getChart);
document.addEventListener("DOMContentLoaded", populateEarnings);

function populateEarnings() {
	fetchCall("transactionsToEarnings.php", responseEarnings);
	function responseEarnings(data) {
		const earningspm = data.transactionsmonthly;
		earningspm.forEach((earning) => {
			const month = earning.curmonth;
			const earn = earning.totals;
			$.ajax({
				url: "./php/addearnings.php",
				method: "POST",
				data: { earnings: earn, month: month },
			});
		});
	}
}

const totalsitevisits = document.getElementById("total-site-visits");
function getSiteViews() {
	fetch("https://api.countapi.xyz/get/snshop/views")
		.then((res) => res.json())
		.then((data) => {
			const pageView = data.value;
			totalsitevisits.textContent = pageView;
		});
}

function getNewsletter() {
	fetchCall("getnewsletter.php", responseNewsletter);
	function responseNewsletter(data) {
		const newslettersnumber = document.getElementById("newsletters-number");
		const numberoffollows = document.getElementById("number-of-follows");
		const latestcustomerscontent = document.querySelector(
			".latest-customers-content"
		);

		const newsletters = data.newsletters;
		const newsletterNo = data.number;
		newslettersnumber.textContent = newsletterNo;
		numberoffollows.textContent = newsletterNo;
		newsletters.forEach((newsletter) => {
			const newsletterDiv = document.createElement("div");
			newsletterDiv.className = "customer-div";
			newsletterDiv.innerHTML = `
                <div class="customer-details">
                    <div class="following-status">
                        <h4>${newsletter.email}</h4>
                    </div>
                </div>
                <div class="email-info">
                    <a href="" style="text-decoration: none; color: black;">Email</a>
                </div>
            `;
			latestcustomerscontent.append(newsletterDiv);
		});
	}
}

function getTransactions() {
	fetchCall("alltransactions.php", responseTransactions);
	function responseTransactions(data) {
		const transactionsnumber = document.getElementById(
			"transactions-number"
		);
		const transactions = data.alltransactions;
		const transactionsNo = data.totaltransactions;
		transactionsnumber.textContent = transactionsNo;
		populateTransaction(transactions);
	}
}

function populateTransaction(transactions) {
	transactions.forEach((transaction) => {
		const prodid = transaction.product_id;
		const userid = transaction.customer_id;
		fetchCall(
			`transactiondetails.php?prodid=${prodid}&userid=${userid}`,
			fetchTransactionDets
		);
		function fetchTransactionDets(data) {
			const latesttransactionscontent = document.querySelector(
				".latest-transactions-content"
			);
			const prod = data.transdets[0];
			const transactionDiv = document.createElement("div");
			transactionDiv.className = "transaction-div";
			transactionDiv.innerHTML = `
                <div class="transaction-details">
                    <div class="transactor-name">
                        <div class="trasaction-logo-div"></div>
                        <h5>${
							transaction.customer_name
						} bought <span id="bought-product-quantity">&nbsp;&nbsp;${
				transaction.quantity
			}&nbsp;&nbsp;</span> <span id="bought-product-name">${
				prod.name
			}</span></h5>
                    </div>
                </div>
                <div class="total-amount-transacted">${
					transaction.paid_amount_currency + transaction.paid_amount
				}</div>
                <div class="date-of-transaction">
                    <h5 style="font-size: 12px;">${transaction.created}</h5>
                </div>
            `;
			latesttransactionscontent.append(transactionDiv);
		}
	});
}

function getGoals() {
	fetchCall("showgoals.php", responseGoals);
	function responseGoals(data) {
		const incomegoalamountdiv = document.getElementById(
			"income-goal-amount-div"
		);
		const expensegoalamountdiv = document.getElementById(
			"expense-goal-amount-div"
		);
		var earni = parseFloat(data.goals.earning_goal);
		var spendi = parseFloat(data.goals.spending_goal);
		incomegoalamountdiv.textContent = "Ksh" + earni.toLocaleString("en-US");
		expensegoalamountdiv.textContent = "Ksh" + spendi.toLocaleString("en-US");
	}
}

var yearsdata = [];
function getEarnings() {
	var ydata = [];
	fetchCall("earningspm.php", responseEarnings);
	function responseEarnings(data) {
		const amountearnedfrombsness = document.getElementById(
			"amount-earned-from-bsness"
		);
		const earnings = data.allearnings;
		var totalearn = 0;
		earnings.forEach((earning) => {
			const month = earning.month;
			const totals = parseFloat(earning.amount);
			ydata.push(totals);
			totalearn = totalearn + totals;
			const dateObj = new Date();
			const monthNumber = dateObj.getMonth();
			if (month == monthNumber + 1) {
				amountearnedfrombsness.textContent =
					"Ksh" + totalearn.toLocaleString("en-US");
			}
		});
	}
	yearsdata = ydata;
}

function getSpending() {
	fetchCall("spendingpm.php", responseSpending);
	function responseSpending(data) {
		const amountspenttotal = document.getElementById("amount-spent-total");
		const spendings = data.allspendings;
		var totalearn = 0;
		spendings.forEach((spending) => {
			const month = spending.curmonth;
			const dateObj = new Date();
			const monthNumber = dateObj.getMonth();
			if (month == monthNumber + 1) {
				totalearn = parseFloat(spending.totals);
				amountspenttotal.textContent =
					"Ksh" + totalearn.toLocaleString("en-US");
			}
		});
	}
}

function getSoldPros() {
	fetchCall("productsold.php", responsePros);
	function responsePros(data) {
		const numberofprossold = document.getElementById("number-of-pros-sold");
		const numbersold = parseInt(data.prosold);
		numberofprossold.textContent = numbersold;
	}
}

function getCustomersNo() {
	fetchCall("totalcustomers.php", responseCust);
	function responseCust(data) {
		const numberofnewcustomers = document.getElementById(
			"number-of-new-customers"
		);
		const customerNo = parseInt(data.number);
		numberofnewcustomers.textContent = customerNo;
	}
}

const ctx = document.getElementById("myChart").getContext("2d");
function getChart() {
	setTimeout(() => {
		const myChart = new Chart(ctx, {
			type: "bar",
			data: {
				labels: [
					"January",
					"February",
					"March",
					"April",
					"May",
					"June",
					"July",
					"August",
					"September",
					"October",
					"November",
					"December",
				],
				datasets: [
					{
						label: "Month's income in '$'",
						data: yearsdata,
						backgroundColor: [
							"rgba(255, 99, 132, 1)",
							"rgba(54, 162, 235, 1)",
							"rgba(255, 206, 86, 1)",
							"rgba(75, 192, 192, 1)",
							"rgba(153, 102, 255, 1)",
							"rgba(255, 159, 64, 1)",
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
