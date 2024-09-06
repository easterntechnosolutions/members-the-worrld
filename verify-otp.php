<?php
// Initialize the session
require_once "connect.php";
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: book.php");
    exit;
}
 
// Include config file
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";


if(isset($_GET['username']))
{
        if($_REQUEST['username'] != "")
        {
                $username = str_replace("%2b","+",$_REQUEST['username']);

        }
}

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    

        if($_POST["submit"] == "resend")
        {
           
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Please enter username.";

        } else
        {

             $username = trim($_POST["username"]);
        }
        
   
        if( !empty(trim($_POST["username"])))
        {


                if(is_numeric(str_replace("+","",$username)))
                {
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.msg91.com/api/v5/otp/retry?authkey=187012AX78Z2ueNVr60f554adP1&retrytype=text&mobile=".$username,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                    echo "cURL Error #:" . $err;
                    } else {
                    
                     $login_err = "OTP Sent.";
                     $res = json_decode($response,true);
                       if($res["type"] == "success")
                    {
                        login_or_signup($username,$otp);        
                             $login_err = $res["message"] ;
                    }
                    }



                }
                else if(isValidEmail($username))
                {
                    
                    $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $string_shuffled = str_shuffle($string);
                    $otp = substr($string_shuffled, 1, 7);
                    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.msg91.com/api/v5/email/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\n  \"to\": [\n    {\n      \"name\": \"\",\n      \"email\": \"".$username."\"\n    }\n  ],\n  \"from\": {\n    \"name\": \"\",\n    \"email\": \"no-reply@hindva.com\"\n  },\n  \"domain\": \"hindva.com\",\n  \"mail_type_id\": \"1\",\n  \"template_id\": \"Login_OTP_The_Worl\",\n  \"variables\": {\n    \"VAR2\": \"".$otp."\"\n  },\n  \"authkey\": \"187012AX78Z2ueNVr60f554adP1\"\n}",
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "content-type: application/JSON"
                    ),
                    ));
                 $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        $login_err = "Please Try Again";
                    } else {
                //   echo $response;
                login_or_signup($username,$otp);
                $login_err = "Otp Sent Successfully.";
                    }
                }
        }
    }
    else
    {

    

    
    if(empty(trim($_POST["username"])))
    {
        $login_err = "Please enter username.";

    } else
    {

         $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["otp"])))
    {
        $login_err = "Please enter your otp.";
    }
    else
    {
        $password = trim($_POST["otp"]);
    }

    if(!empty(trim($_POST["otp"])) && !empty(trim($_POST["username"])))
    {

  
    
        if(is_numeric(str_replace("+","",$username)))
        {
           
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.msg91.com/api/v5/otp/verify?authkey=187012AGlZZMFpqL60e82a2fP1&mobile=".$username."&otp=".$password,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) 
                {        
                    $login_err = $err;
                }         
                else 
                {
                   
                    $res = json_decode($response,true);
                  
                if($res["type"] == "success")
                {
                    if(verify_otp($username,$password))
                    {
                        header("location:book.php?name=".$username);
                    } 
                    else
                    {
                        $login_err = "invalid otp. please try again.".$res;
                       
                    }
                }
                else 
                {
                    $login_err = "Please Try Again";
                    $login_err = $res['message'];
                }

              
                }
        }
         else if(isValidEmail($username))
        {
            
            if(verify_email_otp($username,$password))
            {
                header("location:book.php?name".$username);
            } 
            else
            {
                $login_err = "invalid otp. please try again.";
            }

        }

        
        
    }
    else
    {
      $login_err = "Please enter your otp.";
    }
    
}

}

function isValidEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.svg">

  <title>The World</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name="username" class="form-control" readonly required placeholder="Mobile Numebr / Email Address" value="<?php echo $username; ?>" >
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name="otp" class="form-control"  placeholder="OTP" >
        </div>
        <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="login">Login / SignUp</button>
        <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="resend" id="resend" onSubmit="return resetOtp();">Resend</button>
        <?php
        
        if(!empty($login_err)){
            echo '<div class="alert alert-info">' . $login_err . '</div>';
                }        
        ?>
      </div>
    </form>

  </div>
  <script>
  function resetOtp(){
        var timeleft = 60;
        document.getElementById("resend").disabled = true;
        var downloadTimer = setInterval(function(){
          if(timeleft <= 0){
            timeleft = 60;
            document.getElementById("resend").innerHTML = "Resend";    
            document.getElementById("resend").disabled = false;
            clearInterval(downloadTimer);
          
          }else{
              document.getElementById("resend").innerHTML = "Resend ( " + timeleft + " )";
              timeleft -= 1;
           
          }
        }, 1000);
        
        if(timeleft<=0)
        {
               return true;
        }
        else 
        {
            return false;
        }
  }
  resetOtp();
  </script>

</body>

</html>
