<?php
include './metaLibs.php';
?>
<title>Supplier Registration</title>
<style>
    .es-list { max-height: 160px !important; }
</style>
<script>
    $(document).ready(function () {
        $('#editable-select').editableSelect();
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
                <input type="text" class="form-control" required placeholder="12345" id="grn_id" name="grnid" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Supplier</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">         
                <select id="editable-select" class="form-control">
                    <option>Alfa Romeo</option>
                    <option>Audi</option>
                    <option>BMW</option>
                    <option>Citroen</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 "></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Product</label>
            </div>
            <div class="col-lg-7 col-md-5 col-sm-7 col-xs-12">

                <select id="editable-select" class="form-control">
                    <option>Alfa Romeo</option>
                    <option>Audi</option>
                    <option>BMW</option>
                    <option>Citroen</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-8 col-md-1 col-sm-1 col-xs-12">
                <table class="table table-hover table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit price</th>
                            <th>Qty</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="supplier_table">


                    </tbody>
                </table> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 "></div>
        </div>

    </div>
</body>