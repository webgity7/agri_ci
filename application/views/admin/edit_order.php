<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Order</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="discount.php">Discount</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
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
                        <div class="card-title">Order Details</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->

                    <form id="image_form" action="submit_edit_order.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="page_id" value="">

                        <!--begin::Body-->
                        <div class="card-body">

                            <table style="width:100%; border-collapse:collapse;">

                                <tr>
                                    <td colspan="2">
                                        <div class="card-header p-0">
                                            <div class="card-title ">Product Details</div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php  foreach ($product as $data => $key): ?>
                                    <tr>
                                   

                                        <td style="padding:10px; vertical-align:top;">
                                            <label for="category" class="form-label">Product <?php echo $data+1   ?></label>
                                            <input type="text" class="form-control" id="" placeholder="Product Name" name="image_nickname" value="<?php  echo $product[$data]['product_name'] ?>" disabled>

                                        </td>
                                        <td style="padding:10px; vertical-align:top;">

                                            <div class="form-group">
                                                <label for="exampleDateInput" class="form-label">Quantity</label>
                                                <input type="number" placeholder="Quantity" class="form-control" id="exampleDateInput" value="<?php echo $product[$data]['quantity'] ?>" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <td colspan="2">
                                        <div class="card-header p-0">
                                            <div class="card-title">Address Details</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Delivery Address</label>
                                        <input type="text" class="form-control" id="" placeholder="Delivery Address" name="" value="<?php  echo $order_info['shipping_address'] ?>" disabled>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">

                                        <label for="category" class="form-label">Billing Address</label>
                                        <input type="text" class="form-control" id="" placeholder="Billing Address" name="" value="<?php  echo $order_info['billing_address'] ?>" disabled>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="2">
                                        <div class="card-header p-0">
                                            <div class="card-title">Billing Details</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Sub Total</label>
                                        <input type="number" class="form-control" id="" placeholder="Sub Total" name="" value="<?php  echo $order_info['subtotal'] ?>" disabled>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">

                                        <label for="category" class="form-label">Eco Tax(-2.00)</label>
                                        <input type="number" class="form-control" id="image_nickname" placeholder="Eco Tax" name="image_nickname" value="<?php  echo $order_info['ecotax'] ?>" disabled>
                                    </td>
                                </tr>



                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Vat(20%)</label>
                                        <input type="number" class="form-control" id="image_nickname" placeholder="Vat" name="image_nickname" value="<?php  echo $order_info['vat'] ?>" disabled>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">

                                        <label for="category" class="form-label">Discount</label>
                                        <input type="number" class="form-control" id="image_nickname" placeholder="Discount" name="image_nickname" value="<?php  echo $order_info['discount'] ?>" disabled>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Total</label>
                                        <input type="number" class="form-control" id="" placeholder="Total" name="" value="<?php  echo $order_info['total'] ?>" disabled>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
                                    </td>
                                </tr>



                                <tr>
                                    <td colspan="2">
                                        <div class="card-header p-0">
                                            <div class="card-title">Payment Details</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Payment Mode</label>
                                        <input type="text" class="form-control" id="" placeholder="Payment Mode" name="" value="<?php  echo $order_info['paymentmood'] ?>" disabled>

                                    </td>
                                    <td style="padding:10px; vertical-align:top;">

                                        <label for="category" class="form-label">Order Date</label>
                                        <input type="text" class="form-control" id="" placeholder="Order Date" name="" value="<?php  echo $order_info['orderdate'] ?>" disabled>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Transaction Id</label>
                                        <input type="text" class="form-control" id="" placeholder="Transaction Id" name="" value="" disabled>

                                    </td>

                                    <td style="padding:10px; vertical-align:top;">
                                        <input type="hidden" name="order_id" value="<?php  echo $order_info['order_id']?>">
                                        <label for="category" class="form-label">Order Status</label>
                                        <select class="form-select" id="availability" name="order_status">
                                            <option value="Processing" <?php  echo $order_info['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                            <option value="Shipped" <?php  echo $order_info['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                            <option value="Cancel" <?php  echo $order_info['status'] == 'Cancel' ? 'selected' : '' ?>>Cancel</option>
                                            <option value="Delivered" <?php  echo $order_info['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                            <option value="Completed" <?php  echo $order_info['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                        </select>
                                    </td>

                                </tr>


                                <tr>
                                    <td style="padding:10px; vertical-align:top;">
                                        <label for="category" class="form-label">Payment Status</label>
                                        <input class="form-control" type="text" id="availability" value="Successful" name="availability" disabled>
                                    </td>
                                    <td style="padding:10px; vertical-align:top;">
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
