<?php
include './metaLibs.php';
?>
<title>Supplier Registration</title>
<style>
    .es-list { max-height: 160px !important; }
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
            <div class="col-lg-12 text-center h2">GRN Records</div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-4 col-md-1 col-sm-2"></div>
            <div class="col-lg-4 col-md-10 col-sm-8 col-xs-12">

                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">Filter by</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#contains">Contains</a></li>
                            <li><a href="#its_equal">It's equal</a></li>
                            <li><a href="#greather_than">Greather than ></a></li>
                            <li><a href="#less_than">Less than < </a></li>
                            <li class="divider"></li>
                            <li><a href="#all">Anything</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="search_param" value="all" id="search_param">         
                    <input type="text" class="form-control" name="x" placeholder="Search term...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>

            </div>
            <div class="col-lg-4 col-md-1 col-sm-2 "></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-5 col-md-3 col-sm-3 col-xs-2"></div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-8">
                <form method="post">
                    <div class="form-group"> <!-- Date input -->
                        <!--<label class="control-label" for="date">Date</label>-->
                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 col-md-3 col-sm-3 col-xs-2"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-2 col-md-1 col-sm-2"></div>
            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-12">
                <div id="grn_status"></div>
            </div>
            <div class="col-lg-2 col-md-1 col-sm-2 "></div>
        </div>




        <div class="row rowPadding">
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
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
                    <tbody id="grn_table"></tbody>
                </table> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1"></div>
        </div>


    </div>
    <script src="js/shehan.main.js"></script>
    <script>
    $(document).ready(function(e) {


        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);

        $('.search-panel .dropdown-menu').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#", "");
            var concept = $(this).text();
            $('.search-panel span#search_concept').text(concept);
            $('.input-group #search_param').val(param);
        });
    });
    </script>
</body>
</html>
