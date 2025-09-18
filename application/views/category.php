<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if (isset($flash)): ?>
    <script>
        var flashType = "<?= $flash['type'] ?>";
        var flashMessage = "<?= $flash['message'] ?>";
    </script>
<?php endif; ?>

<div class="banner-in">
    <div class="container">
        <h1><?= $category_name ?? 'Category' ?></h1>
        <ul class="newbreadcrumb">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li><?= $category_name ?? 'Category' ?></li>
            <li><?= $subcategory_name ?? '' ?></li>
        </ul>
    </div>
</div>

<div id="main-container">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-sm-3 hidden-xs" id="column-left">
                <h4 class="widget-title">CATEGORIES</h4>
                <ul class="category-list">
                    <?php foreach ($categories as $cat):
                        $isActiveCategory = ($activeCategoryId === $cat['id']) || in_array($activeSubCategoryId, array_column($cat['subcategories'], 'id'));
                        $li_classes = trim(($cat['subcategories'] ? 'accordion' : '') . ' ' . ($isActiveCategory ? 'active-category' : ''));
                    ?>
                        <li class="<?= $li_classes ?>">
                            <a href="<?= base_url('category/' . $cat['id']) ?>" class="<?= $isActiveCategory ? 'active' : '' ?>">
                                <?= htmlspecialchars($cat['category_name'], ENT_QUOTES, 'UTF-8') ?>
                            </a>
                            <?php if (!empty($cat['subcategories'])): ?>
                                <ul style="display: <?= $isActiveCategory ? 'block' : 'none' ?>;">
                                    <?php foreach ($cat['subcategories'] as $sub): ?>
                                        <li>
                                            <a href="<?= base_url('category/' . $cat['id'] . '/' . $sub['id']) ?>"
                                                class="<?= ($activeSubCategoryId === (int)$sub['id']) ? 'active-sub' : '' ?>">
                                                <?= htmlspecialchars($sub['name'], ENT_QUOTES, 'UTF-8') ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <!-- Main Content -->
            <div class="col-sm-9" id="content">
                <div class="search-bar">
                    <div class="row">
                        <div class="col-md-4 col-sm-12"><a id="compare-total" href="#">Product Compare (0)</a></div>
                        <div class="col-md-2 col-sm-2 text-right"><label>Sort By:</label></div>
                        <div class="col-md-3 col-sm-5 text-right">
                            <select onchange="updatePathParam(this.value)" class="form-control">
                                <option value="" <?= ($sort == '') ? 'selected' : '' ?>>Default</option>
                                <option value="A-Z" <?= ($sort == 'A-Z') ? 'selected' : '' ?>>Name (A - Z)</option>
                                <option value="Z-A" <?= ($sort == 'Z-A') ? 'selected' : '' ?>>Name (Z - A)</option>
                                <option value="low" <?= ($sort == 'low') ? 'selected' : '' ?>>Price (Low > High)</option>
                                <option value="high" <?= ($sort == 'high') ? 'selected' : '' ?>>Price (High > Low)</option>
                            </select>


                        </div>
                        <div class="col-md-1 col-sm-3 text-right"><label>Show:</label></div>
                        <div class="col-md-2 col-sm-2 text-right">
                            <select onchange="updatePathParam(this.value)" class="form-control">
                                <?php foreach ([100, 6, 1, 2, 3, 4] as $val): ?>
                                    <option value="<?= $val ?>" <?= $limit == $val ? 'selected' : '' ?>><?= $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="product-thumb transition">
                                    <div class="image">
                                        <a href="<?= base_url('product/pid=' . $product['id']) ?>">
                                            <img src="<?= base_url('uploads/product_small/' . $product['featured_image']) ?>" class="img-responsive" />
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h4><a href="<?= base_url('product?pid=' . $product['id']) ?>"><?= $product['name'] ?></a></h4>
                                        <div class="rating">
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="price">&euro; <?= $product['price'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h1 class="text-danger fs-1 text-center fw-bolder" style="margin-bottom:200px;">Product is Not Available Right Now!</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .category-list a.active {
        font-weight: bold;
        color: #007bff;
    }

    .category-list a.active-sub {
        text-decoration: underline;
        color: #dc3545;
    }

    .category-list li.active-category>a {
        font-weight: bold;
        color: #28a745;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const accordions = document.querySelectorAll(".category-list .accordion");
        accordions.forEach(item => {
            const subMenu = item.querySelector("ul");
            if (subMenu) {
                if (subMenu.style.display === "") subMenu.style.display = "none";
                item.querySelector("a").addEventListener("click", function(e) {
                    e.preventDefault();
                    subMenu.style.display = (subMenu.style.display === "none") ? "block" : "none";
                    this.classList.toggle('active');
                });
            }
        });
    });
</script>
<script>
    function updatePathParam(value) {
        const url = new URL(window.location.href);
        console.log(url);
        console.log(url.pathname.split('/').filter(Boolean));
        const segments = url.pathname.split('/').filter(Boolean); // remove empty segments

        // Assuming your URL structure is: /projects/agri-ci/category/cid/sid
        // and you want to append sort value as the next segment
        // Check if sort already exists (e.g., 6th segment)
        if (segments.length > 6) {
            segments[5] = value; 

        } else {
            segments.push(value); // Add new sort
        }
        // segments.push(value);
        // Rebuild the pathname
        url.pathname = '/' + segments.join('/');

        // Clear query string
        url.search = '';

        // Redirect to new URL
        window.location.href = url.toString();
    }



</script>

<script>
    $(function() {
        if (typeof flashType !== 'undefined' && typeof flashMessage !== 'undefined') {
            Swal.fire({
                icon: flashType,
                title: flashMessage,
                showConfirmButton: true,
                timer: 1000
            });
        }
    });
</script>