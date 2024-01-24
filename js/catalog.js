document.addEventListener("DOMContentLoaded", requestAllCategories);
document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", setLocationLoaded);
const catalogPath = document.getElementById("catalog-cate-path");
const catalogTitle = document.getElementById("catalog-full-title");
const catalogBtn = document.getElementById("all-cate-pros");

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

function requestAllCategories() {
	const cateList = document.querySelectorAll(".nav-categories li");
	cateList.forEach((catego) => {
		if (catego.classList.contains(localStorage.getItem("category"))) {
			catego.style.color = "initial";
			catego.style.borderBottom = "initial";
		} else {
			catego.style.color = "initial";
			catego.style.borderBottom = "initial";
		}
	});
	fetchCall("allprods.php", responseAllCategoPros);
	function responseAllCategoPros(data) {
		const totalNum = data.alltotalpros;
		const products = data.allproducts;
		if (products) {
			bttmCatalogSection.innerHTML = ``;
			var theData = pagination(products, state.page, state.pros);
			var AllCateproducts = theData.querySet;
			if (totalNum == 0) {
				bttmCatalogSection.innerHTML = `
				<div class='unlisted' id='unlisted'>
					<h2>Looks like the Womens category is empty</h2>
					<h2 style='color: blue; text-decoration: underline;'>Please contact us for more information about any product</h2>
				</div>
			`;
			} else {
				populateCatalogue(AllCateproducts, bttmCatalogSection);
				pageButtons(theData.pages, products);
			}

			const totalPros = document.getElementById("result-number-pros");

			if (totalNum < 12) {
				totalPros.textContent = `Showing All of ${totalNum} results`;
			} else {
				totalPros.textContent = `Showing 12 of ${totalNum} results`;
			}
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
			url: "./php/filter.php",
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
				if (products.length > 0) {
					bttmCatalogSection.innerHTML = ``;
					var theData = pagination(products, state.page, state.pros);
					var AllCateProducts = theData.querySet;
					populateCatalogue(AllCateProducts, bttmCatalogSection);
					pageButtons(theData.pages, products);
					$("#result-number-pros").text("Showing All results");
				} else {
					bttmCatalogSection.innerHTML = `
						<div class='unlisted' id='unlisted'>
							<h2>Looks like the product is not listed</h2>
							<h2 style='color: blue; text-decoration: underline;'>Please contact us for more information about the product</h2>
						</div>
					`;
					$("#result-number-pros").text("Showing 0 results");
				}
			},
		});
	});
});

$(document).ready(function () {
	$("#sortByShop").on("change", function () {
		var sortAll = $(this).val();
		$.ajax({
			url: "./php/sort.inc.php",
			method: "GET",
			data: { sortAll: sortAll },
			success: function (data) {
				const pros = JSON.parse(data).sort;
				const nopros = JSON.parse(data).totalpros;
				if (pros) {
					bttmCatalogSection.innerHTML = ``;
					var theData = pagination(pros, state.page, state.pros);
					var AllCateProducts = theData.querySet;
					populateCatalogue(AllCateProducts, bttmCatalogSection);
					pageButtons(theData.pages, pros);
					$("#result-number-pros").text(
						`Showing All of ${nopros} results`
					);
				}
			},
		});
	});
});
