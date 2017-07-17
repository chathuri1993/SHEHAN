
<?php
include './metaLibs.php';
?>
<title>Supplier Registration</title>
<script>
    $(document).ready(function () {
        loadSupplierDetails();
    });

</script>
</head>
<body>
    <?php
    include './pageheader.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center h2">Supplier Regitration</div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Name</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <input type="text" class="form-control" placeholder="Will Smith" id="supplier_name" name="suppliername" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Contact No</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <input type="text" class="form-control" placeholder="0777777777" id="supplier_contactno" name="supplier_contactno" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Address</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <textarea class="form-control" placeholder="No 45, Main Rd, Colombo" id="supplier_address" name="supplier_address" aria-describedby="basic-addon1"></textarea>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-5 col-md-5 col-sm-4"></div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6 text-center">
                <input type="hidden" value="save" id="supplier_action">
                <input type="hidden" value="0" id="supplier_id">
                <button class="btn btn-default btn-primary btnsize" onclick="supplierRegitation()" id="supplier_save">Save</button>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6 text-center">
                <button class="btn btn-default btnsize" onclick="sup_cancel()">Cancel</button>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-4 col-xs-2"></div>
        </div>
        <hr>
        <div class="row rowPadding">
            <div class="col-lg-12 h4 text-center">All Suppliers</div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-1"></div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search suppliers">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </span>
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-1"></div>
        </div> 
        <div class="row rowPadding">
            <div class="col-lg-1 col-md-4 col-sm-3 "></div>
            <div class="col-lg-10 col-md-4 col-sm-3 col-xs-12">
                <table class="table table-hover table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Address</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="supplier_table">


                    </tbody>
                </table> 
            </div>
            <div class="col-lg-1 col-md-4 col-sm-3"></div>
        </div>

    </div>

    <script src="js/shehan.main.js"></script>
</body>
</html>
