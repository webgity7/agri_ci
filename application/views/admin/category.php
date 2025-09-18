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
                <div class="col-sm-6"><h3 class="mb-0">Category</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-info card-outline p-0 rounded-0">
                    <div class="card-header d-flex justify-content-between">
                        <a href="<?= base_url('admin/category') ?>" class="btn btn-sm bg-success text-white">All</a>
                        <?php for ($i = 65; $i <= 90; $i++): ?>
                            <a href="<?= base_url('admin/category' . chr($i)) ?>" class="btn btn-sm bg-success text-white"><?= chr($i) ?></a>
                        <?php endfor; ?>
                    </div>

                    <div class="card-header border-4 border-bottom border-info">
                        <form class="d-flex gap-4" method="get" action="<?= base_url('admin/category') ?>">
                            <div class="d-inline-flex align-items-center text-nowrap" style="font-weight:bold;">Category Name</div>
                            <input class="form-control me-2" type="search" name="query" placeholder="Search">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </form>
                    </div>

                    <div class="card-body card-info card-outline rounded-0">
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('admin/add_category') ?>" class="btn btn-success mb-2">Add New</a>
                        </div>

                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Number of Sub-Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $item): ?>
                                        <tr class="align-middle">
                                            <td><?= $item['category_name'] ?></td>
                                            <td><?= $item['order'] ?></td>
                                            <td><?= $item['status'] ?></td>
                                            <td><?= $item['sub_category_count'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/edit_category/' . $item['id']) ?>" class="btn btn-sm bg-info text-white">EDIT</a>
                                                <a href="<?= base_url('delete?cid=' . $item['id']) ?>" class="btn btn-sm bg-danger text-white">DELETE</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-danger">No record found</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
        Toast.fire({ icon: flashType, title: flashMessage });
    }
});
</script>

<style>
.swal2-toast {
    padding: 6px !important;
    padding-left: 18px !important;
}
.swal2-toast h2.swal2-title {
    margin: 10px !important;
    padding: 0;
    font-size: 13px !important;
    text-align: initial;
    line-height: 20px;
    font-family: var(--bs-body-font-family) !important;
}
</style>
