<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title><?= isset($title) ? $title : 'AgriExpress' ?></title>
    <meta content="" name="description">

    <!-- Stylesheets -->
    <link href="<?= base_url('assets/includes/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/includes/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/stylesheet.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/menu.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/includes/jquery/owl-carousel/owl.carousel.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/images/favicon.png') ?>" rel="icon">

    <!-- Scripts -->
    <script src="<?= base_url('assets/includes/jquery/jquery-2.1.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/includes/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.extra.js') ?>"></script>
    <script src="<?= base_url('assets/includes/common.js') ?>"></script>
    <script src="<?= base_url('assets/includes/jquery/owl-carousel/owl.carousel.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="common-home">
<a href="#" class="house-heaven"></a>

<!-- Top Navigation -->
<nav id="top">
    <div class="container">
        <div id="top-links">
            <ul class="list-inline">
                <li><a href="tel:0906430244"><i class="fa fa-phone"></i></a> <span>(090)6430244</span></li>
            </ul>
        </div>
        <div id="top-links2">
            <ul class="list-inline">
                <li><a href="#"><i class="fa fa-user"></i> <span>My Account</span></a></li>
                <li><a href="#" title="Wish List (0)" id="wishlist-total"><i class="fa fa-heart"></i> <span>Wishlist (0)</span></a></li>
                <li><a href="" title="Checkout"><i class="fa fa-shopping-bag"></i> <span>Checkout</span></a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div id="logo">
                    <a href="<?= base_url() ?>"><img alt="Agriculture" class="img-responsive" src="<?= base_url('assets/images/logo.png') ?>" title="Agriculture"></a>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="header-right">

                    <!-- Search -->
                    <div class="input-group" id="search">
                        <form method="GET" action="<?= base_url('products') ?>">
                            <div>
                                <input class="form-control input-lg" name="name" placeholder="Search" value="<?= htmlspecialchars($search ?? '', ENT_QUOTES) ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-lg" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <!-- Cart -->
                    <div class="btn-block btn-group" id="cart">
                        <button class="btn btn-viewcart dropdown-toggle" type="button">
                            <span class="lg">My Cart</span>
                            <span id="cart-total"><i class="fa fa-shopping-basket"></i> (<?= count($cart ?? []) ?>) items</span>
                        </button>
                        <ul class="dropdown-menu pull-right" style="display: none;">
                                <li>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><a href="#"><img alt="iPhone" class="img-thumbnail" src="admin/images/product_thumb/featured_68b7d25e92281.jpg" title="iPhone"></a></td>
                                                        <td class="text-left"><a href="#">my cow</a></td>
                                                        <td class="text-right">x1</td>
                                                        <td class="text-right">$120</td>
                                                        <td class="text-center"><a href="helper_cart.php?rmid=122" title="Remove" class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </li><li id="mini-calculation">
                                    <div>
                                                                                    <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right"><strong>Sub-Total</strong></td>
                                                        <td class="text-right">$120</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                                                        <td class="text-right">$2.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>VAT (20%)</strong></td>
                                                        <td class="text-right">$24.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Total</strong></td>
                                                        <td class="text-right">$146.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>                                        <p class="text-right"><a href="cart"><strong><i class="fa fa-shopping-cart"></i> View Cart</strong></a> <a href="billing"><strong><i class="fa fa-share"></i> Checkout</strong></a></p>
                                    </div>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Navigation Menu -->
<div class="navMenu-main">
    <div class="gn-icon-menu" id="menu"><span></span></div>
</div>
<div class="top-menu">
    <div class="container">
        <div id="slidingMenu">
            <nav id="navMenu">
                <ul>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <?php foreach ($categories as $cat): ?>
                        <li>
                            <a href="<?= base_url('category?cid=' . $cat['id']) ?>"><?= $cat['category_name'] ?></a>
                            <?php if (!empty($cat['subcategories'])): ?>
                                <ul>
                                    <?php foreach ($cat['subcategories'] as $sub): ?>
                                        <li><a href="<?= base_url('category?cid=' . $cat['id'] . '&sid=' . $sub['id']) ?>"><?= $sub['name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Cart Toggle Script -->
<script>
$(document).ready(function() {
    $(".btn-viewcart").on("click", function(e) {
        e.preventDefault();
        $("#cart .dropdown-menu").slideToggle("fast");
    });
    $(document).on("click", function(e) {
        if (!$(e.target).closest("#cart").length) {
            $("#cart .dropdown-menu").slideUp("fast");
        }
    });
});
</script>
