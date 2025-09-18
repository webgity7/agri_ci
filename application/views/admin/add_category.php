<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="category">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category</li>
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
                        <div class="card-title">Add Category</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form id="addCategory" action="<?= base_url('admin/submit_category') ?>" method="post" enctype="multipart/form-data" >
                        <!-- <input type="hidden" name="page_id" value=""> -->

                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category_name" class="form-label">Name <span style="color:red;font-size:20px;">*</span></label>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                        <input type="text" class="form-control" id="category_name" placeholder="Category name" name="category_name" value="<?= $category['category_name'] ?>" require >
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
                                            <option value="Active" name="active" selected>Active</option>
                                            <option value="Inactive" name="inactive">Inactive</option>
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



<script>
    const form = document.getElementById("addCategory");
    const imageInput = document.getElementById("image");

    // Allowed extensions
    const allowedExtensions = ["jpg", "jpeg", "png"];

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
                timer: 3000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
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
                timer: 3000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });
            imageInput.classList.add("error-border");
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
                    timer: 3000,
                    width: 300,
                    height: 150,
                    imageWidth: 10,
                    imageHeight: 10
                });
                imageInput.classList.add("error-border");
            }
        };
    });

</script>