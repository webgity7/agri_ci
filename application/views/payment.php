<?php
session_start();
ob_start();
if (empty($_SESSION['client']) || empty($_SESSION)):
    header('Location: login.php');
endif;
ob_end_flush();
$title = $title = "AgriExpress | Shipping Page";
// var_dump($_SESSION);

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
         a.deleted
         FROM 
         address a
         LEFT JOIN 
      customer c ON a.customer_id = c.id";
// echo $sql;
$result = execute_query($sql);
// var_dump($result);
?>

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

    input[type="radio"] {
        accent-color: #8dc63f;
        width: 18px;
        /* Adjust as needed */
        height: 18px;
    }
</style>
<div class="banner-in">
    <div class="container">
        <h1>Payment</h1>
        <ul class="newbreadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Payment</li>
        </ul>
    </div>
</div>
<div id="main-container">
    <div class="container" style="margin-bottom:6px;">


        <div id="content" style="min-height: 300px;">
            <h2>Please Select You Payment Method to Pay <i><b style="color: #8dc63f; text-decoration:underline;">$ <?= $_SESSION['cart_summary']['total']; ?></b></i></h2>
            <form method="post" id='paymentForm' action="submit_payment.php">
                <div class="form-check" style="display: flex; align-items:center; gap:10px; margin-bottom:0;">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Credit Card">
                    <label class="form-check-label" for="exampleRadios1" style="margin-bottom:0; color:#8dc63f;">
                        Credit Card
                    </label>
                </div>
                <div class="form-check" style="display: flex; align-items:center;gap:10px; margin-bottom:0;">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Cash on Delivery">
                    <label class="form-check-label" for="exampleRadios2" style="margin-bottom:0; color:#8dc63f;">
                        Cash on Delivery
                    </label>
                </div>

            </form>




        </div>
    </div>

    <div class="row">
        <div class=" col-12 text-right" style="margin-right:60px ;">
            <a type="submit" class="btn btn-success" style="padding:8px 22px;" id="conBtn">
                Complete Order</a>
        </div>
    </div>
</div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const radios = document.querySelectorAll('input[name="exampleRadios"]');
        const completeBtn = document.getElementById("conBtn");
        const myForm=document.getElementById('paymentForm');

        completeBtn.style.pointerEvents = 'none';
        completeBtn.style.cursor = 'not-allowed';
        completeBtn.style.opacity = '0.5';



        // Enable button when any radio is selected
        radios.forEach(radio => {
            radio.addEventListener("change", function() {

                completeBtn.style.pointerEvents = '';
                completeBtn.style.cursor = '';
                completeBtn.style.opacity = '';
            });
        });

        completeBtn.addEventListener('click',()=>{
            myForm.submit();
        });

    });


</script>
