<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'theworld_book');
define('DB_PASSWORD', 'theworld_book');
define('DB_NAME', 'theworld_book');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
function login_or_signup($username,$otp) 
{
    
    global $link;
  
  $qr = "select * from users where username = ? ";

   if($stmt = mysqli_prepare($link, $qr)){
     
            $param_username = $username;
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            
            
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {  

                    mysqli_stmt_close($stmt);
                    $qr = "update users set otp = ? where username = ?";
            
                      if($stmt1 = mysqli_prepare($link, $qr)){
                          mysqli_stmt_bind_param($stmt1, "ss", $otp,$username);
                            if(mysqli_stmt_execute($stmt1)){
                                    mysqli_stmt_close($stmt1);
                                   header("location:verify-otp.php?username=".urlencode($username));
                                
                            }
                            else
                            {
                                echo mysqli_stmt_error($stmt1);
                                  echo "redirect statement";
                                    //exit();
                            }
                      }
                }
                else if(mysqli_stmt_num_rows($stmt) == 0)
                {

                    
                    mysqli_stmt_close($stmt);
                    $qr = "insert into users (username,otp) values (?,?)";
            
                      if($stmt1 = mysqli_prepare($link, $qr)){
                          mysqli_stmt_bind_param($stmt1, "ss", $username,$otp);
                            if(mysqli_stmt_execute($stmt1)){
                                    mysqli_stmt_close($stmt1);
                                   
                                    
                                    header("location:verify-otp.php?username=".urlencode($username));
                                
                            }
                            else
                            {
                                echo mysqli_stmt_error($stmt1);
                                  echo "redirect statement";
                                    //exit();
                            }
                      }
                      else
                      {
                            echo mysqli_stmt_error($stmt1);
                      }

                }
                else
                {
                    echo "redirect else";
                    //exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                //exit();
        
            }
}
else
{
    echo "Oops! Something went wrong. Please try again later2.";
                //exit();
}
}
function verify_email_otp($username,$otp) 
{
  
    global $link;
  
    $qr = "select id,username from users where username = ? and otp = ? ";
    

   if($stmt = mysqli_prepare($link, $qr))
   {
         mysqli_stmt_bind_param($stmt, "ss", $username,$otp);
         
         if(mysqli_stmt_execute($stmt))
         {

                mysqli_stmt_store_result($stmt);

                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $usernameres="";
                    $id="";

                     mysqli_stmt_bind_result($stmt, $id, $usernameres);
                     while (mysqli_stmt_fetch($stmt))
                        {
                                    
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $usernameres;    
                                    mysqli_stmt_close($stmt);

                                    $qr = "update users set otp = ? where username = ?";
            
                                    if($stmt1 = mysqli_prepare($link, $qr))
                                    {
                                        $blank = "";
                                        mysqli_stmt_bind_param($stmt1, "ss", $blank,$username);
                                        mysqli_stmt_execute($stmt1); 
                                        mysqli_stmt_close($stmt1);
                                        
                                    }

                                    
                                    return true;

                        }

                }
                else
                {
                    return false;
                }

        
         }
         else
         {
             return false;
         }

   }
   else
   {
       return false;
   }
     

}
function verify_otp($username,$otp) 
{
      global $link;
  
    $qr = "select id,username from users where username = ?";
    

   if($stmt = mysqli_prepare($link, $qr))
   {
         mysqli_stmt_bind_param($stmt, "s", $username);
         
         if(mysqli_stmt_execute($stmt))
         {

                mysqli_stmt_store_result($stmt);

                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $usernameres="";
                    $id="";

                     mysqli_stmt_bind_result($stmt, $id, $usernameres);
                     while (mysqli_stmt_fetch($stmt))
                        {
                                    
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $usernameres;    
                                    mysqli_stmt_close($stmt);

                                    $qr = "update users set otp = ? where username = ?";
            
                                    if($stmt1 = mysqli_prepare($link, $qr))
                                    {
                                        $blank = "";
                                        mysqli_stmt_bind_param($stmt1, "ss", $blank,$username);
                                        mysqli_stmt_execute($stmt1); 
                                        mysqli_stmt_close($stmt1);
                                        
                                    }

                                    
                                    return true;

                        }

                }
                else
                {
                    return false;
                }

        
         }
         else
         {
             return false;
         }

   }
   else
   {
       return false;
   }
   
}

function getProfileData($username) 
{
      global $link;
  
    $qr = "select id,firstname,lastname,username,profile_photo,address,address2,address3,city,state,pincode,country from users where username = ?";
    

   if($stmt = mysqli_prepare($link, $qr))
   {
         mysqli_stmt_bind_param($stmt, "s", $username);
         
         if(mysqli_stmt_execute($stmt))
         {

                mysqli_stmt_store_result($stmt);

                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                   $id;
    
                   $profile_photo;
                   $username;
                   $firstname;
                   $lastname;
                   $address;
                   $address2;
                   $address3;
                   $city;
                   $state;
                   $pincode;
                   $country;

                     mysqli_stmt_bind_result($stmt, $id,$firstname,$lastname ,$username,$profile_photo,$address,$address2,$address3,$city,$state,$pincode,$country);
                     while (mysqli_stmt_fetch($stmt))
                        {
                                    $ar =array();
                                    $ar["id"] = $id;
                                    $ar["profile_photo"] = $profile_photo ;
                                    $ar["firstname"] = $firstname ;
                                    $ar["lastname"] = $lastname ;
                                    $ar["username"]=$username;
                                    $ar["address"]=$address;
                                    $ar["address2"]=$address2;
                                    $ar["address3"]=$address3;
                                    $ar["city"]=$city;
                                    $ar["state"]=$state;
                                    $ar["pincode"]=$pincode;
                                    $ar["country"]=$country;
                                    
                                    
                                    
                                    return $ar;
                                    break;

                        }

                }
                else
                {
                    return false;
                }

        
         }
         else
         {
             return false;
         }

   }
   else
   {
       return false;
   }
   return false;
}
function updateProfileData($username,$firstname,$lastname,$address,$address2,$address3,$city,$pincode,$country,$state)
{

    global $link;
    $qr = "update users set firstname = ?,lastname = ?,address = ?,address2 = ?,address3 = ?,city =?,pincode =?,country= ?,state=? where username = ?";

    if($stmt1 = mysqli_prepare($link, $qr))
    {
        
        mysqli_stmt_bind_param($stmt1, "ssssssssss", $firstname,$lastname,$address,$address2,$address3,$city,$pincode,$country,$state,$username);
        mysqli_stmt_execute($stmt1); 
        mysqli_stmt_close($stmt1);
        header("location:book.php");
        
    }
    else
    {
        echo mysqli_stmt_error($stmt1);
            // exit();
    }
}
?>