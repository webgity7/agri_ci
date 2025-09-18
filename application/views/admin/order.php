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
                <div class="col-sm-6"><h3 class="mb-0">Order</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-info card-outline p-0 rounded-0">
                    <div class="card-header border-4 border-bottom border-info">
                        <form class="d-flex gap-4" method="get" action="<?= base_url('admin/order') ?>">
                            <div class="d-inline-flex align-items-center text-nowrap" style="font-weight:bold;">Order Id</div>
                            <input class="form-control me-2" type="search" name="query" placeholder="Search">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </form>
                    </div>

                    <div class="card-body card-info card-outline rounded-0">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Deliver To</th>
                                    <th>Date</th>
                                    <th>Price ($)</th>
                                    <th>Status</th>
                                    <th>Who Ordered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr class="align-middle">
                                            <td><?= $order['id'] ?></td>
                                            <td><?= $order['delivery_add'] ?></td>
                                            <td><?= $order['formatted_date'] ?></td>
                                            <td><?= $order['total'] ?></td>
                                            <td><?= $order['status'] ?></td>
                                            <td><?= $order['firstname'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <a href="<?= base_url('edit_order?oid=' . $order['id']) ?>" class="btn btn-sm bg-info text-white">VIEW/EDIT</a>
                                                    <a href="<?= base_url('manage?cancel_order_id=' . $order['id']) ?>" class="btn btn-sm bg-warning text-white">CANCEL</a>
                                                    <a href="<?= base_url('delete?oid=' . $order['id']) ?>" class="btn btn-sm bg-danger text-white">DELETE</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-danger">No record found</td></tr>
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
