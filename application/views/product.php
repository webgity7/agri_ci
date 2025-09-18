<?php if (isset($flash)): ?>
  <script>
    var flashType = "<?= $flash['type'] ?>";
    var flashMessage = "<?= $flash['message'] ?>";
  </script>
<?php endif; ?>

<div class="banner-in">
  <div class="container">
    <h1><?= $product['product_name'] ?></h1>
    <ul class="newbreadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li><a href="#"><?= $product['category_name'] ?></a></li>
      <li><a href="#"><?= $product['sub_category_name'] ?? '' ?></a></li>
      <li><?= $product['product_name'] ?></li>
    </ul>
  </div>
</div>

<div id="main-container">
  <div class="container">
    <div class="zoom-result" id="zoomResult"></div>
    <div class="row">
      <div class="col-sm-12" id="content">
        <div class="row">
          <div class="col-sm-7">
            <div class="row gx-2 justify-content-center">
              <div class="col-md-2 p-0" style="height:400px; overflow-y: scroll;">
                <img style="border:1px solid #333; margin-bottom:6px;" src="<?= base_url('uploads/product_thumb/' . $product['featured_image']) ?>">
                <?php foreach ($images as $img): ?>
                  <img style="border:1px solid #333; margin-bottom:6px;" src="<?= base_url('uploads/product_thumb/' . $img['image_src']) ?>">
                <?php endforeach; ?>
              </div>
              <div class="col-md-10 image-box" id="imageBox">
                <img style="border:1px solid #333;" id="mainImage" class="border border-primary" src="<?= base_url('uploads/product_medium/' . $product['featured_image']) ?>">
                <div class="zoom-lens" id="lens"></div>
              </div>
            </div>
          </div>

          <div class="col-sm-5">
            <div class="pdoduct-details">
              <div class="pdoduct-header">
                <h1><?= $product['product_name'] ?></h1>
                <h2>&euro; <?= $product['price'] ?></h2>
                <button class="btn btn-wishlist"><i class="fa fa-heart"></i></button>
              </div>
              <hr>
              <ul class="list-unstyled">
                <li>Availability: <?= $product['availability'] ?></li>
              </ul>
              <hr>
              <h4>Description</h4>
              <p><?= $product['description'] ?></p>

              <!-- <form action="?>" method="post">
                <label for="input-quantity">Qty</label>
                <input type="number" class="form-control" name="quantity" value="1">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" class="btn btn-default btn-lg">Add to Cart</button>
              </form> -->
              <div class="form-group clearfix">
                <form action="<?= base_url('add_to_cart')?>" method="get" id="addToCart" style="display: flex; gap: 10px; align-items: center;">
                  <label for="input-quantity" class="control-label">Qty</label>
                  <input type="number" class="form-control" id="input-quantity" value="1" name="quantity" vk_106cf="subscribed" style="width: 200px;">
                  <input type="hidden" name="product_id" id="product_id" value="<?= $product['id'] ?>">
                  <button type="submit" class="btn btn-default btn-lg" data-loading-text="Loading..." value="<?= $product['id'] ?>" id="button-cart">Add to Cart</button>
                </form>

              </div>

              <hr>
              <div class="rating">
                <div class="row">
                  <div class="col-lg-6">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <?php endfor; ?>
                    <a href="#">0 reviews</a> / <a href="#">Write a review</a>
                  </div>
                  <div class="col-lg-6">
                    <div class="pull-right">
                      <img src="<?= base_url('images/addthis.jpg') ?>" alt="">
                    </div>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div>

        <br>

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
          <li><a data-toggle="tab" href="#tab-review">Reviews (0)</a></li>
        </ul>
        <div class="tab-content">
          <div id="tab-description" class="tab-pane active">
            <p class="intro"><?= $product['description'] ?></p>
          </div>
          <div id="tab-review" class="tab-pane">
            <form class="form-horizontal">
              <div id="review">
                <p>There are no reviews for this product.</p>
              </div>
              <h2>Write a review</h2>
              <div class="form-group required">
                <label>Your Name</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group required">
                <label>Your Review</label>
                <textarea class="form-control" rows="5" name="text"></textarea>
                <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
              </div>
              <div class="form-group required">
                <label>Rating</label>
                Bad
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <input type="radio" value="<?= $i ?>" name="rating">
                <?php endfor; ?>
                Good
              </div>
              <div class="buttons clearfix">
                <button class="btn btn-primary" type="submit">Continue</button>
              </div>
            </form>
          </div>
        </div>

        <div class="product-carousel relater-product">
          <h3>Related Products</h3>
          <div class="row">
            <div id="carouse21" class="owl-carousel">
              <?php foreach ($related_products as $rp): ?>
                <div class="item">
                  <div class="product-layout">
                    <div class="product-thumb transition">
                      <div class="image">
                        <a href="<?= base_url('product?pid=' . $rp['id']) ?>">
                          <img src="<?= base_url('uploads/product_medium/' . $rp['featured_image']) ?>" class="img-responsive" />
                        </a>
                      </div>
                      <div class="caption">
                        <h4><a href="<?= base_url('product?pid=' . $rp['id']) ?>"><?= $rp['name'] ?></a></h4>
                        <div class="rating">
                          <?php for ($i = 0; $i < 5; $i++): ?>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <?php endfor; ?>
                        </div>
                        <p class="price">&euro; <?= $rp['price'] ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('#carouse21').owlCarousel({
    items: 4,
    autoPlay: 3000,
    navigation: true,
    navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    pagination: false,
    autoPlay: false,
    itemsDesktopSmall: [1199, 3],
    itemsTablet: [991, 3],
    itemsTabletSmall: [767, 2],
  });
</script>

</div>
</div>


<script>
  const imageBox = document.getElementById('imageBox');
  const mainImage = document.getElementById('mainImage');
  const lens = document.getElementById('lens');
  const zoomResult = document.getElementById('zoomResult');
  zoomResult.style.display = 'none';
  const zoom = 2;



  imageBox.addEventListener('mousemove', moveLens);
  imageBox.addEventListener('mouseenter', () => {
    zoomResult.style.backgroundImage = `url(http://localhost/projects/agri-ci/uploads/product_large/${(mainImage.src).split('/').pop()})`;
    console.log(mainImage.src);
    zoomResult.style.display = 'block';
    lens.style.display = "block"
  });
  imageBox.addEventListener('mouseleave', () => {
    zoomResult.style.display = "none";
    lens.style.display = "none"
  });

  function moveLens(e) {
    const rect = imageBox.getBoundingClientRect();
    const x = e.pageX - rect.left - window.pageXOffset;
    const y = e.pageY - rect.top - window.pageYOffset;

    let lensX = x - lens.offsetWidth / 2;
    let lensY = y - lens.offsetHeight / 2;

    // Clamp lens position
    lensX = Math.max(0, Math.min(lensX, imageBox.offsetWidth - lens.offsetWidth));
    lensY = Math.max(0, Math.min(lensY, imageBox.offsetHeight - lens.offsetHeight));

    lens.style.left = lensX + 'px';
    lens.style.top = lensY + 'px';

    const fx = lensX / imageBox.offsetWidth * zoomResult.offsetWidth;
    const fy = lensY / imageBox.offsetHeight * zoomResult.offsetHeight;

    zoomResult.style.backgroundPosition = `-${fx}px -${fy}px`;
  }


  document.querySelectorAll(".col-md-2 img").forEach(thumb => {
    thumb.addEventListener("mouseenter", () => {

      document.getElementById("mainImage").src = "http://localhost/projects/agri-ci/uploads/product_medium/" + ((thumb.src).split('/').pop());
    });
  });


  // Form Handling
  let addToCart = document.getElementById('addToCart');
  addToCart.addEventListener('submit', (e) => {
    e.preventDefault();
    let qty = document.getElementById('input-quantity').value;
    let qtySection = document.getElementById('qty');
    if (qty < 0 || isNaN(qty)) {
      return false;
    } else {
      // qtySection.setAttribute('value',qty);
      addToCart.submit();
    }

  })
</script>
<style>
  .image-box {
    position: relative;
  }

  .image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: crosshair !important;
  }

  .zoom-lens {
    position: absolute;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.3);
    pointer-events: none;
    display: none;
    cursor: crosshair !important;
  }

  .zoom-result {
    position: fixed;
    top: 280px;
    right: 70px;
    width: 538px;
    height: 406px;
    border: 1px solid #ccc;
    background-color: #dadadd;
    background-repeat: no-repeat;
    background-size: 1000px;
    z-index: 999;
    pointer-events: none !important;

  }

  #mainImage {
    height: 406px;
    object-fit: contain;
  }
</style>
</div>
</div>

<script>
  $(function() {
    if (typeof flashType !== 'undefined' && typeof flashMessage !== 'undefined') {
      Swal.fire({
        icon: flashType,
        title: flashMessage,
        showConfirmButton: true,
        timer: 1000
      });
    }
  });
</script>