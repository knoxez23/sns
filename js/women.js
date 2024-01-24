document.addEventListener("DOMContentLoaded", getCategoryProducts);
document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", setLocationLoaded);

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

function getCategoryProducts() {
	fetchCall(`women.inc.php`, responseCategoPros);
	function responseCategoPros(data) {
		const totalNum = data.totalpros;
		const products = data.products;
		if (products) {
			bttmCatalogSection.innerHTML = ``;
			var thData = pagination(products, state.page, state.pros);
			var GeCateproducts = thData.querySet;
			if (totalNum == 0) {
				bttmCatalogSection.innerHTML = `
				<div class='unlisted' id='unlisted'>
					<h2>Looks like the Womens category is empty</h2>
					<h2 style='color: blue; text-decoration: underline;'>Please contact us for more information about any product</h2>
				</div>
			`;
			} else {
				populateCatalogue(GeCateproducts, bttmCatalogSection);
				pageButtons(thData.pages, products);
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
			url: "./php/womenfilter.php",
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
	$("#sortByWomen").on("change", function () {
		var sortWomen = $(this).val();
		$.ajax({
			url: "./php/sort.inc.php",
			method: "GET",
			data: { sortWomen: sortWomen },
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
