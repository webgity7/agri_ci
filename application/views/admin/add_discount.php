<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Discount Coupon</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="discount.php">Discount</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Discount Coupon</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Discount Coupon Details</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form id="addDiscount" action="submit_discount.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="discount_id" value="">
                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Name<span style="color:red;font-size:20px;">*</span></label>
                                        <input type="text" class="form-control" id="image_nickname" placeholder="Discount Coupon Name" name="discount-name" value="">

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">

                                        <div class="form-group">
                                            <label for="exampleDateInput" class="form-label">Valid Form<span style="color:red;font-size:20px;">*</span></label>
                                            <input type="date" class="form-control" id="exampleDateInput" name="valid-form" value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px; vertical-align:top;">

                                        <div class="form-group">
                                            <label for="exampleDateInput" class="form-label">Valid Till<span style="color:#fff;font-size:20px;">*</span></label>
                                            <input type="date" class="form-control" id="exampleDateInput"
                                                name='valid-to'>
                                        </div>
                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Type <span style="color:red;font-size:20px;">*</span></label>
                                            <select class="form-select" style="cursor:pointer;" id="status" name="type">
                                                <option value="Percentage" selected>Percentage</option>
                                                <option value="Dolar">Dolar</option>
                                            </select>
                                        </div>


                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">

                                        <div class="form-group">
                                            <label for="exampleDateInput" class="form-label">Amount<span style="color:red;font-size:20px;">*</span></label>
                                            <input type="number" class="form-control" id="amount"
                                                name='amount'>
                                        </div>
                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Status <span style="color:#fff;font-size:20px;">*</span></label>
                                            <select class="form-select" style="cursor:pointer;" id="status" name="status">
                                                <option value="Active" selected>Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>


                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer text-center d-flex justify-content-center gap-4">
                            <button type="submit" class="btn btn-success text-white">Add</button>
                            <button type="reset" class="btn btn-warning text-white">Reset</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
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