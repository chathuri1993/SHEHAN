<?php
include './metaLibs.php';
?>
<title>Product Registration</title>
<script>
    $(document).ready(function() {
        loadProductSupplierNames();
        loadCategories();
//        loadItemDetails();
    });

</script>
</head>
<body>
    <?php
    include './pageheader.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center h2">Product Registration</div>

        </div>

        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div id="item_status"></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Item Code</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <span id="item_code_span" class="spanMsg"></span>
                <input type="text" class="form-control" onfocus="clearElement('#item_code_span')" required placeholder="123-569" id="item_code" name="itemcode" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Description</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <span id="item_des_span" class="spanMsg"></span>
                <input type="text" class="form-control" onfocus="clearElement('#item_des_span')" required placeholder="BRIGESTONE-345" id="item_des" name="itemdescription" aria-describedby="basic-addon1">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Re-Order Level</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <span id="reorder_span" class="spanMsg"></span>
                <input type="number" min="0" value="1" class="form-control" onfocus="clearElement('#reorder_span')" required placeholder="1" id="reorder_level" name="reorderlevel" aria-describedby="basic-addon1"> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Company List Price</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <span id="unitprice_span" class="spanMsg"></span>
                <input type="number" min="0" step="0.01" class="form-control" onfocus="clearElement('#unitprice_span')" required placeholder="5000.00" id="item_unitprice" name="itemunitprice" aria-describedby="basic-addon1"> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 "></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Category</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <span id="item_category_span" class="spanMsg"></span>
                <select id="item_category" onfocus="clearElement('#item_category_span')" name="itemcategory" class="form-control"> 
                </select>
            </div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-3 col-md-3 col-sm-2"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                <label class="valign">Supplier</label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
                <span id="item_sup_span" class="spanMsg"></span>
                <select id="item_supplier" onfocus="clearElement('#item_sup_span')" name="itemsupplier" class="form-control" onclick="loadDiscountHint(this.value);"> 
                </select>                
            </div>
            <span id="item_dis_hint" style="color: green;"></span>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-5 col-md-5 col-sm-4"></div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6 text-center">
                <input type="hidden" value="save" id="item_action">
                <input type="hidden" value="0" id="item_id">
                <button class="btn btn-default btn-primary btnsize" onclick="ProductRegitation()" id="item_save">Save</button>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6 text-center">
                <button class="btn btn-default btnsize" onclick="item_cancel()">Cancel</button>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-4 col-xs-2"></div>
        </div>
        <hr>
        <div class="row rowPadding">
            <div class="col-lg-12 h4 text-center">All Products</div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-4 col-md-1 col-sm-2"></div>
            <div class="col-lg-4 col-md-10 col-sm-8 col-xs-12">

                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_item_concept">Filter by</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#itemcode">Item Code</a></li>
                            <li><a href="#s.name">Supplier</a></li>
                            <li><a href="#description">Item Description</a></li>
                            <li><a href="#c.name">Category</a></li>
                            <li><a href="#available_qty">Quantity <=</a></li>
                            <li><a href="#unit_price">Unit Price >=</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="search_itemparam" value="itemcode" id="search_item_param">         
                    <input type="text" id="item_name_key" onkeyup="loadItemDetails(1)" class="form-control" name="x" placeholder="Search term...">
                    <span class="input-group-btn">
                        <button onclick="loadItemDetails(1)" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>

            </div>
            <div class="col-lg-4 col-md-1 col-sm-2 "></div>
        </div>

        <div class="row rowPadding">
            <div class="col-lg-1 col-md-4 col-sm-3 "></div>
            <div class="col-lg-10 col-md-4 col-sm-3 col-xs-12">
                <span class="label label-danger">Red row products are out of stock</span>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <colgroup id="randomColColor">                           
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Description</th>
                                <th>Unit Price</th>
                                <th>Category</th>
                                <th>Available Qty</th>
                                <th>Supplier</th>
                                <th>Reorder level</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="item_table">


                        </tbody>
                    </table> 
                </div>
            </div>
            <div class="col-lg-1 col-md-4 col-sm-3"></div>
        </div>
        <div class="row rowPadding">
            <div class="col-lg-4 col-md-3 col-sm-2 col-xs-1"></div>
            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-10">
                <div id="content-wrapper">
                    <div class="inner clearfix"> 
                        <div class="text-center">
                            <ul id="pagination-demo3" class="pagination-sm"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-2 col-xs-1"></div>
        </div>

    </div>
    <script>
        $(document).ready(function(e) {

            $('#pagination-demo3').twbsPagination({
                totalPages: "5",
                visiblePages: "2",
                onPageClick: function(event, page) {

                    loadItemDetails(page);

                }
            });

            $('.search-panel .dropdown-menu').find('a').click(function(e) {
                e.preventDefault();
                var param = $(this).attr("href").replace("#", "");

                var concept = $(this).text();

                $('.search-panel span#search_item_concept').text(concept);
                $('.input-group #search_item_param').val(param);
            });
        });
    </script>
    <script src="js/shehan.main.js"></script>
</body>
</html>
