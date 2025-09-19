<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?php echo !empty($subcategory_id) ? 'Edit' : 'Add'; ?> Sub Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="sub_category.php">Sub Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo !empty($subcategory_id) ? 'Edit' : 'Add'; ?> Sub Category</li>
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
                        <div class="card-title"><?php echo !empty($subcategory_id) ? 'Edit' : 'Add'; ?> Sub Category</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <?php
                    $action_url = !empty($subcategory_id)
                        ? base_url('admin/subcategory/update')
                        : base_url('admin/subcategory/submit');
                    ?>
                    <form id="image_form" action="<?= $action_url ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="subcategory_id" value="<?= $subcategory_id ?>">
                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Category <span style="color:red;font-size:20px;">*</span></label>
                                        <select class="form-select" style="cursor:pointer;" id="category" name="category">
                                            <option value="">--Select Category--</option>
                                            <?php foreach ($category_name as $item => $key): ?>
                                                <?php
                                                $selected = '';
                                                if (!empty($subcategory_id) && isset($subcategory['category_id']) && $subcategory['category_id'] == $key['id']) {
                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $key['id'] ?>" <?= $selected ?>><?= $key['category_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="sub_category_name" class="form-label">Name <span style="color:red;font-size:20px;">*</span></label>
                                        <input type="text" class="form-control" id="sub_category_name" placeholder="Sub Category Name" name="sub_category_name" value="<?= $subcategory['name'] ?>" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="image_page_image_order_number" class="form-label">Order Number</label>
                                        <input type="number" class="form-control" id="image_page_image_order_number" name="order" value="<?= $subcategory['order'] ?>">
                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" style="cursor:pointer;" id="status" name="status">
                                            <?php if (isset($subcategory['status'])): ?>
                                                <option value="Active" <?= $subcategory['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                                <option value="Inactive" <?= $subcategory['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                            <?php else: ?>
                                                <option value="Active" selected>Active</option>
                                                <option value="Inactive">Inactive</option>
                                            <?php endif; ?>

                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer text-center d-flex justify-content-center gap-4">
                            <button type="submit" class="btn btn-success text-white"><?php echo !empty($subcategory_id) ? 'Update' : 'Add'; ?></button>
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
    document.getElementById('image_form').addEventListener('submit', function(e) {
        const categorySelect = document.getElementById('category');
        const selectedValue = categorySelect.value;

        if (selectedValue === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                text: 'Please select a category.',
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
            });
            categorySelect.focus();
            categorySelect.classList.add('border-danger');
        } else {
            categorySelect.classList.remove('border-danger');
        }
    });
</script>