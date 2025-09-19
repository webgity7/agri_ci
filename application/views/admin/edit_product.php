<?php

// var_dump($id);
$sql = "SELECT p.id,
       p.name AS product_name,
       p.price,
       p.description,
       c.category_name,
       sc.name AS sub_category_name,
       p.availability,
       p.featured_image,
       p.featured_product,
       p.special_product,
       c.id as category_id
FROM product p
INNER JOIN category c ON p.category_id = c.id
LEFT JOIN sub_category sc ON p.sub_category_id = sc.id
WHERE p.id = $id ";


$sql = "SELECT `id`, `category_name` FROM `category`";
// $category_data = execute_query($sql);


$sql = "SELECT `id`, `name` FROM `sub_category`";
// $sub_category_data = execute_query($sql);


$sql = "SELECT p.name AS product_name,
        p.id,
        i.id,
        GROUP_CONCAT(i.image_src ORDER BY i.id SEPARATOR ', ') AS images
        FROM images i
        INNER JOIN product p ON i.product_id = p.id
        WHERE p.id = $id
        GROUP BY p.id, p.name, i.id
";

// $images_data = execute_query($sql);


?>
<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                    <form id="image_form" action="submit_edit_product.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?php $product['id'] ?>">
                        <input type="hidden" id="removed_ids" value="" name="removed_images">

                        <!--begin::Body-->
                        <div class="card-body">
                            <table style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px;">
                                        <label for="category" class="form-label">Category <span style="color:red;font-size:20px;">*</span></label>
                                        <?php  //var_dump($subcategory);?>
                                        <select class="form-select" id="category" name="category">
                                            <?php
                                            foreach ($category as $option_value => $key) {
                                                $selected_attribute = ($category[$option_value]['category_name']  == $product['category_id']) ? 'selected="selected"' : '';
                                                echo '<option value="' . htmlspecialchars($category[$option_value]['id']) . '" ' . $selected_attribute . '>' . htmlspecialchars($category[$option_value]['category_name']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td style="padding:10px;">
                                        <label for="subcategory" class="form-label">Sub Category</label>
                                        <select class="form-select" id="subcategory" name="subcategory">
                                            <option value="">--Select Sub Category--</option>
                                            <?php
                                            foreach ($subcategory as $option_value => $key) {
                                                $selected_attribute = ($subcategory[$option_value]['name']  == $product['sub_category_name']) ? 'selected="selected"' : '';
                                                echo '<option value="' . htmlspecialchars($subcategory[$option_value]['id']) . '" ' . $selected_attribute . '>' . htmlspecialchars($subcategory[$option_value]['name']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px;">
                                        <label for="product_name" class="form-label">Name <span style="color:red;font-size:20px;">*</span></label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="<?php echo $product['product_name'] ?>">
                                    </td>
                                    <td style="padding:10px;">
                                        <label for="product_price" class="form-label">Price <span style="color:red;font-size:20px;">*</span></label>
                                        <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Product Price" value="<?php echo $product['price'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding:10px;">
                                        <label for="product_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="product_description" rows="3" placeholder="Product Description" name="product_desc"><?php echo $product['description']; ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding:10px; " class="pb-0">
                                        <label for="featured_image" class="form-label">Featured Image <span style="color:red;font-size:20px;">*</span></label>
                                        <div class="image_item_parent mb-2  gap-2 ">
                                            <div class="image_item"><img src="<?= base_url('uploads/product_thumb/' . $product['featured_image']); ?>" alt=""></div>
                                        </div>
                                        <input class="form-control" type="file" id="featured_image" name="featured_image">
                                        <p class="text-info">(Image should be >10MB and minimum 1000×1000 pixels square sized)</p>
                                    </td>

                                </tr>
                                <tr>

                                    <td colspan="2" style="padding:10px;">
                                        <label for="availability" class="form-label">Availability</label>
                                        <select class="form-select" id="availability" name="availability">
                                            <option value="In Stock" selected>In Stock</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:10px;">
                                        <label for="gallery_images" class="form-label">Gallery Image</label>
                                        <div id="preview">
                                            <?php foreach ($gallery_images as $value => $key): ?>
                                                <div id='database-image' style="position: relative; display: inline-block;">
                                                    <img data-id="<?php $gallery_images[$value]['id']; ?>" class="previewImg" src="<?= base_url('uploads/product_thumb/' . $gallery_images[$value]['images']); ?>" value='<?= $gallery_images[$value]['id']; ?>' style="width:120px;height:120px;object-fit:cover;border:1px solid #ccc;border-radius:6px;box-shadow:0 2px 5px rgba(0,0,0,.1);background-color:pink;">
                                                    <button type="button" style="position:absolute;top:-8px;right:-8px;background:red;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:14px;line-height:20px">×</button>
                                                </div>
                                            <?php endforeach; ?>
                                            <div id="local-image"></div>
                                        </div>
                                        <input class="form-control" type="file" id="gallery_images" name="gallery_image[]" multiple>
                                        <p class="text-info">**You can select multiple images for the product gallery**</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding:10px;">
                                        <div class="d-flex justify-content-center gap-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="special_product" id="special_product" value="special" checked>
                                                <label class="form-check-label" for="special_product">Add To Special Product</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="featured_product" id="featured_product" value="featured">
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
                            <button type="submit" class="btn btn-success text-white">Update</button>
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

<?php include('footer.php'); ?>

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
    let databaseImg = document.getElementById('database-image');
    let localImg = document.getElementById('local-image');


    // Image Cross Button Click
    document.addEventListener("click", e => {
        if (e.target.tagName === "BUTTON" && e.target.textContent.trim() === "×") {
            console.log(e.target.previousElementSibling);
            console.log(e.target.previousElementSibling.getAttribute("data-id"));
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
        localImg.innerHTML = "";

        files.forEach((f, i) => {
            const box = document.createElement("div");
            box.style.cssText = "position:relative;display:inline-block;margin:5px; margin-top:0;";
            box.innerHTML = `
            <img  src="${URL.createObjectURL(f)}" style="width:120px;height:120px;object-fit:cover;border:1px solid #ccc;border-radius:6px;box-shadow:0 2px 5px rgba(0,0,0,.1)">
            <button type="button" style="position:absolute;top:-8px;right:-8px;background:red;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:14px;line-height:20px">×</button>
        `;
            box.querySelector("button").onclick = () => {
                files.splice(i, 1);
                render();
                updateFiles();
            };
            localImg.append(box);
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
            return alert("Invalid file type. Allowed: " + allowedExtensions.join(", "));
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
            return alert(`No valid images. Must be ≥1000px wide and ≤${maxSizeMB}MB.`);
        }

        if (skipped) alert(`Skipped ${skipped} image(s) (invalid size or width).`);

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
            alert("Invalid file type. Allowed: " + allowedExtensions.join(", "));
            imageInput.classList.add("border-danger");
            imageInput.value = "";
            return;
        }

        // Validate file size
        const sizeMB = file.size / (1024 * 1024);
        if (sizeMB > maxSizeMB) {
            alert("File size must be less than " + maxSizeMB + " MB.");
            imageInput.classList.add("border-danger");
            imageInput.value = "";
            return;
        }

        // Validate image width
        const img = new Image();
        img.onload = function() {
            if (img.width < 1000) {
                alert("Image width must be at least 1000 pixels.");
                imageInput.classList.add("border-danger");
                imageInput.value = "";
            } else {
                imageInput.classList.remove("border-danger");

            }
        };
        img.onerror = function() {
            alert("Failed to load image for dimension check.");
            imageInput.classList.add("border-danger");
            imageInput.value = "";
        };
        img.src = URL.createObjectURL(file);
    });



    //== Fetch Api Data Fetching ...

    document.getElementById('category').addEventListener('change', function() {
        const categoryId = this.value;

        fetch(`helper.php?cid=${encodeURIComponent(categoryId)}`)
            .then(response => response.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
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