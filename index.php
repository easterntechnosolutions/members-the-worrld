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
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["mobile"])) && empty(trim($_POST["email"]))){
        $username_err = "Please enter mobile number or email address.";
    } 
    else if(!empty(trim($_POST["mobile"])) )
    {
        $username = "+91".trim($_POST["mobile"]);
    }
    else if(!empty(trim($_POST["email"])) )
    {
        $username = trim($_POST["email"]);
    }
 
    if(empty($username_err)){

        
    
         
     
        if(is_numeric(str_replace("+","",$username)))
        {
        

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=60ebda19babea16d12251e14&mobile=".$username."&authkey=187012AX78Z2ueNVr60f554adP1&otp_length=6&otp_expiry=10",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "{\"Value1\":\"Param1\",\"Value2\":\"Param2\",\"Value3\":\"Param3\"}",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json"
                ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) 
                {
                //    echo "cURL Error #:" . $err;
                    $login_err = "Please Try Again";
                } 
                else 
                {
              
                
                  $res = json_decode($response,true);
              
                    if($res["type"] == "success")
                    {
                        $otp="";
                        login_or_signup($username,$otp);        
                    }
                    else 
                    {
                        $login_err = "Please Try Again";
                        $login_err =  $res['message'];
                    }

                

                }

                
            }
            else if(isValidEmail($username))
            {

                
                $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $string_shuffled = str_shuffle($string);
                $otp = substr($string_shuffled, 1, 7);
                login_or_signup($username,$otp);
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
                }
            }
            else
            {
                 $login_err = "Invalid Email ID or Mobile Number.";
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
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

<script>
    
    function mobilechange() 
    {
        var mono = document.getElementById("mobile").value;
        if(mono != "")
        {
            document.getElementById("email").value = "";
         
            if(mono.includes("+91"))
            {
                document.getElementById("mobile").value = mono.replace("+91", "");
            }
        }
        
      
        
    }
    function emailchange() 
    {
        var email = document.getElementById("email").value;
        if(email != "")
        {
            document.getElementById("mobile").value = "";
        }
        
    }
    function validate()
    {
        
        var mono = document.getElementById("mobile").value;
        var email = document.getElementById("email").value;
        
        
        if(mono != "")
        {
        
            if(mono.length == 10)
            {
                return true;
            }
            else
            {
                alert("Mobile Number must be 10 characters long.");
                return false;
            }
            
        }
        else if(email != "")
        {
           
            
                if(validateEmail(email))
                {
                    return true;
                }
                else
                {
                    alert("Email Address is not valid.")
                    return false;
                }
            
        }
        else
        {
            alert("Please add Mobile Number or Email Address.");
            return false;
        }
        
        
    }
    function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
    }
</script>
</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" method="post" onsubmit="return validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_phone"></i></tab></span>
          <span class="input-group-addon">+91</span>
          <input type="text" name="mobile" id="mobile" onKeyUp="mobilechange()" class="form-control"  placeholder="Mobile Number" autofocus>
          
        </div>
        <center><div style="margin-top: -10px; margin-bottom: 10px;font-size:12px">(Indian Mobile Number Only!)</div></center>
       <center> <div style=" margin-top: -10px; margin-bottom: 10px;font-size:18px">or</div></center>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_mail"></i></span>
          <input type="text" name="email" id="email" class="form-control" onKeyUp="emailchange()"  placeholder="Email Address">
          
        </div>
        
    
        <button class="btn btn-primary btn-lg btn-block" type="submit"  value="Login">Login / SignUp</button>
        <?php
        if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
        ?>
      </div>
    </form>
  </div>
</body>
</html>
