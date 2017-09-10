<?php
include './metaLibs.php';
?>
<title>Supplier Registration</title>
<style>
    .es-list { max-height: 160px !important; }
</style>
<script>
    $(document).ready(function () {


        loadSupplierNames();
    });

</script>
</head>
<body>
    <?php
    include './pageheader.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12"><a href="supplierRegistration.php" class="pull-right btn btn-primary">New Supplier&nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center h2">Good recieve notice</div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div id="grn_status"></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">GRN Id</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <span id="grn_span" class="spanMsg"></span>
                <input type="text" class="form-control" required   id="grn_id" name="grnid" >
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Supplier</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" id="grn_option">         
                <select id="grn_supplier_name" name="grnsuppliername" class="form-control" onchange="loadProducts(this.value)"> 
                    <option value="0" selected="true" disabled="disabled">Please select supplier</option>
                </select>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Product</label>
            </div>
            <div class="col-lg-7 col-md-5 col-sm-7 col-xs-12">
                <select id="grn_products" class="form-control" onchange="loadProductDetails(this.value)">
                    <option value="0" selected="true" disabled="disabled">Please select product</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Qty</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <span id="grn_span" class="spanMsg"></span>
                <input type="number" class="form-control" required placeholder="1" value="1" id="grn_qty" min="1" name="grnid" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Unit Price</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">         
                <input type="number" class="form-control" required placeholder="10000.00" id="grn_unit_price" min="1" name="grnid" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">         
                <label class="valign">Discount(%)</label>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">     
                <div class="input-group">
                    <input type="text" class="form-control" required placeholder="50%" max="100" id="grn_discount" min="1" name="grnid" aria-describedby="basic-addon1">
                    <input type="hidden" id="grn_discount_hidden">
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                <button class="btn btn-warning btnsize" onclick="addRow()">Add &nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                <span class="label label-default pull-right">Please tick on check box to remove products from the table</span>
                <table class="table table-hover table-bordered table-responsive" id="grn_product_table">
                    <thead>
                        <tr>
                            <th>Check</th>
                            <th>Product</th>
                            <th style="display:none;">Productid</th>
                            <th>Unit price</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>Price</th>

                        </tr>
                    </thead>
                    <tbody id="grn_table">


                    </tbody>
                </table> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                <button class="btn btn-warning btnsize" onclick="deleteRow()">Remove &nbsp;<span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <h2><span class="label label-default pull-right">Total (Rs.)</h2>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <h2 class="pull-right"><span id="grn_total_amount" name="grntotalamount">0.00</span></h2>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <h4><span class="label label-primary pull-right">Paid (Rs.)</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <input type="number" class="form-control pull-right" style="font-size: 30px" required id="grn_paid_amount" name="grnpaidamount" >
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                  <h4><span class="label label-primary pull-right">Balance (Rs.)</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <h2 class="pull-right"><span id="grn_balance" name="grnbalance">0.00</span></h2>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-8 col-md-1 col-sm-1 col-xs-12 text-center">
                <button style="margin-bottom: 20px;" class="btn btn-primary mainbtnsize" onclick="save_Grn()">SAVE GRN</button>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 "></div>
        </div>

    </div>
    <script src="js/shehan.main.js"></script>
</body>