document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", setLocationLoaded);
const catalogPath = document.getElementById("catalog-cate-path");
const catalogTitle = document.getElementById("catalog-full-title");
const prosNum = document.getElementById("result-number-pros");
const unlisted = document.getElementById("unlisted");

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

const searchURL = window.location.search;
const urlQuery = new URLSearchParams(searchURL);

fetchCall(`searchengine.php?search=${urlQuery.get("q")}`, responseSearch);
function responseSearch(data) {
	const searchProducts = data.products;
	const numofPros = data.totalpros;
	if (searchProducts) {
		bttmCatalogSection.innerHTML = ``;
		var theData = pagination(searchProducts, state.page, state.pros);
		var AllCateProducts = theData.querySet;
		if (numofPros == 0) {
			bttmCatalogSection.innerHTML = `
				<div class='unlisted' id='unlisted'>
					<h2>Looks like the product you searched for is not listed</h2>
					<h2 style='color: blue; text-decoration: underline;'>Please contact us for more information about the product</h2>
				</div>
			`;
		} else {
			populateCatalogue(AllCateProducts, bttmCatalogSection);
			pageButtons(theData.pages, searchProducts);
		}
		catalogTitle.textContent = `Search results for '${urlQuery.get("q")}'`;
		if (numofPros < 12) {
			prosNum.textContent = "Showing All of " + numofPros + " results";
		} else {
			prosNum.textContent = "Showing 12 of " + numofPros + " results";
		}
	}
}

$(document).ready(function () {
	$("#apply-filter-btn").click(function () {
		var brand = $('input[name="brand[]"]:checked')
			.map(function (err, el) {
				return $(el).val();
			})
			.get();
		var stock = $('input[name="stock[]"]:checked')
			.map(function (err, el) {
				return $(el).val();
			})
			.get();
		var color = $('input[name="color[]"]:checked')
			.map(function (err, el) {
				return $(el).val();
			})
			.get();
		var minValue = $("#min-price").val();
		var maxValue = $("#max-price").val();

		$.ajax({
			url: "../php/filter.php",
			type: "GET",
			data: {
				brand: brand,
				stock: stock,
				color: color,
				minvalue: minValue,
				maxvalue: maxValue,
			},
			success: function (result) {
				const products = JSON.parse(result).filters;
				if (products) {
					bttmCatalogSection.innerHTML = ``;
					var theData = pagination(products, state.page, state.pros);
					var AllCateProducts = theData.querySet;
					populateCatalogue(AllCateProducts, bttmCatalogSection);
					pageButtons(theData.pages, products);
					$("#result-number-pros").text("Showing All results");
				}
			},
		});
	});
});
