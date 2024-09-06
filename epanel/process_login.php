<?php
include("db_connect.php");
//include("xcrud/xcrud_config.php");
error_reporting(0);
$obj=new DB_Connect();
	
 $LoginQuery="Select * from admin where a_username='".str_replace('\'', '*', $_REQUEST["username"])."' and BINARY a_password='".str_replace('\'', '*', $_REQUEST["password"])."' ";
	//echo $LoginQuery;

	$Result  = $obj->select($LoginQuery);
	
	//echo "hello";
	$Row=mysqli_fetch_array($Result);
	
	$RowCount=mysqli_num_rows($Result);
	

	if($RowCount>0)
	{

		if($Row["a_status"]=="Enable")
		{
		    
		       if($Row["a_type"]=="admin" || $Row["a_type"]=="super_admin" )
		{

			$Userid = $Row["a_id"];


			session_start();
			$_SESSION["login"] = "true";
			$_SESSION["email_id"] = $Row["a_username"];
			$_SESSION["username"] = $Row["a_username"];
			$_SESSION["uid"] = $Row[0];


				header("location:users.php");
			}else{
				header("location:index.php?msg1=UserName/Password is WRONG...");
			}
		
		}
		else {
               	header("location:index.php?msg1=You are disabled");
		}
	}
	else
	{	
		
		
		header("location:index.php?msg=UserName/Password is WRONG...");
	}
?>