<?php
include './metaLibs.php';
?>
<title>GRN</title>
<style>
    .es-list { max-height: 160px !important; }
    @media print {
        body * {
            visibility: hidden;
        }
        #grn-print-area, #grn-print-area * {
            visibility: visible;
        }
        #grn-print-area{
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
<script>
    $(document).ready(function() {

        generateId();
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
                <input  type="text" disabled="" class="form-control" required   id="grn_id" name="grnid" >
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
                <span id="grn_product_span" class="spanMsg"></span>
                <select onfocus="clearElement('#grn_product_span')" id="grn_products" class="form-control"  onclick="loadProductDetails(this.value)">
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
                <span id="grn_qty_span" class="spanMsg"></span>
                <input onfocus="clearElement('#grn_qty_span')" type="number" class="form-control" required placeholder="1" value="1" id="grn_qty" min="1" name="grnid" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Unit Price</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">   
                <span id="grn_unit_price_span" class="spanMsg"></span>
                <input onfocus="clearElement('#grn_unit_price_span')" type="number" class="form-control" required placeholder="10000.00" id="grn_unit_price" min="1" name="grnid" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">  

                <label class="valign">Discount(%)</label>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">     
                <div class="input-group">
                    <span id="grn_discount_span" class="spanMsg"></span>
                    <input onfocus="clearElement('#grn_discount_span')" type="text" class="form-control" required placeholder="50%" max="100" id="grn_discount" min="1" name="grnid" aria-describedby="basic-addon1">
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

                <table class="table table-hover table-bordered" id="grn_product_table">
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
                    <tbody id="grn_table"></tbody>
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
                <span class="label label-default pull-right amountstyles">Total (Rs.)</span> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <input type="number" disabled="" class="form-control pull-right amountstyles" min="0" required id="grn_total_amount" name="grntotalamount">
                <!--<h2 class="pull-right"><span id="grn_total_amount" name="grntotalamount">0.00</span></h2>-->
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <h4><span class="label label-primary pull-right">Paid (Rs.)</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <span id="grn_paid_amount_span" class="spanMsg"></span>
                <input onfocus="clearElement('#grn_paid_amount_span')" type="number" class="form-control pull-right amountstyles" min="0" required id="grn_paid_amount" name="grnpaidamount">
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <h4><span class="label label-primary pull-right">Balance (Rs.)</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">

                <input type="number" disabled="" class="form-control pull-right amountstyles" min="0" required id="grn_balance" name="grnbalance">
                <!--<h2 class="pull-right"><span id="grn_balance" name="grnbalance">0.00</span></h2>-->
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
    <!-- Modal -->
    <div class="modal fade" id="grn_print" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="grn-print-area">
                    <div> 
                        <div style="background-color: #ffffff" class="col-lg-12 text-center"><img src="images/logo/shehan.svg"  width="200px" height="100px"/></div>
                        <div class="col-lg-12 text-center">Shehan Fernando</div>
                        <div class="col-lg-12 text-center">No 55/3, Maind Street, Negombo</div>
                        <div class="col-lg-12 text-center">Tel: 031-2234342 / 077-7676784</div>
                        <div class="col-lg-12 text-center">Fax: 031-2234342</div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">  
                            <h4 class="modal-title" id="grn_records_ref"></h4>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
                            <h4 class="modal-title pull-right" id="grn_records_sup"></h4>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th> 

                                </tr>
                            </thead>
                            <tbody id="grn_print_products"></tbody>
                        </table> 
                        <div class="row rowPadding">
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">           
                                <h4 class="modal-title pull-right">Total amount(Rs.)</h4> 
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">           
                                <h3 class="modal-title pull-right" id="grn_records_tot"></h3> 
                            </div>
                        </div>
                        <div class="row rowPadding">
                            <div  class="col-lg-9 col-md-9 col-sm-8 col-xs-8">            
                                <h5 class="modal-title pull-right">Paid amount(Rs.)</h5> 
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">            
                                <h5 class="modal-title pull-right" id="grn_records_paid"></h5> 
                            </div>
                        </div>
                        <div class="row rowPadding">
                            <div  class="col-lg-9 col-md-9 col-sm-8 col-xs-8">                  
                                <h5 class="modal-title pull-right">Balance(Rs.)</h5>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">                  
                                <h5 class="modal-title pull-right" id="grn_records_balance"></h5>
                            </div>
                        </div>
                        <h5 class="modal-title pull-right" id="grn_records_issued" style="font-size: 10px">dsd</h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="row rowPadding">
                        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <button style="margin-bottom: 20px;" onclick="printPage()" class="btn btn-info">PRINT GRN</button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/shehan.main.js"></script>
</body>