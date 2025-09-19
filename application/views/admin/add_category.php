<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?php echo isset($category_id) ? 'Edit' : 'Add'; ?> Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="category">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($category_id) ? 'Edit' : 'Add'; ?> Category</li>
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
                        <div class="card-title"><?php echo isset($category_id) ? 'Edit' : 'Add'; ?> Category</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <?php
                    $action_url = !empty($category_id)
                        ? base_url('admin/category/update')
                        : base_url('admin/category/submit');
                    ?>

                    <form id="addCategory" action="<?= $action_url ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="category_id" value="<?php echo !empty($category_id) ? $category_id : ''; ?>">

                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category_name" class="form-label">Name <span style="color:red;font-size:20px;">*</span></label>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <input type="text" class="form-control" id="category_name" placeholder="Category name" name="category_name" value="<?= $category['category_name'] ?>" require>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="order_number" class="form-label">Order Number</label>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <input type="number" class="form-control" id="order_number" name="order_number" value="<?= $category['order'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px;">
                                        <label for="image" class="form-label mb-0">Image <span style="color:red;font-size:20px;">*</span></label>
                                    </td>
                                    <td style="padding:10px;">
                                        <div class="image_item_parent mb-2  gap-2 ">
                                            <div class="image_item"><img src="<?= base_url('uploads/category_images/') . $category['image'] ?>" alt=""></div>
                                        </div>
                                        <div><small id="error_msg" class="text-danger">Image width and height should be 70 x70 pixel</small></div>
                                        <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px;">
                                        <label for="status" class="form-label">Status</label>

                                    </td>
                                    <td style="padding:10px;">
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
                            <button type="submit" class="btn btn-success text-white"><?php echo isset($category_id) ? 'Update' : 'Add'; ?></button>
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
    <?php if (isset($category_id)): ?>
        // JS for edit mode
        var form = document.getElementById("editCategory");
        var imageInput = document.getElementById("category_image");
        var allowedExtensions = ["jpg", "jpeg", "png"];

        imageInput.addEventListener("focus", () => {
            imageInput.classList.remove("border-danger");
        });


        imageInput.addEventListener("change", (e) => {
            e.preventDefault();
            const file = imageInput.files[0];
            if (!file) {
                Swal.fire({
                    icon: 'error',
                    title: "Please select an image.",
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                });
                imageInput.classList.add("border-danger");
                return;
            }

            const ext = file.name.split(".").pop().toLowerCase();
            if (!allowedExtensions.includes(ext)) {
                Swal.fire({
                    icon: 'error',
                    title: "Invalid file type. Allowed: " + allowedExtensions.join(", "),
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                });
                imageInput.value = ""; 
                imageInput.classList.add("border-danger");
            }

            const img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function() {
                if (img.width === 70 && img.height === 70) {
                    form.submit(); 
                } else {
                    alert();
                    Swal.fire({
                        icon: 'error',
                        title: "Image must be 70x70 pixels.",
                        showConfirmButton: true,
                        timer: 5000,
                        width: 300,
                        height: 150,
                    });

                    imageInput.classList.add("border-danger");
                    imageInput.value = ""; 
                }
            };
        });


    <?php else: ?>
        // JS for add mode
        var form = document.getElementById("addCategory");
        var imageInput = document.getElementById("image");

        // Allowed extensions
        var allowedExtensions = ["jpg", "jpeg", "png"];

        // On focus remove red border
        imageInput.addEventListener("focus", () => {
            imageInput.classList.remove("error-border");
        });

        // On change validate extension
        imageInput.addEventListener("change", () => {
            const file = imageInput.files[0];
            if (!file) return;

            const ext = file.name.split(".").pop().toLowerCase();
            if (!allowedExtensions.includes(ext)) {
                Swal.fire({
                    icon: 'error',
                    title: "Invalid file type. Allowed: " + allowedExtensions.join(", "),
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                });
                imageInput.value = ""; // clear
                imageInput.classList.add("error-border");
            }
        });

        // On submit validate image dimension
        form.addEventListener("submit", (e) => {
            e.preventDefault(); // stop submission until validated



            const file = imageInput.files[0];
            if (!file) {
                Swal.fire({
                    icon: 'error',
                    text: "Please select an image.",
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                });
                imageInput.classList.add("error-border");
                return;
            }

            const categoryName = document.getElementById('category_name').value.trim();

            if (categoryName === '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Please enter a category name.',
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                });
                document.getElementById('category_name').focus();
                return;
            }
            const alphaRegex = /^[A-Za-z\s]+$/;
            if (!alphaRegex.test(categoryName)) {
                Swal.fire({
                    icon: 'error',
                    text: 'Category name must contain only alphabetic characters.',
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                });
                document.getElementById('category_name').focus();
                return;
            }

            const img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function() {
                if (img.width == 70 && img.height == 70) {
                    form.submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: "Image must be  70x70 pixels.",
                        showConfirmButton: true,
                        timer: 5000,
                        width: 300,
                        height: 150,
                    });
                    imageInput.value = '';
                    imageInput.classList.add("error-border");
                }
            };
        });

    <?php endif; ?>
</script>