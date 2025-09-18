<?php
ob_start();
session_start();
if (empty($_SESSION['client']) || empty($_SESSION)):
    header('Location: login.php');
endif;
ob_end_flush();
$title = $title = "AgriExpress | Shipping Page";
// var_dump($_SESSION);


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

    * {
        box-sizing: border-box;
        /* outline:1px solid ;*/
    }

    body {
        background: #ffffff;
        background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e1e8ed', GradientType=0);
        height: 100%;
        margin: 0;
        background-repeat: no-repeat;
        background-attachment: fixed;

    }

    .wrapper-1 {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .wrapper-2 {
        padding: 30px;
        text-align: center;
    }

    h1 {

        font-size: 4em;
        letter-spacing: 3px;
        color: #8dc63f;
        margin: 0;
        margin-bottom: 40px;
    }

    .wrapper-2 p {
        margin: 0;
        font-size: 1.3em;
        color: #aaa;
        font-family: 'Source Sans Pro', sans-serif;
        letter-spacing: 1px;
    }

    .go-home {
        color: #fff;
        background: #8dc63f;
        border: none;
        padding: 10px 50px;
        margin: 30px 0;
        border-radius: 30px;
        text-transform: capitalize;
        box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
    }

    .footer-like {
        margin-top: auto;
        background: #D7E6FE;
        padding: 6px;
        text-align: center;
    }

    .footer-like p {
        margin: 0;
        padding: 4px;
        color: #8dc63f;
        font-family: 'Source Sans Pro', sans-serif;
        letter-spacing: 1px;
    }

    .footer-like p a {
        text-decoration: none;
        color: #8dc63f;
        font-weight: 600;
    }

    @media (min-width:360px) {
        h1 {
            font-size: 4.5em;
        }

        .go-home {
            margin-bottom: 20px;
        }
    }

    @media (min-width:600px) {
        .content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .wrapper-1 {
            height: initial;
            max-width: 620px;
            margin: 0 auto;
            margin-top: 50px;
            box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 0.2);
        }

    }
</style>
<div class="banner-in">
    <div class="container">
        <h1>Thank You</h1>
        <ul class="newbreadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Thank You</li>
        </ul>
    </div>
</div>
<div id="main-container">
    <div class="container" style="margin-bottom:6px;">


        <div id="content" style="min-height: 300px;">
            <h2>Thank you for paying <i><b style="color:#8dc63f ;">Order Id #<?=  $_SESSION['order_id'] ?></b></i> please check email for further details. </h2>
            <div class="row">
                <div class=" col-12 text-center" style="margin-top:10px ;">
                    <div class=content>
                        <div class="wrapper-1">
                            <div class="wrapper-2">
                                <h1 style="  font-family: 'Kaushan Script', cursive;">Thank you !</h1>

                                <a href="index.php" class="go-home" style="margin-top: 40px;">
                                    Continue Shopping
                                </a>
                            </div>

                        </div>
                        <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
                    </div>
                </div>


            </div>
        </div>


    </div>
</div>
</div>


