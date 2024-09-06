<?php
ob_start();

session_start();
	 
	include('xcrud/xcrud.php');
	include ("connect.php");
	$xcrud = Xcrud::get_instance();
	include("header.php");
	
	$datetime=date("d/m/Y H:i:s");
	$xcrud->table('admin');
	$xcrud->table_name('admin profile');
	 //$xcrud->where("a_type=","superadmin");
	$xcrud->label('a_username','Username');
	$xcrud->label('a_password','Password');
	
	
	$xcrud->fields('a_username,a_password', false);
	$xcrud->columns('a_username,a_password', false);
	//$xcrud->validation_pattern('gst_no','decimal');
//	$xcrud->validation_pattern('vat','decimal');
	//$xcrud->show_primary_ai_field(true);
	
	
	 $xcrud->unset_add();
	 $xcrud->unset_remove();
	
	echo $xcrud->render();
	include("footer.php");
 
	 ?>