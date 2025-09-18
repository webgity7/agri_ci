<?php
$sql = "SELECT category.id,category.category_name FROM `category` ";
$sql = "SELECT `id`, `name` FROM `sub_category`;";
?>
<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="product">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                        <div class="card-title">Product Details</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form id="image_form" action="submit_product" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="page_id" value="">
                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px;">
                                        <label for="category" class="form-label">Category <span style="color:red;font-size:20px;">*</span></label>
                                        <select class="form-select" id="category" name="category">
                                            <option value="">--Select Category--</option>
                                            <?php
                                            foreach ($category_table as $item => $key): ?>

                                                <?php
                                                echo "<option value=\"{$key['id']}\">{$key['category_name']}</option>"; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td style="padding:10px;">
                                        <label for="subcategory" class="form-label">Sub Category <span style="color:#fff;font-size:20px;">*</span></label>
                                        <select class="form-select" id="subcategory" name="subcategory">
                                            <option value="">--Select Sub Category--</option>
                                            <?php
                                            foreach ($sub_category_table as $item => $key): ?>

                                                <?php
                                                echo "<option value=\"{$key['id']}\">{$key['name']}</option>"; ?>

                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px;">
                                        <label for="product_name" class="form-label">Name <span style="color:red;font-size:20px;">*</span></label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                                    </td>
                                    <td style="padding:10px;">
                                        <label for="product_price" class="form-label">Price <span style="color:red;font-size:20px;">*</span></label>
                                        <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Product Price" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding:10px;">
                                        <label for="product_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="product_description" rows="3" placeholder="Product Description" name="product_desc"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding:10px; " class="pb-0">
                                        <label for="featured_image" class="form-label">Featured Image <span style="color:red;font-size:20px;">*</span></label>
                                        <div class="image_item_parent mb-2  gap-2  d-flex gap-3 flex-wrap">
                                            <div class='image_item'><img id="featured_image_src" src='' value='' alt=''></div>
                                        </div>
                                        <input class="form-control" type="file" id="featured_image" name="featured_image" require>
                                        <p class="text-info">(Image should be >10MB and minimum width>= 1000 pixels )</p>
                                    </td>

                                </tr>
                                <tr>

                                    <td colspan="2" style="padding:10px;">
                                        <label for="availability" class="form-label">Availability <span style="color:red;font-size:20px;">*</span></label>
                                        <select class="form-select" id="availability" name="availability">
                                            <option value="yes" selected style="width: 100%;">In Stock</option>
                                            <option value="no" style="width: 100%;">Out of Stock</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:10px;">
                                        <label for="gallery_images" class="form-label">Gallery Image</label>

                                        <div id="preview"></div>

                                        <input class="form-control" type="file" id="gallery_images" name="gallery_image[]" multiple>
                                        <p class="text-info">**You can select multiple images for the product gallery**</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding:10px;">
                                        <div class="d-flex justify-content-center gap-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="special_product" id="special_product" value="Special Product" checked>
                                                <label class="form-check-label" for="special_product">Add To Special Product</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="featured_product" id="featured_product" value="Featured Product">
                                                <label class="form-check-label" for="featured_product">Add To Featured Product</label>
                                            </div>
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
<style>
    #preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }

    .preview-box {
        position: relative;
        display: inline-block;
    }

    .preview-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        cursor: pointer;
        font-size: 14px;
        line-height: 20px;
    }
</style>
<script>
    // Variable Part    
    const form = document.getElementById("image_form");
    const imageInput = document.getElementById("featured_image");
    const galleryImage = document.getElementById("gallery_images");
    let removed_ids = document.getElementById('removed_ids');
    const preview = document.getElementById("preview");
    const allowedExtensions = ["jpg", "jpeg", "png"];
    let removedGalleryImg = [];
    let files = [];
    const maxSizeMB = 5;
    const minWidth = 1000;
    const maxSizeBytes = maxSizeMB * 1024 * 1024;


    // Image Cross Button Click
    document.addEventListener("click", e => {
        if (e.target.tagName === "BUTTON" && e.target.textContent.trim() === "×") {
            console.log(e.target.previousElementSibling);
            console.log(e.target.previousElementSibling.getAttribute("data-id"));

            console.log(e.target.previousElementSibling);
            let data = e.target.previousElementSibling.getAttribute("data-id")
            data = removed_ids.value + " " + data;
            removed_ids.setAttribute('value', data);
            e.target.parentElement.style.display = "none";
        }
    });


    // Images Size Getting
    const getSize = f => new Promise((res, rej) => {
        const u = URL.createObjectURL(f),
            img = new Image();
        img.onload = () => (URL.revokeObjectURL(u), res(img.naturalWidth));
        img.onerror = () => (URL.revokeObjectURL(u), rej());
        img.src = u;
    });


    // Updating the files 
    const updateFiles = () => {
        const dt = new DataTransfer();
        files.forEach(f => dt.items.add(f));
        galleryImage.files = dt.files;
    };


    const render = () => {
        preview.innerHTML = ""; // Clear previous previews

        files.forEach((f, i) => {
            const box = document.createElement("div");
            box.style.cssText = "position:relative;display:inline-block;margin:5px";

            box.innerHTML = `
      <img src="${URL.createObjectURL(f)}" style="width:120px;height:120px;object-fit:cover;border:1px solid #ccc;border-radius:6px;box-shadow:0 2px 5px rgba(0,0,0,.1)">
      <button type="button" style="position:absolute;top:-8px;right:-8px;background:red;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:14px;line-height:20px">×</button>
    `;

            box.querySelector("button").onclick = () => {
                files.splice(i, 1);
                render();
                updateFiles();
            };

            preview.appendChild(box);
        });
    };


    // Gallery Images 
    galleryImage.addEventListener("change", async () => {
        files = [];

        const allowedExtensions = ["jpg", "jpeg", "png", ];
        const maxSizeMB = 10;
        const maxSizeBytes = maxSizeMB * 1024 * 1024;

        const raw = [...galleryImage.files].filter(f => {
            const ext = f.name.split(".").pop().toLowerCase();
            return f.type.startsWith("image/") && allowedExtensions.includes(ext);
        });

        if (!raw.length) {
            galleryImage.value = "";
            return Swal.fire({
                icon: 'error',
                text: "Invalid file type. Allowed: " + allowedExtensions.join(", "),
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });

        };

        let skipped = 0;
        for (const f of raw) {
            const width = await getSize(f);
            if (width >= 1000 && f.size <= maxSizeBytes) {
                files.push(f);
            } else {
                skipped++;
            }
        }

        if (!files.length) {
            galleryImage.value = "";
            return Swal.fire({
                icon: 'error',
                text: `No valid images. Must be ≥1000px wide and ≤${maxSizeMB}MB.`,
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });
        }

        if (skipped)  Swal.fire({
                icon: 'error',
                text: `Skipped ${skipped} image(s) (invalid size or width).`,
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });

        render();
        updateFiles();
    });









    // Featured Image Validation
    imageInput.addEventListener("focus", () => {
        imageInput.classList.remove("border-danger");
    });

    imageInput.addEventListener("change", () => {
        const file = imageInput.files[0];
        if (!file) return;

        const allowedExtensions = ["jpg", "jpeg", "png"];
        const maxSizeMB = 10;

        // Validate extension
        const ext = file.name.split(".").pop().toLowerCase();
        if (!allowedExtensions.includes(ext)) {
            Swal.fire({
                icon: 'error',
                text: "Invalid file type. Allowed: " + allowedExtensions.join(", "),
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });
            imageInput.classList.add("border-danger");
            imageInput.value = "";
            return;
        }

        // Validate file size
        const sizeMB = file.size / (1024 * 1024);
        if (sizeMB > maxSizeMB) {
            Swal.fire({
                icon: 'error',
                text: "File size must be less than " + maxSizeMB + " MB.",
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });
            imageInput.classList.add("border-danger");
            imageInput.value = "";
            return;
        }

        // Validate image width
        const img = new Image();
        img.onload = function() {
            if (img.width < 1000) {
                Swal.fire({
                    icon: 'error',
                    text: "Image width must be at least 1000 pixels.",
                    showConfirmButton: true,
                    timer: 5000,
                    width: 300,
                    height: 150,
                    imageWidth: 10,
                    imageHeight: 10
                });
                imageInput.classList.add("border-danger");
                imageInput.value = "";
            } else {
                imageInput.classList.remove("border-danger");

            }
        };
        img.onerror = function() {
            Swal.fire({
                icon: 'error',
                text: "Failed to load image for dimension check.",
                showConfirmButton: true,
                timer: 5000,
                width: 300,
                height: 150,
                imageWidth: 10,
                imageHeight: 10
            });
            imageInput.classList.add("border-danger");
            imageInput.value = "";
        };
        img.src = URL.createObjectURL(file);
    });



    //== Fetch Api Data Fetching ...

    document.getElementById('category').addEventListener('change', function() {
        const categoryId = this.value;

        fetch(`subcategory_for_product/${encodeURIComponent(categoryId)}`)
            .then(response => response.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    console.log(data);
                    const subcategorySelect = document.getElementById('subcategory');
                    subcategorySelect.innerHTML = '<option value="0">--Select Subcategory--</option>';

                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        subcategorySelect.appendChild(option);
                    });
                } catch (err) {
                    console.error('JSON parse error:', err);
                    console.log('Raw response:', text);
                }
            })
            .catch(err => console.error('Fetch error:', err));
    });
</script>