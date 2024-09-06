<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Initialize the session
require_once "connect.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$username_err= "";

 $username = $_SESSION["username"];
if(isset($_POST["submit"]))
{
    $submit = $_POST["submit"];

    if($submit == "submit")
    {
         $firstname = $_POST["firstname"];
         $lastname = $_POST["lastname"];
         $address = $_POST["address"];
         $address2 = $_POST["address2"];
         $address3 = $_POST["address3"];
         $city = $_POST["city"];
         $state = $_POST["state"];
         $pincode = $_POST["pincode"];
         $country = $_POST["country"];
        
        $res = updateProfileData($username,$firstname,$lastname,$address,$address2,$address3,$city,$pincode,$country,$state);
        $message = "Data Updated Successfully.";
         $res = getProfileData($username);
    }
}
else
{
    $message = "";
    if(isset($_REQUEST['message']))
    {
        $message = $_REQUEST['message'];
    }
    $res = getProfileData($username);
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
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

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
      <a href="index.php" class="logo">
          <img src="img/logo-header.svg" width= "95px" />
      </a>
      
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
                            <span class="username"><?php echo empty($res["firstname"]) ? $res["username"] :$res["firstname"]." ".$res["lastname"]  ?> </span>
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

    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
     
     
        <!-- page start-->
        <div class="row">
        <div class="col-lg-2"></div>
          <div class="col-lg-8">
          
            
              <div class="panel-body">
                <div class="tab-content">
                  <div id="recent-activity" class="tab-pane active">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1 style="text-align: center;"> <b>PROFILE</b> </h1>
                        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  role="form">
                          <?php
                           if(!empty($message)){
                            echo '<div class="alert alert-info">' . $message . '</div>';
                                }        
                        ?>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">First Name*</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" required id="firstname" name="firstname" placeholder=" " value="<?php echo !empty($res["firstname"]) ? $res["firstname"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Last Name*</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" required id="lastname" name="lastname" placeholder="" value="<?php echo !empty($res["lastname"]) ? $res["lastname"] : ''?>">
                            </div>
                          </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">User Name</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" disabled="disabled" id="username" name="username" placeholder="" value="<?php echo !empty($res["username"]) ? $res["username"] : ''?>">
                              </div>
                            </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Address Line 1</label>
                            <div class="col-lg-9">
                              <input type="text" name="address" id="address" class="form-control" value="<?php echo !empty($res["address"]) ? $res["address"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Address Line 2</label>
                            <div class="col-lg-9">
                              <input type="text" name="address2" id="address2" class="form-control" value="<?php echo !empty($res["address2"]) ? $res["address2"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Address Line 3</label>
                            <div class="col-lg-9">
                              <input type="text" name="address3" id="address3" class="form-control" value="<?php echo !empty($res["address3"]) ? $res["address3"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Pincode</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="occupation" name="pincode" placeholder="" value="<?php echo !empty($res["pincode"]) ? $res["pincode"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">City</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="city" placeholder="" name="city" value="<?php echo !empty($res["city"]) ? $res["city"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">State</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="state" placeholder="" name="state" value="<?php echo !empty($res["state"]) ? $res["state"] : ''?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Country</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="country" placeholder="" name="country" value="<?php echo !empty($res["country"]) ? $res["country"] : ''?>">
                            </div>
                          </div>
                       
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" class="btn btn-primary" value="submit" name="submit">Save</button>
                              
                            </div>
                          </div>
                        
                        </form>
                      </div>
                    </section>
                  </div>

                </div>
              </div>
         
          </div>
          <div class="col-lg-2"></div>
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
  <script src="js/scripts.js"></script>
</body>

</html>
