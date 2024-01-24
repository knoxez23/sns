document.addEventListener("DOMContentLoaded", getDiscounts);
//document.addEventListener('DOMContentLoaded', popCountrytoDb)
document.addEventListener("DOMContentLoaded", () => {
	const countrySelect = document.getElementById("countries");

	fetch("https://restcountries.com/v2/region/Americas")
		.then((res) => {
			return res.json();
		})
		.then((countries) => {
			countries.forEach((country) => {
				const option = document.createElement("option");
				option.setAttribute("value", country.name);
				option.textContent = country.name;
				countrySelect.append(option);
			});
		})
		.catch((err) => {
			console.log(err);
		});
});

function popCountrytoDb() {
	fetch("https://restcountries.com/v2/region/Americas")
		.then((res) => {
			return res.json();
		})
		.then((countries) => {
			console.log(countries);
			$.ajax({
				url: "../php/populatecountries.php",
				method: "POST",
				data: { countries: countries },
				success: function (data) {
					console.log(data);
				},
			});
		})
		.catch((err) => {
			console.log(err);
		});
}

const coupname = document.getElementById("coupname");
const coupcode = document.getElementById("coupcode");
const coupamount = document.getElementById("coupamount");
const collCoupCrit = document.getElementById("coll-coup-criteria");
const specCoupCrit = document.getElementById("spec-coup-criteria");
const collcouponbtn = document.getElementById("coll-coupon-btn");
const speccouponbtn = document.getElementById("spec-newsletter-btn");
const couponactivebtn = document.getElementById("coupon-active-btn");

function getDiscounts() {
	fetchCall("loaddiscounts.php", responseDiscounts);
	function responseDiscounts(data) {
		const discounts = data.coupons;
		populateDiscounts(discounts);
	}
}

const cont = document.getElementById("discounts-cont");

function populateDiscounts(discounts) {
	discounts.forEach((discount) => {
		const div = document.createElement("div");
		div.className = "discount-div";

		var eligibility = "";
		var status = "";
		var classs = "";

		if (discount.criteria == 1) {
			eligibility = "All Subscribers";
		} else if (discount.criteria == 2) {
			eligibility = "All Registered Users";
		} else if (discount.criteria == 3) {
			eligibility = "All Customers";
		} else if (discount.criteria == 4) {
			eligibility = "First 100 Subscribers";
		} else if (discount.criteria == 5) {
			eligibility = "First 100 Registered Users";
		} else if (discount.criteria == 6) {
			eligibility = "First 100 Customers";
		}

		if (discount.status == 1) {
			status = "Deactivate";
			classs = "coupon-active-btn";
		} else {
			status = "Activate";
			classs = "coupon-inactive-btn";
		}

		div.innerHTML = `
            <div class="acoupon-name">${discount.name}</div>
            <div class="acoupon-amount">$${discount.amount}</div>
            <div class="acoupon-eligibility">${eligibility}</div>
            <form class="acoupon-status" action='../php/deactivatecoupon.php' method='POST'>
                <input type='hidden' name='id' value='${discount.id}'/>
                <input type='hidden' name='status' value='${discount.status}'/>
                <button id="${classs}">${status}</button>
            </form>
            <div class="acoupon-date">${discount.date}</div>
        `;

		cont.append(div);
	});
}
