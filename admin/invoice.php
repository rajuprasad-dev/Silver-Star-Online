<div class="page-content container bg-white py-4 px-3" id="invoice_generated_main">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            ORDER
            <small class="page-info">
                ID:
                <?php echo "#" . $result['order_id']; ?>
            </small>
        </h1>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-4 d-flex justify-content-center align-items-center">
                            <img src="../images/silver-star.png" alt="Silver Star" width="80">
                            <h3 class="mb-0 mt-2 ml-3">Silver Star</h3>
                            <p>GST Number: 27ANUPS3850M1Z1</p>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 align-middle">
                                <?php echo $result['c_name']; ?>
                            </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                <?php echo $result['booking_address']; ?>
                            </div>
                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b
                                    class="text-600">
                                    <?php echo $result['c_phone']; ?>
                                </b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                <span class="text-600 text-90">ORDER ID:</span>
                                <span>
                                    <?php echo "#" . $result['order_id']; ?>
                                </span>
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                    class="text-600 text-90">Order Date:</span>
                                <?php echo date("d M Y h:i:s a", strtotime($result['date_time'])); ?>
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                    class="text-600 text-90">Payment Mode:</span>
                                <?php echo $result['payment_method'] == "COD" ? "Cash On Delivery" : "Online"; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-light">
                                <th>#ID</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Selling Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>

                        <tbody class="text-95 text-secondary-d3">
                            <?php
                            if (!empty($products_data_list)) {
                                // print_r($products_data_list);
                            
                                foreach ($products_data_list as $key => $invoice_prod) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $key + 1; ?>
                                        </td>
                                        <td>
                                            <?php echo $invoice_prod['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $invoice_prod['cart_quantity'] . ' ' . $invoice_prod['quantity_unit']; ?>
                                        </td>
                                        <td>
                                            <?php echo "₹" . $invoice_prod['original_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo "₹" . $invoice_prod['selling_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo "₹" . ($invoice_prod['selling_price'] * $invoice_prod['cart_quantity']); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                    </div>

                    <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                        <div class="row my-2">
                            <div class="col-7 text-right">
                                SubTotal
                            </div>
                            <div class="col-5">
                                <span class="text-120 text-secondary-d1">₹
                                    <?php echo $result['cart_amount']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-7 text-right">
                                Delivery Charges
                            </div>
                            <div class="col-5">
                                <span class="text-110 text-secondary-d1">₹
                                    <?php echo $result['delivery_charges'] == 0 ? "Free" : $result['delivery_charges']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-7 text-right">
                                Discount
                            </div>
                            <div class="col-5">
                                <span class="text-110 text-success">-₹
                                    <?php echo $result['discount_amt']; ?>
                                </span>
                            </div>
                        </div>

                        <?php
                        if (!empty($result['coupon_discount']) and $result['coupon_discount'] > 0) {
                            ?>
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Coupon Discount
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-success">-₹
                                        <?php echo !empty($result['coupon_discount']) ? $result['coupon_discount'] : 0; ?>
                                    </span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                            <div class="col-7 text-right">
                                Total Amount
                            </div>
                            <div class="col-5">
                                <span class="text-110 font-weight-bold">₹
                                    <?php echo $result['final_amount']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="text-center">
                    <p class="mb-0">Address: Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, nisi?</p>
                    <span class="w-100">Thank you for your Purchase</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .text-secondary-d1 {
        color: #728299 !important;
    }

    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }

    .brc-default-l1 {
        border-color: #dce9f0 !important;
    }

    .ml-n1,
    .mx-n1 {
        margin-left: -.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
        margin-right: -.25rem !important;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
        color: #888a8d !important;
    }

    .text-success-m2 {
        color: #6FC6DE !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-110 {
        font-size: 110% !important;
    }

    .text-blue {
        color: #00A3D0 !important;
    }

    .pb-25,
    .py-25 {
        padding-bottom: .75rem !important;
    }

    .pt-25,
    .py-25 {
        padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
        background-color: #00C8FF !important;
    }

    .bgc-default-l4,
    .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120% !important;
    }

    .text-primary-m1 {
        color: #00A3D0 !important;
    }

    .text-danger-m1 {
        color: #dd4949 !important;
    }

    .text-blue-m2 {
        color: #00A3D0 !important;
    }

    .text-150 {
        font-size: 150% !important;
    }

    .text-60 {
        font-size: 60% !important;
    }

    .text-grey-m1 {
        color: #7b7d81 !important;
    }

    .align-bottom {
        vertical-align: bottom !important;
    }

    #invoice_generated_main {
        display: none;
    }

    @media print {

        .print_btn,
        .order_details_container_main {
            display: none !important;
            height: 0%;
        }

        #invoice_generated_main,
        #invoice_generated_main * {
            visibility: visible; // Print only required part
            text-align: left;
            -webkit-print-color-adjust: exact !important;
        }

        #invoice_generated_main {
            display: block !important;
            padding: 25px 15px 15px 15px;
        }

        body>.container-fluid.bg-soft {
            background: #fff !important;
        }

    }
</style>