<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="./css/products.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="pro-page">
            <div class="left-section">
                <div class="pro-top-part">
                    <div class="path">
                        <a href="index.php">Main Page</a>
                        <iconify-icon icon="material-symbols-light:arrow-right" width="20"></iconify-icon><a id="pro-category-path" href="#"></a>
                        <iconify-icon icon="material-symbols-light:arrow-right" width="20"></iconify-icon><a id="pro-name-path" href="#"></a>
                    </div>
                    <div class="pro-full-title"></div>
                    <div class="pro-full-price">
                        <div class="pro-page-price"></div>
                    </div>
                </div>
                <div class="pro-bottom-part">
                    <div class="pro-left-specs">
                        <div class="short-desc"></div>
                        <h3 class='alert-size'>Please enter the size you want</h3>
                        <div class='stock-size'>
                            <div class="stock-report"></div>
                            <div class='size'>
                                <label for="size">Enter size:</label>
                                <input type="text" id='shoe-size' name='size'>
                            </div>
                        </div>
                        <div class="cart-btns">
                            <div class="cart-add">
                                <button class="btn-addtocart" id="prod-cart-add">Add to Cart</button>
                                <div class="cart-qty-div">
                                    <div class="incr qty-actions" id="prod-incr-cart-amnt"><i class="fa-solid fa-plus"></i></div>
                                    <div class="qty-amount" id="prod-amount-cart">1</div>
                                    <div class="decr qty-actions" id="prod-decr-cart-amnt"><i class="fa-solid fa-minus"></i></div>
                                </div>
                            </div>
                            <button class="btn-favorite" id="prod-wishlist-add">Favorite</button>
                        </div>
                        <div class="full-desc">
                            <article class="pro-full-specs">
                                <div class="pro-specs-title">
                                    <h4>DESCRIPTION</h4>
                                    <div class="arr"></div>
                                </div>
                                <div class="pro-specs-content"></div>
                            </article>
                            <article class="pro-full-specs">
                                <div class="pro-specs-title">
                                    <h4>SHIPPING & RETURNS</h4>
                                    <div class="arr"></div>
                                </div>
                                <div class="pro-specs-content">
                                    <p>At SN-Store, we provide nationwide delivery of our extensive range of sneakers. We understand the importance of a perfect fit and customer satisfaction. If, for any reason, you find yourself unsatisfied with your purchase, we offer a straightforward refund process. Our commitment is to ensure you walk away in both comfort and style. Explore our latest trends and timeless classics, and experience the difference at SN-Store.</p>
                                </div>
                            </article>
                        </div>
                        <div class="reviews-section">
                            <div class="reviews-section-title">
                                <h4>REVIEWS (<span id="total-reviews-count">0</span>)</h4>
                            </div>
                            <div class="reviews-section-content">
                                <div class="average-total-ratings">
                                    <div class="left-average-rating-number">
                                        <h2 id="average-rating-value">0.0</h2>
                                        <i class="fas fa-star" style="color: yellow;"></i>
                                    </div>
                                    <div class="right-average-rating-picture">
                                        <div class="rating-star">
                                            <h3>5</h3>
                                            <div class="rating-lines">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five-star-progress"></div>
                                            </div>
                                            <h4>(<span id="total-five-star-review">0</span>)</h4>
                                        </div>
                                        <div class="rating-star">
                                            <h3>4</h3>
                                            <div class="rating-lines">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four-star-progress"></div>
                                            </div>
                                            <h4>(<span id="total-four-star-review">0</span>)</h4>
                                        </div>
                                        <div class="rating-star">
                                            <h3>3</h3>
                                            <div class="rating-lines">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three-star-progress"></div>
                                            </div>
                                            <h4>(<span id="total-three-star-review">0</span>)</h4>
                                        </div>
                                        <div class="rating-star">
                                            <h3>2</h3>
                                            <div class="rating-lines">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two-star-progress"></div>
                                            </div>
                                            <h4>(<span id="total-two-star-review">0</span>)</h4>
                                        </div>
                                        <div class="rating-star">
                                            <h3>1</h3>
                                            <div class="rating-lines">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one-star-progress"></div>
                                            </div>
                                            <h4>(<span id="total-one-star-review">0</span>)</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviewers-comments-section">
                                    <div class="actual-comments" id="all-users-reviews">
                                        <div class="no-reviews-yet">
                                            Be the First to Review this Product...
                                        </div>
                                    </div>
                                    <!-- <div class="expand-see-more">See More</div> -->
                                </div>
                                <div class="add-your-review-section">
                                    <h3>ADD YOUR REVIEW</h3>
                                    <h4 id='success-message-review'></h4>
                                    <div class='add-review-section'>
                                        <div class='add-review-ratings'>
                                            <h4>Your rating: </h4>
                                            <div>
                                                <i class='fas fa-star sim submit_star' id='submit_star_1' data-rating='1'></i>
                                                <i class='fas fa-star sim submit_star' id='submit_star_2' data-rating='2'></i>
                                                <i class='fas fa-star sim submit_star' id='submit_star_3' data-rating='3'></i>
                                                <i class='fas fa-star sim submit_star' id='submit_star_4' data-rating='4'></i>
                                                <i class='fas fa-star sim submit_star' id='submit_star_5' data-rating='5'></i>
                                            </div>
                                        </div>
                                        <div class='review-add-form'>
                                            <input type='hidden' id='product-review-id' name='prodId' value=''>
                                            <input type='hidden' id='user-review-id' name='userId' value='<?php $_SESSION['userid'] ?>'>
                                            <input type='text' id='user-review-add-name' name='username' placeholder='First Name'>
                                            <textarea name='review' id='user-review' placeholder='Your Review'></textarea>
                                            <?php
                                            if (isset($_SESSION['userid'])) {
                                                echo "<button type='button' name='addreview' id='review-submit-btn'>SUBMIT REVIEW</button>";
                                            } else {
                                                echo "<a href='signin.php' class='login-review-btn'>Login to add a review</a>";
                                            }
                                            ?>
                                            <h6 id='error-review-message'></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <aside class=" right-section-div">
                <div class="right-section">
                    <div class="shoe-full-display">
                        <div class="shoe-full-image"></div>
                    </div>
                    <div class="shoe-small-display">
                        <div class="shoe-small1"></div>
                    </div>
                </div>
            </aside>
        </section>

        <?php
        include_once './components/topproducts.php';
        ?>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        const sizeBtns = document.querySelectorAll(".size");
        let checkedBtn = 0;

        sizeBtns.forEach((item, i) => {
            item.addEventListener('click', () => {
                if (!(item.classList.contains('inactive'))) {
                    sizeBtns[checkedBtn].classList.remove('checked');
                    item.classList.add('checked');
                    checkedBtn = i;
                }
            })
        })

        const thumbs = document.querySelector(".shoe-small-display").children;

        function changeImage(event) {
            document.querySelector(".full-prod-image").src = event.src;
        }
    </script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/minicart.js"></script>
    <script src="./js/products.js"></script>
    <script src="./js/review.js"></script>
</body>

</html>