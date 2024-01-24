document.addEventListener("DOMContentLoaded", getAllProducts);
const updatedProduct = document.querySelector(".update-product");
const noUpdateProduct = document.querySelector(".no-update-product");

function updateField(id, field, value, successCallback) {
	$.ajax({
		url: "./php/update_product.php",
		type: "POST",
		data: {
			id: id,
			field: field,
			value: value,
		},
		success: function (response) {
			const res = JSON.parse(response);
			if (res.status == "success") {
				successCallback();
			} else {
				noUpdateProduct.style.display = "block";
				setTimeout(() => {
					noUpdateProduct.style.display = "none";
				}, 2000);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("AJAX error: " + textStatus);
		},
	});
}

function getAllProducts() {
	fetchCall("allproducts.php", responseProducts);

	function responseProducts(data) {
		const allproducts = document.querySelector(
			".all-products-classes-content"
		);
		const totalproductsno = document.getElementById("total-products-no");
		const products = data.allproducts;
		totalproductsno.textContent = data.totalpros;

		const sortSelect = document.getElementById("sort-by");
		sortSelect.addEventListener("change", function () {
			const selectedField = this.value;
			sortProducts(products, selectedField);
			renderProducts(products);
		});

		function sortProducts(products, field) {
			switch (field) {
				case "name":
					products.sort((a, b) => a.name.localeCompare(b.name));
					break;
				case "brand":
					products.sort((a, b) =>
						(a.brand || "").localeCompare(b.brand || "")
					);
					break;
				case "category":
					products.sort((a, b) => a.category_id - b.category_id);
					break;
				case "price":
					products.sort((a, b) => a.price - b.price);
					break;
				case "stock":
					products.sort((a, b) => a.stock - b.stock);
					break;
				case "status":
					products.sort((a, b) => a.status - b.status);
					break;
				case "date":
					products.sort(
						(a, b) => new Date(b.date) - new Date(a.date)
					);
					break;
				default:
					products.sort((a, b) => a.name.localeCompare(b.name));
					break;
			}
		}

		function renderProducts(products) {
			allproducts.innerHTML = "";

			products.forEach((pro) => {
				const productDiv = document.createElement("div");
				productDiv.className = "product-class-div";

				const productId = document.createElement("div");
				productId.className = "product-id";
				productId.innerHTML = `<h3>${pro.id}</h3>`;

				const productImage = document.createElement("div");
				productImage.className = "product-image";
				productImage.innerHTML = `<div class="actual-image"><img src="${pro.image}" alt="${pro.name}"></div>`;

				const productName = document.createElement("div");
				productName.className = "allproduct-name";
				const prodInput = document.createElement("div");
				prodInput.className = "prod-input";
				prodInput.textContent = pro.name;
				prodInput.contentEditable = true;
				productName.append(prodInput);

				prodInput.onblur = function () {
					updateField(pro.id, "name", this.textContent, function () {
						updatedProduct.style.display = "block";
						setTimeout(() => {
							updatedProduct.style.display = "none";
						}, 2000);
					});
				};

				const productQty = document.createElement("div");
				productQty.className = "allproduct-stock";
				productQty.textContent = pro.stock;
				productQty.contentEditable = true;

				productQty.onblur = function () {
					updateField(pro.id, "stock", this.textContent, function () {
						updatedProduct.style.display = "block";
						setTimeout(() => {
							updatedProduct.style.display = "none";
						}, 2000);
					});
				};

				const productPrice = document.createElement("div");
				productPrice.className = "allproduct-price";
				const priceInput = document.createElement("div");
				priceInput.className = "price-input";
				priceInput.textContent = "Ksh. ";
				productPrice.append(priceInput);

				const priceValue = document.createElement("div");
				priceValue.className = "price-value";
				priceValue.textContent = pro.price;
				priceValue.contentEditable = true;

				priceValue.onblur = function () {
					updateField(pro.id, "price", this.textContent, function () {
						updatedProduct.style.display = "block";
						setTimeout(() => {
							updatedProduct.style.display = "none";
						}, 2000);
					});
				};

				productPrice.append(priceValue);

				const productBrand = document.createElement("div");
				productBrand.className = "allproduct-brand";
				if (pro.brand != null) {
					productBrand.textContent = pro.brand;
				} else {
					productBrand.textContent = "Generic";
				}
				productBrand.contentEditable = true;
				productBrand.onblur = function () {
					updateField(pro.id, "brand", this.textContent, function () {
						updateProduct.style.display = "block";
						setTimeout (() => {
							updatedProduct.style.display = "none";}, 2000);
					});
				};

				const productCategory = document.createElement("div");
				productCategory.className = "allproduct-category";
				const cateSelect = document.createElement("select");
				cateSelect.className = "all-prods-cateSelect";
				cateSelect.innerHTML = `
                    <select name="all-category-name" id="select-category-name">
                        <option value="1">Men's</option>
                        <option value="2">Women's</option>
                        <option value="3">Kid's</option>
                    </select>
                `;
				if (pro.category_id == 1) {
					cateSelect.selectedIndex = 0;
				} else if (pro.category_id == 2) {
					cateSelect.selectedIndex = 1;
				} else if (pro.category_id == 3) {
					cateSelect.selectedIndex = 2;
				}
				cateSelect.onchange = function () {
					const selectedCategory = this.value;
					updateField(
						pro.id,
						"category_id",
						selectedCategory,
						function () {
							updatedProduct.style.display = "block";
							setTimeout(() => {
								updatedProduct.style.display = "none";
							}, 2000);
						}
					);
				};

				productCategory.append(cateSelect);

				const productDate = document.createElement("div");
				productDate.className = "allproduct-date";

				if (pro.date) {
					const date = new Date(pro.date);

					const year = date.getFullYear();
					const month = date.getMonth() + 1;
					const day = date.getDate();

					const hour = date.getHours();
					const minute = date.getMinutes();
					const second = date.getSeconds();

					productDate.innerHTML = `
						<div class="date">
							${year}-${month < 10 ? "0" + month : month}-${day < 10 ? "0" + day : day}
						</div>
						<div class="time">
							${hour}:${minute}:${second}
						</div>
					`;
				} else {
					productDate.innerHTML = "No date available"; // Or any default text you want to display
				}


				var status = "";
				var classs = "";

				if (pro.status == 1) {
					status = "Deactivate";
					classs = "inactive";
				} else {
					status = "Activate";
					classs = "active";
				}

				const productStatus = document.createElement("div");
				productStatus.className = "allproduct-status";
				productStatus.innerHTML = `
                    <form action='./php/deactivateproduct.php' method='POST'>
                        <input type='hidden' name='prodid' value='${pro.id}'/>
                        <input type='hidden' name='status' value='${pro.status}'/>
                        <button class="${classs}" type='submit'>${status}</button>
                    </form>
                `;

				productDiv.append(productId);
				productDiv.append(productImage);
				productDiv.append(productName);
				productDiv.append(productBrand);
				productDiv.append(productCategory);
				productDiv.append(productPrice);
				productDiv.append(productQty);
				productDiv.append(productStatus);
				productDiv.append(productDate);
				allproducts.append(productDiv);
			});
		}

		renderProducts(products);
	}
}

function updateProduct(e) {
	const product = this;
	const status = e.target.value;
	const productId = product.id;
	const data = {
		status: status,
		prodid: productId,
	};

	$.ajax({
		url: "./php/deactivateproduct.php",
		method: "POST",
		data: data,
	});
}
