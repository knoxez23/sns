document.addEventListener("DOMContentLoaded", getCategoryProducts);
document.addEventListener("DOMContentLoaded", requestFeatPro);
document.addEventListener("DOMContentLoaded", setLocationLoaded);

function setLocationLoaded() {
	sessionStorage.setItem("current_path", window.location.pathname);
	sessionStorage.setItem("current_search", window.location.search);
}

function pagination(querySet, page, pros) {
	var trimStart = (page - 1) * pros;
	var trimEnd = trimStart + pros;
	var trimmedData = querySet.slice(trimStart, trimEnd);
	var pages = Math.ceil(querySet.length / pros);

	return {
		querySet: trimmedData,
		pages: pages,
	};
}

function getProDetails() {
	window.location.href =
		"products.php" + "?name=" + this.name + "&getsearch=" + this.id;
}

var state = {
	page: 1,
	pros: 12,
	window: 5,
};

function requestFeatPro() {
	fetchCall("featured.php", responseFeatPro);
	function responseFeatPro(data) {
		if (data.featured) {
			const featureSection = document.getElementById("toppro");
			const topproCard = document.querySelector(".toppro-cards");
			const topslider = document.querySelector(".topslider");
			populatePros(data.featured, featureSection, topproCard, topslider);
		}
	}
}

function pageButtons(pages, CataParent) {
	var paginationWrapper = document.querySelector(".pagination");
	paginationWrapper.innerHTML = ``;

	var maxLeft = state.page - Math.floor(state.window / 2);
	var maxRight = state.page + Math.floor(state.window / 2);

	var previousPage = state.page;

	if (maxLeft < 1) {
		maxLeft = 1;
		maxRight = state.window;
	}

	if (maxRight > pages) {
		maxLeft = pages - (state.window - 1);

		if (maxLeft < 1) {
			maxLeft = 1;
		}
		maxRight = pages;
	}

	paginationWrapper.innerHTML += `<button class="prev-page pagin-btn">Prev</button>`;

	for (var page = maxLeft; page <= maxRight; page++) {
		paginationWrapper.innerHTML += `<button value=${page} class="page ${page} pagin-btn">${page}</button>`;
	}

	if (state.page != pages) {
		paginationWrapper.innerHTML += `<button value=${page} class="next-page pagin-btn">Next</button>`;
	}

	$("." + previousPage).addClass("active-btn-page");

	$(".page").on("click", function () {
		$(bttmCatalogSection).empty();
		$("." + previousPage).removeClass("active-btn-page");
		state.page = Number($(this).val());
		var currentPage = state.page;
		$("." + currentPage).addClass("active-btn-page");
		previousPage = currentPage;
		var theData = pagination(CataParent, state.page, state.pros);
		populateCatalogue(theData.querySet, bttmCatalogSection);
	});

	$(".next-page").on("click", function () {
		if (state.page != pages) {
			$(bttmCatalogSection).empty();
			$("." + previousPage).removeClass("active-btn-page");
			state.page = state.page + 1;
			var currentPage = state.page;
			$("." + currentPage).addClass("active-btn-page");
			previousPage = currentPage;
			var theData = pagination(CataParent, state.page, state.pros);
			populateCatalogue(theData.querySet, bttmCatalogSection);
		}
	});

	$(".prev-page").on("click", function () {
		$(bttmCatalogSection).empty();
		if (state.page > 1) {
			$("." + previousPage).removeClass("active-btn-page");
			state.page = state.page - 1;
			var currentPage = state.page;
			$("." + currentPage).addClass("active-btn-page");
			previousPage = currentPage;
		}
		var theData = pagination(CataParent, state.page, state.pros);
		populateCatalogue(theData.querySet, bttmCatalogSection);
	});
}

function getCategoryProducts() {
	fetchCall(`onsale.php`, responseCategoPros);
	function responseCategoPros(data) {
		if (data.products) {
			bttmCatalogSection.innerHTML = ``;
			var thData = pagination(data.products, state.page, state.pros);
			var GeCateproducts = thData.querySet;
			populateCatalogue(GeCateproducts, bttmCatalogSection);
			pageButtons(thData.pages, data.products);
			if (data.totalpros) {
				const totalNum = data.totalpros;
				const totalPros = document.getElementById("result-number-pros");
				if (data.totalpros < 12) {
					totalPros.textContent = `Showing All of ${totalNum} results`;
				} else {
					totalPros.textContent = `Showing 12 of ${totalNum} results`;
				}
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
			url: "./php/salefilter.php",
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

$(document).ready(function () {
	$("#sortBySale").on("change", function () {
		var sortSale = $(this).val();
		$.ajax({
			url: "./php/sort.inc.php",
			method: "GET",
			data: { sortSale: sortSale },
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
