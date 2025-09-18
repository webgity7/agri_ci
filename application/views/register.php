<div class="banner-in">
  <div class="container">
    <h1>Register</h1>
    <ul class="newbreadcrumb">
      <li><a href="#">Home</a></li>
      <li>Register</li>
    </ul>
  </div>
</div>
<div id="main-container">
  <div class="container">

    <div class="row">
      <div class="col-sm-12" id="content">

        <p>If you already have an account with us, please login at the <a href="login.php">login page</a>.</p>
        <form class="form-horizontal form-register" enctype="multipart/form-data" method="post" action="user_registration.php" id="regForm" name="regForm">
          <fieldset id="account">
            <legend>Your Personal Details</legend>
            <div style="display: none;" class="form-group required">
              <label class="col-lg-2 col-sm-3 control-label">Customer Group</label>
              <div class="col-sm-7">
                <div class="radio">
                  <label>
                    <input type="radio" checked="checked" value="1" name="customer_group_id">
                    Default</label>
                </div>
              </div>
            </div>
            <div class="form-group required">
              <label for="firstname" class="col-lg-2 col-sm-3 control-label">First Name</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" vk_18b38="subscribed">
                <small class='error' for="firstname"></small>
              </div>
            </div>
            <div class="form-group required">
              <label for="lastname" class="col-lg-2 col-sm-3 control-label">Last Name</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" vk_18b38="subscribed">
                <small class='error' for="lastname"></small>
              </div>
            </div>
            <div class="form-group required">
              <label for="email" class="col-lg-2 col-sm-3 control-label">E-Mail</label>
              <div class="col-sm-7">
                <input type="email" class="form-control" id="email" placeholder="E-Mail" name="email">
                <small class='error' for="email"></small>
              </div>
            </div>
            <div class="form-group required">
              <label for="telephone" class="col-lg-2 col-sm-3 control-label">Telephone</label>
              <div class="col-sm-7">
                <input type="tel" class="form-control" id="telephone" placeholder="Telephone" name="telephone" vk_18b38="subscribed">
                <small class='error' for="telephone"></small>
              </div>
            </div>
            <div class="form-group">
              <label for="fax" class="col-lg-2 col-sm-3 control-label">Fax</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="fax" placeholder="Fax" name="fax" vk_18b38="subscribed">
              </div>
            </div>
          </fieldset>
          <fieldset id="address">
            <legend>Your Address</legend>
            <div class="form-group">
              <label for="company" class="col-lg-2 col-sm-3 control-label">Company</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="company" placeholder="Company" name="company" vk_18b38="subscribed">
              </div>
            </div>
            <div class="form-group required">
              <label for="address-1" class="col-lg-2 col-sm-3 control-label">Address 1</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="address_1" placeholder="Address 1" name="address_1" vk_18b38="subscribed">
                <small class='error' for="address_1"></small>
              </div>
            </div>
            <div class="form-group">
              <label for="address-2" class="col-lg-2 col-sm-3 control-label">Address 2</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="address-2" placeholder="Address 2" name="address_2" vk_18b38="subscribed">
              </div>
            </div>
            <div class="form-group required">
              <label for="city" class="col-lg-2 col-sm-3 control-label">City</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="city" placeholder="City" name="city" vk_18b38="subscribed">
                <small class='error' for="city"></small>
              </div>
            </div>
            <div class="form-group required">
              <label for="postcode" class="col-lg-2 col-sm-3 control-label">Post Code</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" id="postcode" placeholder="Post Code" name="postcode" vk_18b38="subscribed" size="6" maxlength="6">
                <small class='error' for="postcode"></small>
              </div>
            </div>
            <div class="form-group required">
              <label for="country" class="col-lg-2 col-sm-3 control-label">Country</label>
              <div class="col-sm-7">

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
                <select class="form-control" id="country" name="country">
                  <option value=""> --- Please Select --- </option>
                  <?php foreach ($countries as $country): ?>
                    <option value="<?= $country ?>"><?= $country ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group required">
              <label for="country" class="col-lg-2 col-sm-3 control-label">Region / State</label>
              <div class="col-sm-7">
                <select class="form-control" id="state" name="state">
                  <option value=""> --- Please Select --- </option>
                </select>

              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Your Password</legend>
            <div class="form-group required">
              <label for="password" class="col-lg-2 col-sm-3 control-label">Password</label>
              <div class="col-sm-7">
                <input type="password" class="form-control" id="password" placeholder="Password" value="" name="password" vk_18b38="subscribed">
                <small class='error' for="password"></small>
              </div>
            </div>
            <div class="form-group required">
              <label for="confirm" class="col-lg-2 col-sm-3 control-label">Password Confirm</label>
              <div class="col-sm-7">
                <input type="password" class="form-control" id="confirm" placeholder="Password Confirm" value="" name="confirm" vk_18b38="subscribed">
                <small class='error' for="confirm"></small>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Newsletter</legend>
            <div class="form-group">
              <label class="col-lg-2 col-sm-3 control-label">Subscribe</label>
              <div class="col-sm-7">
                <label class="radio-inline">
                  <input type="radio" value="1" name="newsletter">
                  Yes</label>
                <label class="radio-inline">
                  <input type="radio" checked="checked" value="0" name="newsletter">
                  No</label>
              </div>
            </div>
          </fieldset>
          <div class="buttons">
            <p><input type="checkbox" id="agree" value="1" name="agree"> I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a> <br />
              <small class='error' for="agree"></small>
            </p>
            <br>


            <input type="submit" class="btn btn160 btn-default btn-lg" value="Continue">
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
<style>
  .error {
    color: red;
    font-weight: bolder;
    font-family: Tahoma, sans-serif;
  }
</style>
<?php if (isset($_SESSION['flash'])): ?>
  <script>
    var flashType = "<?php echo $_SESSION['flash']['type']; ?>";
    var flashMessage = "<?php echo $_SESSION['flash']['message']; ?>";
  </script>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<script src="javascript/jquery.validate.js"></script>
<!-- Sweet Alert Script -->
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
<!-- Validation Script -->
<script>
  $(function() {

    // letter validation
    $.validator.addMethod("lettersOnly", function(value, element) {
      return this.optional(element) || /^[A-Za-z]+(?: [A-Za-z]+)*$/.test(value.trim());
    }, "Only letters allowed.");
    // Number validation
    $.validator.addMethod("numbersOnly", function(value, element) {
      return this.optional(element) || /^[0-9]+$/.test(value.trim());
    }, "Only digits are allowed.");

    $.validator.addMethod("emailExists", function(value, element) {
      let isValid = false;
      $.ajax({
        url: "check_email.php",
        type: "POST",
        data: {
          email: value
        },
        dataType: "json",
        async: false,
        success: function(response) {
          console.log(response);
          isValid = !response.exists; // true if email does NOT exist
        }

      });

      return isValid;
    }, "Email already exists.");

    const validator = $("form[name='regForm']").validate({
      rules: {

        firstname: {
          required: true,
          lettersOnly: true
        },
        lastname: {
          required: true,
          lettersOnly: true
        },
        email: {
          required: true,
          email: true,
          emailExists: true
        },
        telephone: {
          required: true
        },
        address_1: {
          required: true
        },
        city: {
          required: true,
          lettersOnly: true
        },
        postcode: {
          required: true,
          numbersOnly: true,
          minlength: 6
        },
        country: {
          required: true,
          lettersOnly: true
        },
        password: {
          required: true,
          minlength: 6
        },
        confirm: {
          required: true,
          equalTo: "#password"
        },
        agree: {
          required: true,
        }
      },

      messages: {
        // for custom massage...
        agree: {
          required: "Please accept the terms and conditions",
        }
      },

      errorPlacement: function() {
        return false;
      },

      showErrors: function(errorMap, errorList) {
        $("small.error").html('');
        $('input.form-control').css({
          border: 'none',
          color: '#111'
        });
        for (let name in errorMap) {
          $(`small[for="${name}"]`).html(errorMap[name]);
          $(`input[id="${name}"]`).css({
            border: '1px solid red',
            color: 'red'
          });


        }
      },

      submitHandler: function(form) {
        form.submit();
        // alert('form submited');
      },

    })


  });

  const countryStates = {
    "United States": ["California", "Texas", "New York", "Florida", "Illinois"],
    "Canada": ["Ontario", "Quebec", "British Columbia", "Alberta", "Manitoba"],
    "Mexico": ["Jalisco", "Nuevo León", "Puebla", "Chihuahua", "Yucatán"],
    "Brazil": ["São Paulo", "Rio de Janeiro", "Bahia", "Paraná", "Minas Gerais"],
    "United Kingdom": ["England", "Scotland", "Wales", "Northern Ireland"],
    "France": ["Île-de-France", "Provence-Alpes-Côte d'Azur", "Normandy", "Brittany"],
    "Germany": ["Bavaria", "Berlin", "Hamburg", "Hesse", "Saxony"],
    "Japan": ["Tokyo", "Osaka", "Kyoto", "Hokkaido", "Fukuoka"],
    "Australia": ["New South Wales", "Victoria", "Queensland", "Western Australia"],
    "India": ["Maharashtra", "Tamil Nadu", "Karnataka", "West Bengal", "Delhi"]
  };
  document.getElementById("country").addEventListener("change", function() {
    const selectedCountry = this.value;
    const states = countryStates[selectedCountry] || [];
    const stateSelect = document.getElementById("state");

    // Clear previous options
    stateSelect.innerHTML = '<option value=""> --- Please Select --- </option>';

    // Populate new options
    states.forEach(function(state) {
      const option = document.createElement("option");
      option.value = state;
      option.textContent = state;
      stateSelect.appendChild(option);
    });
  });
</script>
