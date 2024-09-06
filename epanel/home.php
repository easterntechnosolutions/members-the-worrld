<?php
    session_start();
    include("header.php");
    $Userid = $_SESSION["uid"];
    include("db_connect.php");
    $obj = new DB_Connect();

    
?>


<div class="panel invoice">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <div class="invoice-logo">
                    <h2><i class="fa fa-home"></i> Welcome <?php echo ucfirst($_SESSION["username"]); ?></h2>
                </div>
            </div>

        </div>


    </div>
</div>

<div class="wrapper">
    <!--<div class="row state-overview state-alt">-->
    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--       <a href="confirmed_order.php"> <section class="panel y-border">-->
    <!--            <div class="symbol ">-->
    <!--               <img src="images/medical/confirm.svg" style="width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value">-->
    <!--                <h1>-->
    <!--                    <?php echo $confirm_order ?>-->
    <!--                </h1>-->
    <!--                <p>Confirm Order</p>-->
                   
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->

    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--         <a href="vendor_order_detail.php"><section class="panel p-border">-->
    <!--            <div class="symbol ">-->
    <!--                <img src="images/medical/pending.svg" style="width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1>-->
    <!--                    <?php echo $pending_order; ?>-->
    <!--                </h1>-->
    <!--                <p>Pending Order</p>-->
                   
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->
    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--     <a href="cancelled_order.php">    <section class="panel g-border">-->
    <!--            <div class="symbol">-->
    <!--              <img src="images/medical/cancel.svg" style="width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
    <!--                    <?php echo $cancel_order; ?>-->
    <!--                </h1>-->
    <!--                <p>Cancelled Order</p>-->
                    
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->
    <!--     <div class="col-lg-3 col-sm-6">-->
    <!--      <a href="partial_order.php">   <section class="panel g-border">-->
    <!--            <div class="symbol">-->
    <!--                 <img src="images/medical/partial2.svg" style="width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
    <!--                    <?php echo $partial_order; ?>-->
    <!--                </h1>-->
    <!--                <p>Partial Order</p>-->
                    
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->
       
    <!--</div>-->


    <!--<div class="row state-overview state-alt">-->
    <!-- <div class="col-lg-3 col-sm-6">-->
    <!--       <a href="delivered_order.php">  <section class="panel g-border">-->
    <!--            <div class="symbol">-->
    <!--                <img src="images/medical/Delivered.svg" style="width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
    <!--                    <?php echo $delivered_order; ?>-->
    <!--                </h1>-->
    <!--                <p>Delivered Order</p>-->
                    
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->
    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--     <a href="p_vendor.php">    <section class="panel y-border" style="border-left: 2px solid #174b73 !important;">-->
    <!--            <div class="symbol ">-->
    <!--               <img src="images/medical/1132738.png" style="width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value">-->
    <!--                <h1>-->
    <!--                    <?php echo $total_vendor["total_vendor"]; ?>-->
    <!--                </h1>-->
    <!--                <p>Total Pharmacy</p>-->
 
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->

    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--     <a href="p_product.php">    <section class="panel p-border" style="border-left: 2px solid #ea7a18 !important;">-->
    <!--            <div class="symbol ">-->
    <!--               <img src="images/medical/product.svg" style="    width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1>-->
    <!--                    <?php echo $total_product["total_product"] ?>-->
    <!--                </h1>-->
    <!--                <p>Total Products</p>-->
                   
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->
    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--     <a href="users.php">    <section class="panel g-border" style="border-left: 2px solid #1c7967 !important;">-->
    <!--            <div class="symbol">-->
    <!--                <img src="images/medical/user.svg" style="    width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
    <!--                    <?php echo $total_user["total_user"] ?>-->
    <!--                </h1>-->
    <!--                <p>Total User</p>-->
                    
    <!--            </div>-->
    <!--        </section></a>-->
    <!--    </div>-->
        
    <!--</div>-->

    <!--<div class="row state-overview state-alt">-->
        

       
       
    <!--     <div class="col-lg-3 col-sm-6">-->
    <!--        <section class="panel b-border">-->
    <!--            <div class="symbol ">-->
    <!--             <img src="images/medical/revenue.svg" style="    width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
    <!--                  $  <?php echo number_format($profit,2); ?>-->
    <!--                </h1>-->
    <!--                <p>Revenue</p>-->
                    

    <!--            </div>-->
    <!--        </section>-->
    <!--    </div>-->
    <!--     <div class="col-lg-3 col-sm-6">-->
    <!--        <section class="panel b-border">-->
    <!--            <div class="symbol ">-->
    <!--              <img src="images/medical/refund.svg" style="    width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
    <!--                  $  <?php echo number_format( $refund_pending_amount,2); ?>-->
    <!--                </h1>-->
    <!--                <p>Refund Pending</p>-->
                    

    <!--            </div>-->
    <!--        </section>-->
    <!--    </div>-->
    <!--    <div class="col-lg-3 col-sm-6">-->
    <!--        <section class="panel b-border" style="border-left: 2px solid #6b84f3 !important;">-->
    <!--            <div class="symbol ">-->
    <!--                <img src="images/medical/totalincome.svg" style="    width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
                        <!-- <?php echo ($total_sales["total_sales"] != "") ? "$ " . number_format($total_sales["total_sales"],2) : "00" ?> -->
    <!--                   $  <?php echo number_format($profit - $refund_pending_amount,2); ?>-->
    <!--                </h1>-->
    <!--                <p>Cash On Hand</p>-->
                    

    <!--            </div>-->
    <!--        </section>-->
    <!--    </div>-->
    <!--     <div class="col-lg-3 col-sm-6">-->
         
    <!--      <section class="panel b-border" style="border-left: 2px solid #6b84f3 !important;">-->
    <!--            <div class="symbol ">-->
    <!--                <img src="images/medical/totalincome.svg" style="    width: 59px;" />-->
    <!--            </div>-->
    <!--            <div class="value ">-->
    <!--                <h1 class="">-->
                    
    <!--                   $  <?php echo number_format($current_month_total,2); ?>-->
    <!--                </h1>-->
    <!--                <p>Subscription charge(Current Month)</p>-->
    <!--                 <p style="    color: #40bca7;">Total Subscription charge($ <?php echo number_format($current_month_total1,2); ?>)</p>-->
                    
                  
    <!--            </div>-->
                
    <!--        </section>-->
           
    <!--    </div>-->
    <!--</div>-->

</div>


</body>
</html>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>

<!--jquery-ui-->
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"
        type="text/javascript"></script>

<script src="js/jquery-migrate.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="js/slidebars.min.js"></script>

<!--switchery-->
<script src="js/switchery/switchery.min.js"></script>
<script src="js/switchery/switchery-init.js"></script>

<!--flot chart -->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/flot-spline.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.pie.js"></script>
<script src="js/flot-chart/jquery.flot.selection.js"></script>
<script src="js/flot-chart/jquery.flot.stack.js"></script>
<script src="js/flot-chart/jquery.flot.crosshair.js"></script>


<!--earning chart init-->
<script src="js/earning-chart-init.js"></script>

<!--form validation-->
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<!--form validation init-->
<script src="js/form-validation-init.js"></script>

<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<script src="js/sparkline/sparkline-init.js"></script>

<!--easy pie chart-->
<script src="js/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="js/easy-pie-chart.js"></script>

<!--Data Table-->
<script src="js/data-table/js/jquery.dataTables.min.js"></script>
<script src="js/data-table/js/dataTables.tableTools.min.js"></script>
<script src="js/data-table/js/bootstrap-dataTable.js"></script>
<script src="js/data-table/js/dataTables.colVis.min.js"></script>
<script src="js/data-table/js/dataTables.responsive.min.js"></script>
<script src="js/data-table/js/dataTables.scroller.min.js"></script>
<!--data table init-->
<script src="js/data-table-init.js"></script>


<!--vectormap-->
<script src="js/vector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/vector-map/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/dashboard-vmap-init.js"></script>

<!--Icheck-->
<!--<script src="js/icheck/skins/icheck.min.js"></script>
<script src="js/todo-init.js"></script>

<!--jquery countTo-->
<!--<script src="js/jquery-countTo/jquery.countTo.js"  type="text/javascript"></script>

<!--owl carousel-->
<!--<script src="js/owl.carousel.js"></script>

<!--select2-->
<!--<script src="js/select2.js"></script>

<!--select2 init-->
<!--<script src="js/select2-init.js"></script>

<!--picker initialization-->
<!--<script src="js/picker-init.js"></script>

<!--bootstrap picker-->
<!--<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!--common scripts for all pages-->

<script src="js/scripts.js"></script>



