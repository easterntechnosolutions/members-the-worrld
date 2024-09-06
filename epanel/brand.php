<?php
	 
	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	include("header.php");
	$datetime=date("d/m/Y H:i:s");
	
	$xcrud->table('brand');
		$xcrud->table_name('Applications');

	$xcrud->validation_required('app_name');//Added by Rachna
	//$xcrud->where('added_by=',$_SESSION["id"]);
	//$xcrud->change_type('added_by','hidden',$_SESSION["id"]);
	$xcrud->change_type('datetime','hidden',$datetime);
	$xcrud->change_type('added_by','hidden',$_SESSION["id"]);
    $xcrud->create_action('publish', 'publish_action'); // action callback, function publish_action() in functions.php

    $xcrud->button('#', 'publish', 'fa fa-apple', 'xcrud-action', 
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'publish',
            'data-primary' => '{id}',
            'data-ipa' => '{ipa}'
            ),array('ipa','!=','')
    );
  $xcrud->button('http://apps.easternts.com/uploads/{apk}','userlink','fa fa-android','','',array('apk','!=','')); 
  $xcrud->button('http://apps.easternts.com/enterprise/index.php?id={id}','iOS Installation Link','fa fa-building','','',array('ipa','!=','')); 

	$xcrud->change_type('apk','file','',array('prefix'=>'www'));
	$xcrud->change_type('ipa','file','',array('prefix'=>'www'));
	$xcrud->label('diawilink','Diawi Link');
	$xcrud->benchmark(true);

	$xcrud->readonly('diawilink');
	echo $xcrud->render();
	include("footer.php");
 
	 ?>
	