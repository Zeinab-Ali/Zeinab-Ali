<?php

use App\Database\Models\Spec;
use App\Database\Models\Review;
use App\Database\Models\Product;
use App\Database\Models\Category;
use App\Http\Requests\Validation;

$title = "Product Details";
include_once "layouts/header.php";
$validation = new Validation;

if ($_GET) {
    if (isset($_GET['product'])) {

        if (is_numeric($_GET['product'])) {
            $pro = new Product;
            $spec = new Spec;
            $review = new Review;

            $pro->setId($_GET['product']);
            $proResult = $pro->find()->get_result();
            if ($proResult->num_rows == 1) {
                $product = $proResult->fetch_object();
                //print_r($product);die;
                $pro->setSubcategory_id(intval($product->subcategory_id));
                $proSubResult = $pro->getProductsBySub()->get_result();
            } else {
                include "layouts/errors/404-not-found.php";
                die;
            }
        } else {
            include "layouts/errors/404-not-found.php";
            die;
        }
    } else {
        include "layouts/errors/404-not-found.php";
        die;
    }
} else {
    include "layouts/errors/404-not-found.php";
    die;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_review'])) {
    $validation->setKey('rating')->setValue($_POST['rating'])->required();
   
    if(empty($validation->getErrors())){
        $review = new Review;
       
        $review->setProduct_id( $_GET['product']);
        $review->setUser_id($_SESSION['user']->id);
        if(isset($_POST['reviw_massage']))
        $review->setComment($_POST['reviw_massage']);
        $review->setRate($_POST['rating']);
        try{
            $review->insert();
           // print_r($_POST['rating']);

        }catch(Exception $e){
            $review_error = "<p class='alert alert-danger text-center'>something went wrong</p>";
        }
    }

}


include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";

?>
<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="assets/img/product/<?= $product->image ?>" data-zoom-image="assets/img/product/<?= $product->image ?>" alt="zoom" />
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $product->name_en ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php
                            for ($i = 1; $i <= $product->reviews_avg; $i++) { ?>
                                <i class="ion-android-star-outline theme-star"></i>
                            <?php }
                            for ($i = 1; $i <= 5 - $product->reviews_avg; $i++) { ?>
                                <i class="ion-android-star-outline"></i>
                            <?php } ?>
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?= $product->reviews_count ?> Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $product->price ?> EGP</span>
                    <div class="in-stock">
                        <?php
                        if ($product->quantity >= 5) {
                            $message = "In Stock";
                            $color = "success";
                        } elseif ($product->quantity > 0 && $product->quantity < 5) {
                            $message = "In Stock({$product->quantity})";
                            $color = "warning";
                        } else {
                            $message = "Outof Stock";
                            $color = "danger";
                        }
                        ?>
                        <p>Available: <span class="text-<?= $color ?>"><?= $message ?></span></p>
                    </div>
                    <p><?= $product->details_en ?></p>
                    <div class="pro-dec-feature">
                        <ul>

                            <?php
                            $specsResult = $spec->getSpecs($_GET['product'])->get_result();
                            if ($specsResult->num_rows >= 1) {
                                $specs = $specsResult->fetch_all(MYSQLI_ASSOC);
                                foreach ($specs as $spec) { ?>
                                    <li> <?= $spec['name'] ?>: <span> <?= $spec['value'] ?></span></li>
                            <?php }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                        </div>
                        <div class="shop-list-cart-wishlist">
                            <?php
                            if ($product->quantity > 0) { ?>
                                <a title="Add To Cart" href="#">
                                    <i class="icon-handbag"></i>
                                </a>
                            <?php }
                            ?>
                            <a title="Wishlist" href="#">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pro-dec-categories">
                        <ul>
                            <li><a href="shop.php?category=<?= $product->category_id ?>"><?= $product->category_name_en ?>,</a></li>
                            <li><a href="shop.php?subcategory=<?= $product->subcategory_id ?>"><?= $product->subcategory_name_en ?>,</a></li>
                            <li><a href="shop.php?brand=<?= $product->brand_id ?>"><?= $product->brand_name_en ?> </a></li>
                        </ul>
                    </div>

                    <div class="pro-dec-social">
                        <ul>
                            <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                            <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                            <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                            <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details2">Tags</a>
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p><?= $product->details_en ?></p>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            <li><span>Tags:</span></li>
                            <li><a href="#"> Green,</a></li>
                            <li><a href="#"> Herbal,</a></li>
                            <li><a href="#"> Loose,</a></li>
                            <li><a href="#"> Mate,</a></li>
                            <li><a href="#"> Organic ,</a></li>
                            <li><a href="#"> special</a></li>
                        </ul>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">
                        <?php
                        $reviewStmt = $review->getReviews($product->id)->get_result();
                        // print_r($reviewStmt);die;
                        if ($reviewStmt->num_rows >= 1) {
                            foreach ($reviewStmt->fetch_all(MYSQLI_ASSOC) as $review) { ?>
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php
                                            for ($i = 1; $i <= $review['rate']; $i++) { ?>
                                                <i class="ion-star theme-color"></i>
                                            <?php }
                                            for ($i = 1; $i <= 5 - $review['rate']; $i++) { ?>
                                                <i class="ion-android-star-outline"></i>
                                            <?php } ?>
                                            <span>(<?= $review['rate'] ?>)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3><?= $review['name'] ?></h3>
                                            <span><?= $review['created_at'] ?></span>
                                        </div>
                                    </div>
                                    <p><?= $review['comment'] ?></p>
                                </div>
                        <?php  }
                        }
                        ?>

                    </div>
                    <?php
                    if (!empty($_SESSION['user'])) { ?>
                        <div class="ratting-form-wrapper">
                            <h3>Add your Comments :</h3>
                            <div class="ratting-form">
                                <form action="#" method="POST">
                                    <div class="star-box">
                                        <h2>Rating:</h2>
                                        <?= isset($review_error) ?  "<p class='text-success text-center font-weight-bold  '>" . $review_error . "</p>" : "" ?>

                                        <div class="rating-stars">
                                            <input type="radio" name="rating" value="0" id="rs0" checked><label class="lab" for="rs0"></label>
                                            <input type="radio" name="rating" value="1" id="rs1"><label class="lab" for="rs1"></label>
                                            <input type="radio" name="rating" value="2" id="rs2"><label class="lab" for="rs2"></label>
                                            <input type="radio" name="rating" value="3" id="rs3"><label class="lab" for="rs3"></label>
                                            <input type="radio" name="rating" value="4" id="rs4"><label class="lab" for="rs4"></label>
                                            <input type="radio" name="rating" value="5" id="rs5"><label class="lab" for="rs5"></label>
                                            <span class="rating-counter"></span>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="rating-form-style form-submit">
                                                <textarea  name="reviw_massage" placeholder="Message"></textarea>
                                                <input type="submit" name="add_review" value="add review">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-white">Related Products</h3>
            </div>
        </div>
        <div class="row">
            <?php
            $count = 0;
            foreach ($proSubResult->fetch_all(MYSQLI_ASSOC) as $sub) {
                // print_r($sub);
                if ($count == 3)
                    break;
                $count++;
            ?>
                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                    <div class="product-wrapper">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.php?product=<?= $sub['id'] ?>"><?= $sub['name_en'] ?></a>
                            </h4>
                        </div>
                        <div class="product-img">

                            <a href="product-details.php?product=<?= $sub['id'] ?>">
                                <img alt="" src="assets/img/product/<?= $sub['image'] ?>" data-zoom-image="assets/img/product/<?= $sub['image'] ?>" alt="<?= $sub['name_en'] ?>" />
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
                                    <i class="ion-android-favorite-outline"></i>
                                </a>
                                <a class="action-cart" href="#" title="Add To Cart">
                                    <i class="ion-ios-shuffle-strong"></i>
                                </a>
                                <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content text-left">
                            <div class="product-hover-style">
                                <div class="product-title">
                                    <h4>
                                        <a href="product-details.php"><?= $sub['name_en'] ?></a>
                                    </h4>
                                </div>
                                <div class="cart-hover">
                                    <h4><a href="product-details.php">+ Add to cart</a></h4>
                                </div>
                            </div>
                            <div class="product-price-wrapper">
                                <span><?= $sub['price'] ?>EGP</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Footer style Start -->
<footer class="footer-area pt-75 gray-bg-3">
    <div class="footer-top gray-bg-3 pb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title mb-25">
                            <h4>My Account</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="my-account.php">My Account</a></li>
                                <li><a href="about-us.php">Order History</a></li>
                                <li><a href="wishlist.php">WishList</a></li>
                                <li><a href="#">Newsletter</a></li>
                                <li><a href="about-us.php">Order History</a></li>
                                <li><a href="#">International Orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title mb-25">
                            <h4>Information</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="about-us.php">About Us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title mb-25">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="#">Support Center</a></li>
                                <li><a href="#">Term & Conditions</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">FAQS</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer-widget-red footer-black-color mb-40">
                        <div class="footer-title mb-25">
                            <h4>Contact Us</h4>
                        </div>
                        <div class="footer-about">
                            <p>Your current address goes to here,120 haka, angladesh</p>
                            <div class="footer-contact mt-20">
                                <ul>
                                    <li>(+008) 254 254 254 25487</li>
                                    <li>(+009) 358 587 657 6985</li>
                                </ul>
                            </div>
                            <div class="footer-contact mt-20">
                                <ul>
                                    <li>yourmail@example.com</li>
                                    <li>example@admin.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pb-25 pt-25 gray-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright">
                        <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="payment-img f-right">
                        <a href="#">
                            <img alt="" src="assets/img/icon-img/payment.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer style End -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="assets/img/product-details/product-detalis-l1.jpg" alt="">
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="assets/img/product-details/product-detalis-l2.jpg" alt="">
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="assets/img/product-details/product-detalis-l3.jpg" alt="">
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="assets/img/product-details/product-detalis-l4.jpg" alt="">
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="product-thumbnail">
                            <div class="thumb-menu owl-carousel nav nav-style" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="assets/img/product-details/product-detalis-s1.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-2"><img src="assets/img/product-details/product-detalis-s2.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-3"><img src="assets/img/product-details/product-detalis-s3.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-4"><img src="assets/img/product-details/product-detalis-s4.jpg" alt=""></a>
                            </div>
                        </div>
                        <!-- Thumbnail image end -->
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="modal-pro-content">
                            <h3>Dutchman's Breeches </h3>
                            <div class="product-price-wrapper">
                                <span class="product-price-old">£162.00 </span>
                                <span>£120.00</span>
                            </div>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet.</p>
                            <div class="quick-view-select">
                                <div class="select-option-part">
                                    <label>Size*</label>
                                    <select class="select">
                                        <option value="">S</option>
                                        <option value="">M</option>
                                        <option value="">L</option>
                                    </select>
                                </div>
                                <div class="quickview-color-wrap">
                                    <label>Color*</label>
                                    <div class="quickview-color">
                                        <ul>
                                            <li class="blue">b</li>
                                            <li class="red">r</li>
                                            <li class="pink">p</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-quantity">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                </div>
                                <button>Add to cart</button>
                            </div>
                            <span><i class="fa fa-check"></i> In stock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<!-- all js here -->
<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/ajax-mail.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>