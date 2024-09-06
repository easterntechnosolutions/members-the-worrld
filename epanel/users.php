<?php
    /**
     * Created by PhpStorm.
     * User: Rachna
     * Date: 13-Jul-18
     * Time: 2:27 PM
     */
    

    
    include('xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    include("header.php");
    $datetime=date("d/m/Y H:i:s");
    $xcrud->table('users');
    $xcrud->table_name('Users');


    $xcrud->fields('id,firstname,lastname,username,address,city,state,pincode,country'); 
   
    $xcrud->unset_remove(false);
    $xcrud->unset_edit(false);
    $xcrud->unset_add(false);
    echo $xcrud->render();
  
    
    include("footer.php");

?>


