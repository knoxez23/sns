const prodURL = window.location.search;
const urldParams = new URLSearchParams(prodURL);
var prodId = urldParams.get("getsearch");

const prodReviewId = document.getElementById("product-review-id");
prodReviewId.setAttribute("value", prodId);

$(document).ready(function () {
	var rating_data = 5;

	$(document).on("mouseenter", ".submit_star", function () {
		var rating = $(this).data("rating");

		resetColors();
		for (var count = 1; count <= rating; count++) {
			$("#submit_star_" + count).addClass("sim");
		}
	});

	function resetColors() {
		for (var count = 1; count <= 5; count++) {
			$("#submit_star_" + count).removeClass("sim");
		}
	}

	$(document).on("click", ".submit_star", function () {
		rating_data = $(this).data("rating");

		for (var count = 1; count <= rating_data; count++) {
			$("#submit_star_" + count).addClass("sim");
		}
	});

	$("#review-submit-btn").click(function () {
		var product_id = $("#product-review-id").val();
		var user_id = $("#user-review-id").val();
		var actual_review = $("#user-review").val();
		var user_name = $("#user-review-add-name").val();

		if (actual_review == "" || user_name == "") {
			$("#error-review-message").html("Please fill in all the fields");
			return false;
		} else {
			$.ajax({
				url: "./php/review.inc.php",
				method: "POST",
				data: {
					rating_data: rating_data,
					product_id: product_id,
					user_id: user_id,
					review: actual_review,
					user_name: user_name,
				},
				success: function (data) {
					$("#error-review-message").css("display", "none");
					$("#success-message-review").html(
						"Your review has been shared with us"
					);
					window.location.reload();
				},
			});
		}
	});
});

fetchCall(`review.inc.php?prodId=${prodId}`, responseReview);
function responseReview(data) {
	const reviews = data.reviews;
	const reviewsNo = data.noofreviews;
	var five_star_rating = 0;
	var four_star_rating = 0;
	var three_star_rating = 0;
	var two_star_rating = 0;
	var one_star_rating = 0;
	var total_users_ratings = 0;
	var average_rating = 0;
	const reviewerscommentssection = document.querySelector(
		".reviewers-comments-section"
	);

	reviews.forEach((review) => {
		if (review.rating === 5) {
			five_star_rating++;
		}
		if (review.rating === 4) {
			four_star_rating++;
		}
		if (review.rating === 3) {
			three_star_rating++;
		}
		if (review.rating === 2) {
			two_star_rating++;
		}
		if (review.rating === 1) {
			one_star_rating++;
		}

		total_users_ratings = total_users_ratings + review.rating;
	});

	average_rating = total_users_ratings / reviewsNo;
	average_rating = average_rating.toFixed(1);

	if (reviews.length > 3) {
		const seeMore = document.createElement("div");
		seeMore.className = "expand-see-more";
		seeMore.textContent = "See More";
		reviewerscommentssection.append(seeMore);
	}

	if (reviews.length > 0) {
		const totalreviewscount = document.getElementById(
			"total-reviews-count"
		);
		totalreviewscount.textContent = reviewsNo;
		const averageratingvalue = document.getElementById(
			"average-rating-value"
		);
		averageratingvalue.textContent = average_rating;
		const totalfivestarreview = document.getElementById(
			"total-five-star-review"
		);
		totalfivestarreview.textContent = five_star_rating;
		const totalfourstarreview = document.getElementById(
			"total-four-star-review"
		);
		totalfourstarreview.textContent = four_star_rating;
		const totalthreestarreview = document.getElementById(
			"total-three-star-review"
		);
		totalthreestarreview.textContent = three_star_rating;
		const totaltwostarreview = document.getElementById(
			"total-two-star-review"
		);
		totaltwostarreview.textContent = two_star_rating;
		const totalonestarreview = document.getElementById(
			"total-one-star-review"
		);
		totalonestarreview.textContent = one_star_rating;

		const fivestarprogress = document.getElementById("five-star-progress");
		fivestarprogress.style.width =
			(five_star_rating / reviewsNo) * 100 + "%";
		const fourstarprogress = document.getElementById("four-star-progress");
		fourstarprogress.style.width =
			(four_star_rating / reviewsNo) * 100 + "%";
		const threestarprogress = document.getElementById(
			"three-star-progress"
		);
		threestarprogress.style.width =
			(three_star_rating / reviewsNo) * 100 + "%";
		const twostarprogress = document.getElementById("two-star-progress");
		twostarprogress.style.width = (two_star_rating / reviewsNo) * 100 + "%";
		const onestarprogress = document.getElementById("one-star-progress");
		onestarprogress.style.width = (one_star_rating / reviewsNo) * 100 + "%";

		const popReviews = reviews.slice(0, 3);
		populateReviews(popReviews);

		const seemorereviews = document.querySelector(".expand-see-more");
		seemorereviews.addEventListener("click", () => {
			if (!seemorereviews.classList.contains("open")) {
				populateReviews(reviews);
				seemorereviews.classList.add("open");
				seemorereviews.textContent = "See Less";
			} else {
				populateReviews(popReviews);
				seemorereviews.classList.remove("open");
				seemorereviews.textContent = "See More";
			}
		});
	}
}

function populateReviews(reviews) {
	const allusersreviews = document.getElementById("all-users-reviews");
	allusersreviews.innerHTML = ``;
	reviews.forEach((review) => {
		const reviewComment = document.createElement("div");
		reviewComment.className = "reviewer-comment";

		const reviewerTitleSec = document.createElement("div");
		reviewerTitleSec.className = "reviewer-comment-title";
		const actualRating = document.createElement("div");
		actualRating.className = "reviewer-actual-rating";
		for (var star = 1; star <= 5; star++) {
			var class_name = "";
			if (review.rating >= star) {
				class_name = "sim";
			} else {
				class_name = "";
			}
			const starIcon = document.createElement("i");
			starIcon.className = "fas fa-star " + class_name;
			actualRating.append(starIcon);
		}
		const reviewersName = document.createElement("div");
		reviewersName.className = "reviewer-actual-name";
		reviewersName.textContent = "By " + review.user_name;
		const reviewDate = document.createElement("div");
		reviewDate.className = "reviewer-date-posted";
		reviewDate.textContent = review.date;
		reviewerTitleSec.append(actualRating);
		reviewerTitleSec.append(reviewersName);
		reviewerTitleSec.append(reviewDate);

		const reviewContent = document.createElement("div");
		reviewContent.className = "reviewer-comment-content";
		reviewContent.textContent = review.comment;

		reviewComment.append(reviewerTitleSec);
		reviewComment.append(reviewContent);

		allusersreviews.append(reviewComment);
	});
}
