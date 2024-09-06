<?php
// Initialize the session
require_once "connect.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$username_err= "";

$username = $_SESSION["username"];
$res = getProfileData($username);

if(empty($res["firstname"]) || empty($res["lastname"]))
{
        header("location:welcome.php?message=please add account details first.");
}

?>

 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Welcome to The World - Members Portal">
  <meta name="author" content="Hindva">
  <meta name="keyword" content="Welcome to The World - Members Portal">
  <link rel="shortcut icon" href="img/favicon.svg">

  <title>The World</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/bootstrap-datepicker.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <script>
function myFunction() {
  alert('We are coming soon!');
}
</script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->

    <!-- =======================================================
      Theme Name: NiceAdmin
      Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
      Author: BootstrapMade
      Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <header class="header dark-bg">
    
      <!--logo start-->
      <a href="index.php" class="logo"><img src="img/logo.svg" width= "95px"/></a>
      <!--logo end-->


      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

       
          <!-- alert notification end-->
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <!-- <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span> -->
                            <span class="username"><?php echo $res["firstname"]." ".$res["lastname"]  ?> </span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="welcome.php"><i class="icon_profile"></i> My Profile</a>
              </li>
           <li>
                <a href="book.php"><i class="icon_bag"></i> Book</a>
              </li>
              <li>
                <a href="logout.php"><i class="icon_lock"></i> Log Out</a>
              </li>
             
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <!-- page start-->
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
          
            
              <div class="panel-body">
                <div class="tab-content">
                  <div id="recent-activity" class="tab-pane active">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1 style="text-align: center;"> <b>BOOKING</b></h1>
                        <form class="form-horizontal" method="post" role="form">
                          
                        
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Check In</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="checkin" name="checkin" placeholder=" " readonly
                              style='background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAmBJREFUaEPtWr9rFEEU/t4mhzYm+AfYndiI6Nu9SgMpAhps/CO0s9JKG2OjIFgL/gk2NoIWQYIoEtjZQ8FCOTtbi7tKxZ0ns2twjetmdsIjS24Xrtn93vd+v5lhjuD5MPOQSF44uAhdyrJs0iSqjd/RTZ72I47jW4DcK/F02xhzv0lWG9/agSThDRHcKcwn3E3TbKPJAW384XOAmc8QyRqAQV1kRWiNCO47RLBJJJtNGdDCE9GPPJeX4/H4XVEN7hfH/ADADQCRb08cME4APDImu07MfI0Ijw/YoCD1RHLVRf8TgJMlg30GLHyoY7PWXogiOl+grLyJouh1k1Y9vJwGcPl3KX8k5nM/iWjBvZhOZ0cnk8n3OsO0p4ov/3A4PLK8vPStdEBylwFXT8VjTPbfdcFXwQ6XJr5qs7cD2gtTG/4gB8qtAZ67zAG0boz53NQDmvggB4LGhJJQ74BSYL1p+wx4h0oJOJ8ZqC5M1cDWnQ2qEapidy+UbTirPEEZaKOsd2CPE9+8ZiBZBezqv4Ml2krTdKv63pVb3QDafY5OEn/OffeA0kQMog0qoSBNSkJBDrRJdydLqB+jNSe+NkHZdxO3UdYvZBoLmdJACaINmkJBmpSE5tOBvon7MfqnoYJ64BCUkP/Wt5N7IaWJGEQbVEJBmpSEegeUAutN22fAO1RKwL8ywMwzIhwrddGKMabx8k7JJm9aZl4hwqtSQKbuiukpgCveDJ0C2ieUJMkpEfsWwPFO2baHMSLydTDIzxa3kqPR6IS1+UMRuUhES112RERm7m8/i4v25vb2+y+/APM9625TV9oRAAAAAElFTkSuQmCC"); 
                              background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: pointer;'>
                              
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Check Out</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="checkout" name="checkout" placeholder=" " readonly
                              style='background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAmBJREFUaEPtWr9rFEEU/t4mhzYm+AfYndiI6Nu9SgMpAhps/CO0s9JKG2OjIFgL/gk2NoIWQYIoEtjZQ8FCOTtbi7tKxZ0ns2twjetmdsIjS24Xrtn93vd+v5lhjuD5MPOQSF44uAhdyrJs0iSqjd/RTZ72I47jW4DcK/F02xhzv0lWG9/agSThDRHcKcwn3E3TbKPJAW384XOAmc8QyRqAQV1kRWiNCO47RLBJJJtNGdDCE9GPPJeX4/H4XVEN7hfH/ADADQCRb08cME4APDImu07MfI0Ijw/YoCD1RHLVRf8TgJMlg30GLHyoY7PWXogiOl+grLyJouh1k1Y9vJwGcPl3KX8k5nM/iWjBvZhOZ0cnk8n3OsO0p4ov/3A4PLK8vPStdEBylwFXT8VjTPbfdcFXwQ6XJr5qs7cD2gtTG/4gB8qtAZ67zAG0boz53NQDmvggB4LGhJJQ74BSYL1p+wx4h0oJOJ8ZqC5M1cDWnQ2qEapidy+UbTirPEEZaKOsd2CPE9+8ZiBZBezqv4Ml2krTdKv63pVb3QDafY5OEn/OffeA0kQMog0qoSBNSkJBDrRJdydLqB+jNSe+NkHZdxO3UdYvZBoLmdJACaINmkJBmpSE5tOBvon7MfqnoYJ64BCUkP/Wt5N7IaWJGEQbVEJBmpSEegeUAutN22fAO1RKwL8ywMwzIhwrddGKMabx8k7JJm9aZl4hwqtSQKbuiukpgCveDJ0C2ieUJMkpEfsWwPFO2baHMSLydTDIzxa3kqPR6IS1+UMRuUhES112RERm7m8/i4v25vb2+y+/APM9625TV9oRAAAAAElFTkSuQmCC"); 
                              background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: pointer;'>
                              
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-9">
                                <button type="button" data-toggle="modal" data-target="#reservation-overlay" aria-label="Click to select rooms" style="background-image: revert;" >
                                    <i class="fa fa-bed"></i>
                                    <span class="reservation-rooms-count">1</span>
                                    <span class="reservation-rooms-text">Room</span>
                                    <span class="reservation-rooms-more hide">Room(s)</span>
                                    <!--<input type="hidden" name="reservationRooms" value="1">-->
                                </button>
                              <button type="button" data-toggle="modal" data-target="#reservation-overlay" aria-label="Click to select guests" style="background-image: revert;" >
                                <i class="fa fa-user"></i>
                                <span class="reservation-users-adult-count" ><span id="adult-cnt">1</span>
                                <span class="reservation-users-adult-text">Adult</span>
                                <span class="reservation-users-more hide">Adult(s)</span>
                                <span class="reservation-users-comma">,</span>
                                <span class="reservation-users-child-count" id="child-cnt">0</span>
                                <span class="reservation-users-child-text">Child</span>
                                <span class="reservation-users-child-more hide">Children</span>
                                <input type="hidden" name="reservationAdults" value="1">
                                <input type="hidden" name="reservationChilds" value="0">
                            </button>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
							<div class="col-lg-9" style="">
							    <div style="background-color:#f7f7f7;color: #000;height: 50px;">
                                    <label style="font-weight: revert;padding-left: 2px;padding-top: 13px;font-size: 17px;"> Room 1 </label>
                                </div>
							</div>
                         </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
							<div class="col-lg-9">
                              <div class="row">
                                    <div class="col-lg-2 col-sm-3 col-xs-3 custom-css-ac cust-css-tp">
                                           <strong>Adults</strong>   
                                    </div>
                                    <div class="col-lg-4 col-sm-3 col-xs-9 custom-css" id="handleCounter2" >
                                            <button type="button" class="counter-minus btn btn-primary" style="background-color:#f7f7f7;color: #000;">-</button>
                                            <input style="border:none; width: 25px;text-align: -webkit-center;" type="text" min="1" max="4" value="1" readonly>
                                            <button type="button" class="counter-plus btn btn-primary" style="background-color:#f7f7f7;color: #000;">+</button>
                                    </div>
									<div class="col-lg-2 col-sm-3 col-xs-3 custom-css-acc">
                                           <strong>Childrens<br>Age (0-12)</strong>  
                                    </div>
                                    <div class="col-lg-4 col-sm-3 col-xs-9 custom-css"  id="handleCounter">
                                            <button type="button" class="counter-child-minus btn btn-primary" style="background-color:#f7f7f7;color: #000;">-</button>
                                            <input  style="border:none; width: 25px;text-align: -webkit-center;" type="text"  min="0" max="6" value="0" readonly>
                                            <button type="button" class="counter-child-plus btn btn-primary" style="background-color:#f7f7f7;color: #000;">+</button>
                                    </div>
                              </div>
							</div>
                         </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="button"  class="btn btn-primary" onclick="myFunction()">Book</button>
                              
                            </div>
                          </div>
                        </form>
                      </div>
                    </section>
                  </div>

                </div>
              </div>
         
          </div>
          <div class="col-lg-3"></div>
        </div>

        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
   
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scripts.js"></script>
  <script>
  $(function() {
    $('#checkin').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: new Date('<?php echo date('Y-m-d'); ?>')
    });
    $('#checkout').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: new Date('<?php echo date('Y-m-d'); ?>')
    });
  });
  </script>
    <script src="js/handleCounter.js"></script>
    <script>
        $(function ($) {
            var options = {
                minimum: 0,
                maximize: 6,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#handleCounter2').handleCounter(options)
            
        })
        $(function ($) {
            var options = {
                minimum: 0,
                maximize: 4,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#handleCounter').handleCounter(options)
        })
        function valChanged(d) {
//            console.log(d)
        }
    </script>
</body>

</html>
