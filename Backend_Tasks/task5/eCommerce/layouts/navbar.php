<?php

use App\Database\Models\Category;
use App\Database\Models\Subcategory;

$category = new Category;
$subcategory = new Subcategory;

$categoriesData = $category->all()->get_result();
if ($categoriesData->num_rows >= 1) {
    $categories = $categoriesData->fetch_all(MYSQLI_ASSOC);
}
?>
<!-- header start -->
<header class="header-area gray-bg clearfix">
    <div class="header-bottom">

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="logo">
                        <a href="index.php">
                            <img alt="" src="assets/img/logo/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-6">
                    <div class="header-bottom-right">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="top-hover"><a href="index.php">Langauge</a>
                                        <ul class="submenu">
                                            <li><a href="index.php">English </a></li>
                                            <li><a href="index-2.php">عربي</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about-us.php">about</a></li>
                                    <li class="mega-menu-position top-hover"><a href="shop.php">shop</a>
                                        <ul class="mega-menu">
                                            <?php
                                            if (!empty($categories)) {
                                                foreach ($categories as $cat) { ?>
                                                    <li>
                                                        <ul>
                                                            <li class="mega-menu-title h5"><a class="h5"  href="shop.php?category=<?= $cat['id']?>"><?= $cat['name_en'] ?></a></li>
                                                            <?php $subcategory->setCategory_id($cat['id']);
                                                            $categoriesData = $subcategory->getSubCategoryByCategoryId()->get_result();
                                                            if ($categoriesData->num_rows >= 1) {
                                                                foreach ($categoriesData->fetch_all(MYSQLI_ASSOC) as $sub) { ?>
                                                                    <li><a href="shop.php?subcategory=<?= $sub['id'] ?>"><?= $sub['name_en'] ?></a></li>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                            <?php }
                                            } ?>


                                        </ul>
                                    </li>

                                
                                    <li><a href="contact.php">contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <div class="header-currency">
                                <span class="digit"><?= $_SESSION['user']->name ?> <i class="ti-angle-down"></i></span>
                                <div class="dollar-submenu">
                                    <ul>
                                        <li><a href="my-account.php">My Account</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } else {
                        ?>
                            <div class="header-currency">
                                <span class="digit">Hello<i class="ti-angle-down"></i></span>
                                <div class="dollar-submenu">
                                    <ul>
                                        <li><a href="login.php">Login</a></li>
                                        <li><a href="register.php">Register</a></li>

                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="header-cart">
                            <a href="#">
                                <div class="cart-icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                            </a>
                            <div class="shopping-cart-content">
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote </a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote</a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-total">
                                    <h4>Shipping : <span>$20.00</span></h4>
                                    <h4>Total : <span class="shop-total">$260.00</span></h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a href="cart-page.php">view cart</a>
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">

                          
                      
                            <li><a href="contact.php"> Contact us </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- header end -->