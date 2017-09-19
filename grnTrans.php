<?php
include './metaLibs.php';
?>
<title>GRN Records</title>
<style>
    .es-list { max-height: 160px !important; }
    @media print {
        body * {
            visibility: hidden;
        }
        #grn_all_trans, #grn_all_trans * {
            visibility: visible;
        }
        #grn_all_trans{
            position: absolute;
            left: 0;
            top: 0;
        }

    }
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
<script>
    $(document).ready(function() {
    });

</script> 
</head>
<body>
    <?php
    include './pageheader.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="grn.php" class="pull-right btn btn-primary">New GRN&nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></div>
        </div>
        <div id="grn_all_trans">
            <div class="row">
                <div class="col-lg-12 text-center h2">GRN Trancactions</div>
            </div>

            <div class="row rowPadding">
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-2"></div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4"> 
                    <div class="form-group"> 
                        From: <input class="form-control dateBet" id="dateFrom" name="dateFrom" placeholder="YYYY-MM-DD" type="text"/> 
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4"> 
                    <div class="form-group"> 
                        To: <input class="form-control dateBet" id="dateTo" name="dateTo" placeholder="YYYY-MM-DD" type="text"/> 
                    </div> 
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-2"> 
                </div>
            </div>  
            <div class="row rowPadding">
                <div class="col-lg-2 col-md-1 col-sm-2"></div>
                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-12 text-center">
                    <button class="btn btn-info" type="button" onclick="loadGRNTrans()">LOAD <span class="glyphicon glyphicon-calendar"></span> </button>
                </div>
                <div class="col-lg-2 col-md-1 col-sm-2 "></div>
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
    <!--                                <th>Paid Amount</th>
                                    <th>Balance</th>-->
                                    <th>Supplier</th>
                                    <!--<th>Details</th>-->

                                </tr>
                            </thead>
                            <tbody id="grn_trans_table"></tbody>
                        </table> 
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
            </div>
            <div class="row rowPadding">
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <h3 id="grn_total" class="pull-right"></h3>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
            </div>
        </div>
        <div class="row rowPadding">
            <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <button style="margin-bottom: 20px;" onclick="printPage()" class="btn btn-info">PRINT GRN</button>
            </div>
        </div>
    </div>
    <script src="js/shehan.main.js"></script>
    <script>
                    $(document).ready(function(e) {


                        var date_input = $('.dateBet'); //our date input has the name "date"
                        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                        var options = {
                            format: 'yyyy-mm-dd',
                            container: container,
                            todayHighlight: true,
                            autoclose: true,
                        };
                        date_input.datepicker(options);


                    });
    </script>
</body>
</html>
