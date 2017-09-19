<?php
include './metaLibs.php';
?>
<title>GRN Records</title>
<style>
    .es-list { max-height: 160px !important; }
</style>
<script>
    $(document).ready(function() {

//        loadGRNRecords();
    });

</script>
<style>
    .modal {
        text-align: center;
        padding: 0!important;
    }

    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
</style>
</head>
<body>
    <?php
    include './pageheader.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="grn.php" class="pull-right btn btn-primary">New GRN&nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center h2">GRN Records</div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-5 col-md-3 col-sm-3 col-xs-2"></div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-8">
                <form method="post">
                    <div class="form-group"> <!-- Date input -->
                        <!--<label class="control-label" for="date">Date</label>-->
                        <input class="form-control" id="date" name="date" onchange="loadGRNRecords()" placeholder="YYYY-MM-DD" type="text"/>

                    </div>
                </form>

            </div>
            <div class="col-lg-5 col-md-3 col-sm-3 col-xs-2"> 
                <button onclick="setGRNHiddenValue()" class="btn btn-info" type="button">ALL <span class="glyphicon glyphicon-refresh"></span>
                </button><input type="hidden" id="all_grnrecords" value="0"/></div>
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
                            <li><a href="#idgrn">GRN Id</a></li>
                            <li><a href="#name">Supplier</a></li>
                            <li><a href="#issued_by">Issued By</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="search_param" value="idgrn" id="search_param">         
                    <input type="text" id="search_val" onkeyup="loadGRNRecords()" class="form-control" name="x" placeholder="Search term...">
                    <span class="input-group-btn">
                        <button onclick="loadGRNRecords()" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>

            </div>
            <div class="col-lg-4 col-md-1 col-sm-2 "></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-2 col-md-1 col-sm-2"></div>
            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-12">
                <div id="grn_records_status"></div>
            </div>
            <div class="col-lg-2 col-md-1 col-sm-2 "></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="table-responsive">    
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>GRN Id</th>
                                <th>Issued Date</th>
                                <th>Total amount</th>
                                <!--<th style="display:none;">Total amount</th>-->
                                <th>Paid Amount</th>
                                <th>Balance</th>
                                <th>Supplier</th>
                                <th>Details</th>

                            </tr>
                        </thead>
                        <tbody id="grn_records_table"></tbody>
                    </table> 
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-4 col-md-3 col-sm-2 col-xs-1"></div>
            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-10">
                <div id="content-wrapper">
                    <div class="inner clearfix"> 
                        <div class="text-center">
                            <ul id="pagination-demo" class="pagination-sm"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-2 col-xs-1"></div>
        </div>


        <!--GRN Records Products--> 
        <!-- Modal -->
        <div class="modal fade" id="grn_products" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="grn_records_ref"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">    
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>

                                    </tr>
                                </thead>
                                <tbody id="grn_records_products"></tbody>
                            </table> 
                            <h5 class="modal-title pull-right" id="grn_records_issued"></h5>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script src="js/shehan.main.js"></script>
    <script>
                            $(document).ready(function(e) {

                                $('#pagination-demo').twbsPagination({
                                    totalPages: "5",
                                    visiblePages: "2",
                                    onPageClick: function(event, page) {

                                        loadGRNRecords(page);

                                    }
                                });

//                                $('#pagination-demo').twbsPagination({
//                                    totalPages: "5",
//                                    visiblePages: "3",
//                                    onPageClick: function(event, page) {
//                                        $('#page-content').text('Page ' + page);
//                                    }
//                                });
//                                var d = new Date();
//
//                                var month = d.getMonth() + 1;
//                                var day = d.getDate();
//
//                                var output = d.getFullYear() + '-' +
//                                        (month < 10 ? '0' : '') + month + '-' +
//                                        (day < 10 ? '0' : '') + day;
//
//                                $('input[name="date"]').val(output);
                                var date_input = $('input[name="date"]'); //our date input has the name "date"
                                var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                                var options = {
                                    format: 'yyyy-mm-dd',
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
