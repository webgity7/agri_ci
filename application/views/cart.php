<div class="banner-in">
  <div class="container">
    <h1>Cart</h1>
    <ul class="newbreadcrumb">
      <li><a href="index.php">Home</a></li>
      <li>Cart</li>
    </ul>
  </div>
</div>
<div id="main-container">
  <div class="container">

    <div class="row">
      <div class="col-sm-12" id="content">


        <div class="table-responsive">
          <table class="table cart-table">
            <thead>
              <tr>
                <td class="text-left">Image</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Price</td>
                <td class="text-left">Quantity</td>
                <td class="text-left">Total</td>
              </tr>
            </thead>
            <tbody id='cart-details'>

              <?php
              // var_dump($_SESSION['cart']);y
              if (isset($_SESSION['cart'])):
                asort($_SESSION['cart']);
                $subTotal = 0;
                foreach ($_SESSION['cart'] as $item => $key): ?>
                  <tr>
                    <td class="text-left">
                      <a href="product.php?pid=<?= $_SESSION['cart'][$item]['id'] ?>">
                        <img class="img-thumbnail" src="admin/images/product_thumb/<?= $_SESSION['cart'][$item]['image'] ?>" alt="">
                      </a>
                    </td>
                    <td class="text-left">
                      <a href="product.php?pid=<?= $_SESSION['cart'][$item]['id'] ?>"><?= $_SESSION['cart'][$item]['name'] ?></a>
                    </td>
                    <td class="text-left"><?= $_SESSION['cart'][$item]['price']; ?></td>
                    <td class="text-left">
                      <div class="input-group btn-block" style="max-width: 200px;">
                        <input type="number" id="<?= $_SESSION['cart'][$item]['id'] ?>" class="form-control " value="<?= $_SESSION['cart'][$item]['quantity'] ?>">
                        <span class="input-group-btn">
                          <button value="<?= $_SESSION['cart'][$item]['id'] ?>" onclick=" updateQuantity(<?= $_SESSION['cart'][$item]['id'] ?>)" class="btn btn-primary update_qty" title="Update">
                            <i class="fa fa-refresh"></i>
                          </button>
                          <a href="helper_cart.php?rmid=<?= $_SESSION['cart'][$item]['id'] ?>" class="btn btn-danger remove_product_id" value="<?= $_SESSION['cart'][$item]['id'] ?>" title="Remove">
                            <i class="fa fa-times-circle"></i>
                          </a>
                        </span>
                      </div>
                    </td>
                    <td class="text-left"><?php echo number_format(($_SESSION['cart'][$item]['price'] * $_SESSION['cart'][$item]['quantity']), 2);
                                          $subTotal += ($_SESSION['cart'][$item]['price'] * $_SESSION['cart'][$item]['quantity']); ?></td>
                  </tr>
              <?php endforeach;
              endif; ?>

            </tbody>
          </table>
        </div>
        <h4>What would you like to do next?</h4>
        <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        <div id="accordion" class="panel-group">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#collapse-coupon">Use Coupon Code <i class="fa fa-caret-down"></i></a></h4>
            </div>
            <div class="panel-collapse collapse" id="collapse-coupon">
              <div class="panel-body">
                <label for="input-coupon" class="col-sm-2 control-label">Enter your coupon here</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="input-coupon" placeholder="Enter your coupon here" name="coupon" vk_14527="subscribed">
                  <span class="input-group-btn">
                    <a type="button" class="btn btn-primary" id="button-coupon" onclick="appliedCoupon('input-coupon')">Apply Coupon</a>
                  </span>
                </div>

              </div>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-voucher">Use Gift Voucher <i class="fa fa-caret-down"></i></a></h4>
            </div>
            <div class="panel-collapse collapse" id="collapse-voucher">
              <div class="panel-body">
                <label for="input-voucher" class="col-sm-2 control-label">Enter your gift voucher code here</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="input-voucher" placeholder="Enter your gift voucher code here" value="" name="voucher" vk_14527="subscribed">
                  <span class="input-group-btn">
                    <input type="submit" class="btn btn-primary" data-loading-text="Loading..." id="button-voucher" value="Apply Voucher">
                  </span>
                </div>

              </div>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#collapse-shipping">Estimate Shipping &amp; Taxes <i class="fa fa-caret-down"></i></a></h4>
            </div>
            <div class="panel-collapse collapse" id="collapse-shipping">
              <div class="panel-body">
                <p>Enter your destination to get a shipping estimate.</p>
                <div class="form-horizontal">
                  <div class="form-group required">
                    <label for="input-country" class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                      <?php
                      $countries = array(
                        "United States",
                        "Canada",
                        "Mexico",
                        "Brazil",
                        "United Kingdom",
                        "France",
                        "Germany",
                        "Japan",
                        "Australia",
                        "India"
                      ); ?>
                      <select class="form-control" id="input-country" name="country_id">
                        <option value=""> --- Please Select --- </option>
                        <?php foreach ($countries as $country): ?>
                          <option value="<?= $country ?>"><?= $country ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label for="input-zone" class="col-sm-2 control-label">Region / State</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="input-zone" name="zone_id">


                      </select>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="" name="postcode" vk_14527="subscribed">
                    </div>
                  </div>
                  <button class="btn btn-primary" data-loading-text="Loading..." id="button-quote" type="button">Get Quotes</button>
                </div>

              </div>
            </div>
          </div>
        </div>
        <br>
        <?php
        // Base subtotal
        $baseSubTotal = isset($subTotal) ? $subTotal : 0;
        if ($baseSubTotal === 0) {
          unset($_SESSION['discount']);
        }
        $subTotal=$baseSubTotal;
        

        // Eco Tax
        $eco_tax = isset($_SESSION['cart']) ? count($_SESSION['cart']) * 2 : 0;

        $discount = 0;
        // Apply discount if available
        if (isset($_SESSION['discount']['type']) && isset($_SESSION['discount']['amount'])) {
          $discountType = $_SESSION['discount']['type'];
          $discountAmount = $_SESSION['discount']['amount'];

          if ($discountType == 'Percentage') {
            $discount = ($discountAmount / 100) * ($baseSubTotal + $eco_tax);
            $baseSubTotal -= $discount;
          } elseif ($discountType == 'Dolar') {
            $discount = $discountAmount;
            $baseSubTotal -= $discount;
          }
        }

        // Prevent negative subtotal
        if ($baseSubTotal < 0) {
          $baseSubTotal = 0;
        }

        // VAT (20%)
        $vat = (20 / 100) * $baseSubTotal;

        // Prevent negative VAT
        if ($vat < 0) {
          $vat = 0;
        }

        // Final total after discount
        $finalTotal = $baseSubTotal + $eco_tax + $vat;

        // Prevent negative final total
        if ($finalTotal < 0) {
          $finalTotal = 0;
        }
        ?>



        <div class="row" id="mini-calculation">
          <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="text-right"><strong>Sub-Total:</strong></td>
                  <td class="text-right" id="subTotal">$<?= number_format($subTotal, 2); ?></td>
                </tr>
                <tr>
                  <td class="text-right"><strong>Eco Tax (-2.00):</strong></td>
                  <td class="text-right" id="ecoTax">$<?= number_format($eco_tax, 2); ?></td>
                </tr>
                <tr>
                  <td class="text-right"><strong>VAT (20%):</strong></td>
                  <td class="text-right" id="vat">$<?= number_format($vat, 2); ?></td>
                </tr>
                <?php if ($discount > 0): ?>
                  <tr>
                    <td class="text-right"><strong>Discount:</strong></td>
                    <td class="text-right" id="discount">-$<?= number_format($discount, 2); ?></td>
                  </tr>
                <?php endif; ?>
                <tr id="total">
                  <td class="text-right"><strong>Total:</strong></td>
                  <td class="text-right" id="totalValue">$<?= number_format($finalTotal, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <?php
        // Make sure session is started
        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }

        // Store values in session
        $_SESSION['cart_summary'] = [
          'sub_total'   => $subTotal,
          'eco_tax'     => $eco_tax,
          'vat'         => $vat,
          'discount'    => $discount,
          'total'       => $finalTotal
        ];
        // var_dump($_SESSION['cart_summary']);
        ?>


        <div class="buttons cart-btngroup">
          <div class="pull-left"><a class="btn btn160 btn-lg btn-default" href="index.php">Continue Shopping</a></div>
          <div class="pull-right"><a class="btn btn160 btn-lg btn-primary" href="billing.php">Checkout</a></div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
if (isset($_SESSION['flash'])):
  if (isset($_SESSION['flash']['request']) && empty($subTotal)):
    unset($_SESSION['flash']);
  endif;

?>
  <script>
    var flashType = "<?php echo $_SESSION['flash']['type']; ?>";
    var flashMessage = "<?php echo $_SESSION['flash']['message']; ?>";
  </script>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<script>
  function updateQuantity(productId) {
    const quantity = parseInt(document.getElementById(`${productId}`).value);
    console.log(typeof quantity);
    console.log(quantity);
    if (!isNaN(quantity) && quantity > 0) {
      console.log('if run');
      console.log(`helper_cart.php?upid=${productId}&quantity=${quantity}`);
      window.location.href = `helper_cart.php?upid=${productId}&quantity=${quantity}`;
    }

  }

  function appliedCoupon(coupon) {
    const couponCode = document.getElementById(`${coupon}`).value;
    console.log(couponCode);
    if (!couponCode == '') {
      console.log('if run');
      window.location.href = `coupon.php?code=${couponCode }`;
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Please enter the code first',
        showConfirmButton: true,
        timer: 2000
      });

    }

  }
</script>

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

<script>
  const countries = {
    "United States": ["California", "New York", "Texas", "Florida"],
    "Canada": ["Ontario", "Quebec", "British Columbia"],
    "Mexico": ["Mexico City", "Jalisco", "Nuevo León"],
    "Brazil": ["São Paulo", "Rio de Janeiro", "Minas Gerais"],
    "United Kingdom": ["England", "Scotland", "Wales", "Northern Ireland"],
    "France": ["Île-de-France", "Occitanie", "Auvergne-Rhône-Alpes"],
    "Germany": ["Bavaria", "North Rhine-Westphalia", "Berlin"],
    "Japan": ["Tokyo", "Osaka", "Hokkaido"],
    "Australia": ["New South Wales", "Victoria", "Queensland"],
    "India": ["Maharashtra", "Uttar Pradesh", "Karnataka"]
  };

  document.getElementById("input-country").addEventListener("change", function() {
    const selectedCountry = this.value;
    const zoneSelect = document.getElementById("input-zone");

    // Clear previous options
    zoneSelect.innerHTML = '<option value=""> --- Please Select --- </option>';

    // Populate new options
    if (countries[selectedCountry]) {
      countries[selectedCountry].forEach(function(zone) {
        const option = document.createElement("option");
        option.value = zone;
        option.textContent = zone;
        zoneSelect.appendChild(option);
      });
    }
  });
</script>
