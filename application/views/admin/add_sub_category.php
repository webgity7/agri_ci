<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Sub Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="sub_category.php">Sub Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
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
                        <div class="card-title">Add Sub Category</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form id="image_form" action="submit_sub_category.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="page_id">
                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Category <span style="color:red;font-size:20px;">*</span></label>

                                        <select class="form-select" style="cursor:pointer;" id="category" name="category">
                                            <option value="">--Select Sub Category--</option>

                                            <?php
                                            foreach ($category_name as $item => $key) {
                                                echo "<option value='{$key['id']}'>{$key['category_name']}</option>";
                                            }

                                            ?>
                                        </select>
                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="image_nickname" class="form-label">Name <span style="color:red;font-size:20px;">*</span></label>
                                        <input type="text" class="form-control" id="image_nickname" placeholder="Sub Category Name" name="sub_category_name" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="image_page_image_order_number" class="form-label">Order Number</label>
                                        <input type="number" class="form-control" id="image_page_image_order_number" name="order">
                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" style="cursor:pointer;" id="status" name="status">
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
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