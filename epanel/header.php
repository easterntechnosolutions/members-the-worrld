<?php
ob_start();
error_reporting(0);
session_start();
session_start();
include ("connect.php");
if(!isset($_SESSION["login"]) )
{
    header("location:index.php");
}

date_default_timezone_set('Asia/Calcutta');
$username=$_SESSION["username"];

$userid=$_SESSION["userid"];
$uid=$_SESSION["uid"];

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="googlebot" content="noindex">
    <meta name="robots" content="noindex">
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
   <!--  <link rel="shortcut icon" href="javascript:;" type="image/png"> -->

    <title>The World</title>

    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">
   <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--switchery-->
    <link href="js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!--common style-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <!--theme color layout-->
    <link href="css/layout-theme-two.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="js/bootstrap-timepicker/compiled/timepicker.css"/>
	<link rel="stylesheet" type="text/css" href="js/bootstrap-datetimepicker/css/datetimepicker.css"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- script for ajax-->
   <script src="js/jquery.min.js"></script>
      <!--<script src="js/jquery-1.12.4.js"></script> -->



</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo bg-info visible-xs-* visible-sm-*">
                <a href="home.php">
                    <img src="../img/logo.jpeg" style="height:40px;width:auto;" alt="">
                    <!--<i class="fa fa-maxcdn"></i>
                    <span class="brand-name">Pharma</span>-->
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices start-->

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li class="active"><a href="home.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li>
                         
                        <a href="users.php"><i class="fa fa-laptop"></i>  <span>Users</span></a>
                    </li>
                    
                 
                   <!-- <li class="menu-list nav-active">
                        <a href="#"><i class="fa fa-laptop"></i>  <span> Order Related Masters</span></a>
                        <ul class="child-list">
                            <li><a href="p_order.php"> Orders</a></li>
                            <li><a href="p_order_details.php"> Order Details</a></li>
                            <li><a href="p_cart.php"> Cart</a></li>
                            <li><a href="p_bill.php"> Bill</a></li>
                        </ul>
                    </li>-->



                </ul>
                <!--sidebar nav end-->



            </div>
        </div>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content wrapper" style="min-height: 1000px;">

            <!-- header section start-->
            <div class="header-section bg-info light-color">

                <!--logo and logo icon start-->
                <div class="logo bg-info hidden-xs hidden-sm">
                    <a href="index.php">
                        <img src="../img/logo.jpeg" style="height:40px;width:auto;" alt="">
                        <!--<i class="fa fa-maxcdn"></i>
                        <span class="brand-name">Pharma</span>-->
                    </a>
                </div>

                <div class="icon-logo bg-info hidden-xs hidden-sm">
                    <a href="index.php">
                        <img src="img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->


                <div class="notification-wrap">

                
                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">


                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <?php echo ucfirst($username)?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                <li><a href="profile.php">  Profile</a></li>

                                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>


                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>

           

<?php
            if($_REQUEST["msg"]=='updated')
            {

                ?>

                <div class="alert alert-info fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Message:</strong>Data Updated Successfully.
                </div>
            <?php
			}

			if($_REQUEST["msg"]=='notupdated')
            {

                ?>
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Message:</strong>Data is not Updated.
                </div>
            <?php
			}

			if($_REQUEST["msg"]=='inserted')
            {

                ?>

                <div class="alert alert-info fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Message:</strong>Data inserted Successfully.
                </div>
            <?php
			}

			if($_REQUEST["msg"]=='del')
            {

                ?>

                <div class="alert alert-info fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Message:</strong>Data Deleted Successfully.
                </div>
            <?php
			}

if($_REQUEST["msg"]=='notdeleted')
            {

                ?>
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Message:</strong>Data not Deleted.
                </div>
            <?php
			}

 if($_REQUEST["msg"]=='mail_success')
    {
        
        ?>

        <div class="alert alert-info fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Message:</strong>E-mail has been sent Successfully.
        </div>
        <?php
    }
    
    if($_REQUEST["msg"]=='mail_fail')
    {
        
        ?>
        <div class="alert alert-block alert-danger fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Message:</strong>Some error occured.<br/><?php echo $_REQUEST["msg"]?>
        </div>
        <?php
    }

				?>
