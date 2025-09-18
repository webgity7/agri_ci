<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if (isset($flash)): ?>
<script>
var flashType = "<?= $flash['type'] ?>";
var flashMessage = "<?= $flash['message'] ?>";
</script>
<?php endif; ?>

<main class="app-main" id="main" tabindex="-1">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <?php
                $boxes = [
                    ['label' => 'CATEGORY', 'count' => $counts['category'], 'color' => 'text-bg-warning', 'icon' => 'bi-ui-checks-grid', 'link' => 'admin/category'],
                    ['label' => 'SUB-CATEGORY', 'count' => $counts['sub_category'], 'color' => 'bg-primary', 'icon' => 'bi-grid-fill', 'link' => 'admin/sub_category'],
                    ['label' => 'PRODUCT', 'count' => $counts['product'], 'color' => 'bg-info', 'icon' => 'bi-box', 'link' => 'admin/product'],
                    ['label' => 'ORDER', 'count' => $counts['order'], 'color' => 'bg-success', 'icon' => 'bi-cart3', 'link' => 'admin/order'],
                    ['label' => 'CUSTOMER', 'count' => $counts['customer'], 'color' => 'bg-danger', 'icon' => 'bi-person', 'link' => 'admin/customer'],
                    ['label' => 'DISCOUNT COUPON', 'count' => $counts['discount'], 'color' => 'bg-warning', 'icon' => 'bi-percent', 'link' => 'admin/discount'],
                ];
                foreach ($boxes as $box): ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box <?= $box['color'] ?>">
                        <div class="inner">
                            <div class="d-flex gap-4">
                                <div>
                                    <h3 class="mb-0"><?= $box['count'] ?></h3>
                                    <p class="mb-0"><?= $box['label'] ?></p>
                                </div>
                                <div class="d-flex align-items-center fs-1 dash-icon"><i class="bi <?= $box['icon'] ?>"></i></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <?php if ($box['link']): ?>
                                    <a href="<?= base_url($box['link']) ?>"><i class="fs-5 fw-bolder text-white bi bi-plus-lg"></i></a>
                                <?php else: ?>
                                    <i class="fs-5 fw-bolder text-white bi bi-plus-lg"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        height: 80,
    });

    if (typeof flashType !== 'undefined' && typeof flashMessage !== 'undefined') {
        Toast.fire({
            icon: flashType,
            title: flashMessage,
        });
    }
});
</script>

<style>
.swal2-toast {
    padding: 6px !important;
    padding-left: 18px !important;
}
.swal2-toast h2:where(.swal2-title) {
    margin: 10px !important;
    padding: 0;
    font-size: 13px !important;
    text-align: initial;
    line-height: 20px;
    font-family: var(--bs-body-font-family) !important;
}
</style>
