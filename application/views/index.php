<?php if (isset($flash)): ?>
    <script>
        var flashType = "<?= $flash['type'] ?>",
            flashMessage = "<?= $flash['message'] ?>";
    </script>
<?php endif; ?>

<div class="home-banner">
    <a href="#"><img alt="" src="<?= base_url('assets/images/banner1.jpg') ?>"></a>
</div>

<div id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Special Products -->
                <div class="product-carousel">
                    <div class="sec-title">
                        <h3>Special products</h3>
                    </div>
                    <div class="row">
                        <div class="owl-carousel" id="carouse21">
                            <?php shuffle($special_products);
                            foreach ($special_products as $product): ?>
                                <div class="item">
                                    <div class="product-layout">
                                        <div class="product-thumb transition">
                                            <div class="image">
                                                <a href="<?= base_url('product/' . $product['id']) ?>">
                                                    <img alt="" src="<?= base_url('uploads/product_small/' . $product['featured_image']) ?>" class="img-responsive product_image" style="object-fit:contain">
                                                </a>
                                            </div>
                                            <div class="caption">
                                                <h4><a href="<?= base_url('product?pid=' . $product['id']) ?>"><?= $product['name'] ?></a></h4>
                                                <div class="rating">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <span class="fa fa-stack"><i class="fa fa-stack-2x fa-star"></i><i class="fa fa-stack-2x fa-star-o"></i></span>
                                                    <?php endfor; ?>
                                                </div>
                                                <p class="price">€<?= $product['price'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="category-carousel">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        <div class="product-carousel type2">
        <div class="sec-title">
            <h3>BROWSE OUR CATEGORIES</h3>
        </div>
        <div class="owl-carousel" id="carouse23">
            <?php foreach ($categories as $cat): ?>
                <div class="item">
                    <div class="product-layout">
                        <div class="cat-thumb">
                            <div class="image">
                                <a href="<?= base_url('category/' . $cat['id']) ?>">
                                    <img alt="" src="<?= base_url('uploads/category_images/' . $cat['image']) ?>" class="img-responsive">
                                </a>
                            </div>
                            <h4><a href="<?= base_url('category?cid=' . $cat['id']) ?>"><?= $cat['category_name'] ?></a></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Products -->
    <div class="product-carousel container">
        <div class="sec-title">
            <h3>Featured products</h3>
        </div>
        <div class="row">
            <div class="owl-carousel" id="carouse22">
                <?php shuffle($featured_products);
                foreach ($featured_products as $product): ?>
                    <div class="item">
                        <div class="product-layout">
                            <div class="product-thumb transition">
                                <div class="image">
                                    <a href="<?= base_url('product/' . $product['id']) ?>">
                                        <img alt="" src="<?= base_url('uploads/product_small/' . $product['featured_image']) ?>" class="img-responsive" style="object-fit:contain">
                                    </a>
                                </div>
                                <div class="caption">
                                    <h4><a href="<?= base_url('product?pid=' . $product['id']) ?>"><?= $product['name'] ?></a></h4>
                                    <div class="rating">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <span class="fa fa-stack"><i class="fa fa-stack-2x fa-star"></i><i class="fa fa-stack-2x fa-star-o"></i></span>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="price">€<?= $product['price'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Category Carousel -->

</div>
</div>
</div>
</div>

<!-- Free Shipping Banner -->
<div class="free-shipping">
    <div class="container">
        <img alt="" src="<?= base_url('assets/images/delivery-icon.png') ?>">
        <span>Free shipping on orders over €60</span>
        <a href="#" class="btn btn-default btn-lg">Shop Now</a>
    </div>
</div>

<!-- Newsletter Signup -->
<div class="email-signup">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <div class="sec-title">
                    <h3>Newsletter</h3>
                </div>
                <p>There are many variations of passages of Lorem Ipsum available...</p>
                <div class="form-signup">
                    <input class="form-control" placeholder="Type Your Email">
                    <input class="btn btn-send" type="submit" value="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carousel Scripts -->
<script>
    $("#carouse21").owlCarousel({
        items: 4,
        autoplay: true,
        autoPlay: 3000,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: false,
        itemsDesktopSmall: [1199, 4],
        itemsTablet: [991, 3],
        itemsTabletSmall: [639, 2]
    });

    $("#carouse22").owlCarousel({
        items: 4,
        autoplay: true,
        autoPlay: 3000,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: false,
        itemsDesktopSmall: [1199, 4],
        itemsTablet: [991, 3],
        itemsTabletSmall: [639, 2]
    });
    $("#carouse23").owlCarousel({
        items: 5,
        autoplay: true,
        autoPlay: 3000,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: false,
        itemsDesktopSmall: [1199, 4],
        itemsTablet: [991, 3],
        itemsTabletSmall: [639, 2]
    });

    $(function() {
        if (typeof flashType !== "undefined" && typeof flashMessage !== "undefined") {
            Swal.fire({
                icon: flashType,
                title: flashMessage,
                showConfirmButton: true,
                timer: 1000
            });
        }
    });
</script>