<?php
session_start();
ob_start();
if (empty($_SESSION['client']) || empty($_SESSION)):
   header('Location: login.php');
endif;
ob_end_flush();
$title = $title = "AgriExpress | Shipping Page";
include('header.php');
// var_dump($_SESSION);
$client = $_SESSION['client']['id'];
//shipping
$sql = "SELECT
  a.id AS address_id,
  a.customer_id,
  c.email AS customeremail,
  a.companyaddress,
  a.addresslineone,
  a.addresslinetwo,
  a.city,
  a.postcode,
  a.country,
  a.states,
  CONCAT(c.firstname, ' ', c.lastname) AS cname,
  a.fullname,
  a.deleted
FROM
  address a
LEFT JOIN
  customer c ON a.customer_id = c.id
WHERE
a.customer_id=$client;";
// echo $sql;
$result = execute_query($sql);
// var_dump($_SESSION);
// var_dump($_SESSION['billing']);

?>
<?php
if (isset($_SESSION['flash'])): ?>
  <script>
    var flashType = "<?php echo $_SESSION['flash']['type']; ?>",
      flashMessage = "<?php echo $_SESSION['flash']['message']; ?>"
  </script>
  <?php unset($_SESSION['flash']); ?>
<?php endif;?>


<style>
   .billing {
      display: block;
      width: 100%;
      min-height: 24px;
      padding: 2px 6px;
      font-size: 14px;
      line-height: 1.42857143;
      color: #555;
      background-color: #e9e9e9;
      background-image: none;
      border: 1px solid #ccc;
      border-radius: 4px;
   }
   .error{
       color:red;
   }
</style>
<div class="banner-in">
   <div class="container">
      <h1>Shipping</h1>
      <ul class="newbreadcrumb">
         <li><a href="index.php">Home</a></li>
         <li>Shipping</li>
      </ul>
   </div>
</div>
<div id="main-container">
   <div class="container" style="margin-bottom:6px;">


 
         <div class="form-check">
            <input class="form-check-input" type="checkbox" id="sameAsBilling" style="accent-color: #8dc63f !important;" name="address" value="<?= $_SESSION['billing']['address_id'] ?>"  checked>
            <label class="form-check-label" for="sameAsBilling" style="color:#8dc63f;">
               Same as Billing Address
            </label>
         </div>
         <div class="" style="display: flex;  flex-wrap:wrap; gap:6px; " id="addressCard">
            <?php foreach ($result->result as $data => $key): ?>
               <div class="" style="width: 280px; ">

                  <div class="border card" style="border:1px solid #333;padding:6px;">
                       <div class=" ">
                                <label for="fullname" class=" control-label">Name:</label>
                                <span class="billing" value=""><?= !empty($result->result[$data]['fullname'])
                                                                    ? $result->result[$data]['fullname']
                                                                    : $result->result[$data]['cname'];
                                                                ?></span>
                        </div>
                     <div class=" ">
                        <label for="company" class=" control-label">Company:</label>
                        <span class="billing" value=""><?= $result->result[$data]['companyaddress'] ?></span>
                     </div>


                     <div class=" ">
                        <label for="address-1" class=" control-label ">Address 1</label>
                        <span class="billing" value=""><?= $result->result[$data]['addresslineone'] ?></span>

                        <div class="">
                           <label for="address-2" class="control-label">Address 2</label>
                           <span class="billing" value=""><?= $result->result[$data]['addresslinetwo'] ?></span>
                        </div>
                        <div class=" ">
                           <label for="city" class="control-label">City</label>
                           <span class="billing" value=""><?= $result->result[$data]['city'] ?></span>
                        </div>
                        <div class=" ">
                           <label for="postcode" class="control-label">Post Code</label>
                           <span class="billing" value=""><?= $result->result[$data]['postcode'] ?></span>
                        </div>
                        <div class=" ">
                           <label for="country" class=" control-label">Country</label>
                           <span class="billing" value=""><?= $result->result[$data]['country'] ?></span>
                        </div>

                        <div style="display: flex; justify-content:center; align-items:center;">
                           <div class="form-check ">
                              <input class="form-check-input check_address" type="checkbox" name="address" value="<?= $result->result[$data]['address_id'] ?>" id="checkbox <?= $data ?>">
                              <label class="form-check-label" for="checkbox1">Select <?= $data + 1 ?></label>
                           </div>
                        </div>

                     </div>
                  </div>

               </div>
            <?php endforeach; ?>


         </div>


      </div>
      <div class="row">
         <div class=" col-12 text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="padding:8px 22px; margin-top:10px;">Add New</button>
         </div>
      </div>
      <div class="row">
         <div class=" col-12 text-right" style="margin-right:60px ;">
            <button type="button" class="btn btn-success" style="padding:8px 22px;" id="conBtn"> Continue</button>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add New Billing Address</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px; font-size: 26px; ">
                  <span aria-hidden="true" style="color:red; font-weight:bolder; ">&times;</span>
               </button>
            </div>
            <div class="modal-body">

               <form method="post" name="billingAdd" action="submit_shipping.php" enctype="multipart/form-data">
                   
                   <div class="form-group required">
                            <label for="firstname" class=" control-label">First Name</label>
                            <div class="">
                                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" vk_18b38="subscribed">
                                <small class='error' for="firstname"></small>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="lastname" class="control-label">Last Name</label>
                            <div class=>
                                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" vk_18b38="subscribed">
                                <small class='error' for="lastname"></small>
                            </div>
                        </div>

                  <div class="form-group d-flex gap-3 ">
                     <label for="company" class=" control-label">Company</label>
                     <input type="text" class="form-control " id="company" placeholder="Company" name="company" vk_18b38="subscribed">
                  </div>


                  <div class="form-group required">
                     <label for="address-1" class=" control-label ">Address 1</label>
                     <input type="text" class="form-control" id="address_1" placeholder="Address 1" name="address_1" vk_18b38="subscribed">
                     <small class='error' for="address_1"></small>
                  </div>

                  <div class="form-group">

                     <label for="address-2" class="control-label">Address 2</label>
                     <input type="text" class="form-control" id="address-2" placeholder="Address 2" name="address_2" vk_18b38="subscribed">

                  </div>
                  <div class="form-group required">

                     <label for="city" class="control-label">City</label>
                     <input type="text" class="form-control" id="city" placeholder="City" name="city" vk_18b38="subscribed">
                     <small class='error' for="city"></small>

                  </div>
                  <div class="form-group required">

                     <label for="postcode" class="control-label">Post Code</label>
                     <input type="number" class="form-control" id="postcode" placeholder="Post Code" name="postcode" vk_18b38="subscribed" size="6" maxlength="6">
                     <small class='error' for="postcode"></small>

                  </div>
                  <div class="form-group required">

                     <label for="country" class=" control-label">Country</label>

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
                  <div class="form-group required">
                     <label for="states" class=" control-label">States</label>
                     <select class="form-control" id="states" name="states">
                        <option value=""> --- Please Select --- </option>
                     </select>

                  </div>



            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
         </div>
      </div>
   </div>

</div>
</div>

<!-- States -->
<script>
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
      const stateSelect = document.getElementById("states");

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


<!-- Validation Script -->
<script src="javascript/jquery.validate.js"></script>
<script>
   // letter validation
    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[A-Za-z]+(?: [A-Za-z]+)*$/.test(value.trim());
    }, "Only letters allowed.");
    $.validator.addMethod("numbersOnly", function(value, element) {
      return this.optional(element) || /^[0-9]+$/.test(value.trim());
    }, "Only digits are allowed.");

    const validator = $("form[name='billingAdd']").validate({
        rules: {

            firstname: {
                required: true,
                lettersOnly: true
            },
            lastname: {
                required: true,
                lettersOnly: true
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

            },
            states: {
                required: true,

            }
        },

        messages: {
            country: {
                required: "Please select a country",
                lettersOnly: "Country name must contain only letters"
            },
            states: {
                required: "Please select a state",
                lettersOnly: "State name must contain only letters"
            }
        },

        errorPlacement: function() {
            return false;
        },

        showErrors: function(errorMap, errorList) {
            $("small.error").html('');
            $('input.form-control, select.form-control').css({
                border: 'none',
                color: '#111'
            });
            for (let name in errorMap) {
                $(`small[for="${name}"]`).html(errorMap[name]);
                $(`#${name}`).css({
                    border: '1px solid red',
                    color: 'red'
                });
            }
        },

        submitHandler: function(form) {
            form.submit();
            // alert('form submitted');
        }
    });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const checkbox = document.getElementById('sameAsBilling');
    const addressCard = document.getElementById('addressCard');
    const addButton = document.querySelector("button[data-target='#exampleModal']");
    const conButton = document.querySelector("#conBtn");
    const clientId = <?= $result->result[$data]['customer_id'] ?>;
    const addressCheckboxes = document.querySelectorAll("input[name='addressOption']");
    let addressId = parseInt(checkbox.value);
    let sameAsBilling = document.querySelector("#sameAsBilling");

    // Initial state
    checkbox.checked = true;
    addressCard.style.display = 'none';
    conButton.disabled = false;
    addButton.disabled = true;

    //Same Event Adding....
    sameAsBilling.addEventListener('change', billingFunction);

    function billingFunction() {
      value = sameAsBilling.checked;
      if (value) {
        console.log('check box checked');
        addressCard.style.display = 'none';
        conButton.disabled = false;
        addButton.disabled = true;
      } else {
        console.log('check box unchecked');
        addressCard.style.display = 'flex';
        conButton.disabled = true;
        addButton.disabled = false;
      }
    }


    const checkboxes = document.querySelectorAll('.check_address');

    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('click', function() {
        const value = this.value;

        if (this.checked) {
          console.log("Checkbox checked with value:", value);
          conButton.disabled = false;
          addButton.disabled = true;

        } else {
          console.log("Checkbox unchecked with value:", value);
          conButton.disabled = true;
          addButton.disabled = false;

        }
      });
    });
    // Redirect on continue
    conButton.addEventListener('click', function() {
      window.location = `manage.php?type=shipping&clientId=${clientId}&address=${addressId}`;
    });
  });
</script>



<!-- Sweet Alert Script -->
<script>
   $(function() {
      if (typeof flashType !== 'undefined' && typeof flashMessage !== 'undefined') {
         Swal.fire({
            icon: flashType,
            title: flashMessage,
            showConfirmButton: true,
            timer: 3000
         });
      }
   });
</script>

<!-- Check Box Check Once -->
<script>
   $(document).ready(function() {
      $('input[type="checkbox"][name="address"]').on('click', function() {
         $('input[type="checkbox"][name="address"]').not(this).prop('checked', false);
      });
   });
</script>



<?php include('footer.php') ?>