<?php
function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {

    ini_set('display_errors', 1);
    $url = "https://upload.diawi.com/"; 
    $filename = realpath('../uploads/'.$xcrud->get('ipa'));
    if ($filename != '')
    {
        $headers = array("Content-Type: multipart/form-data"); // cURL headers for file uploading
        $postfields = array(
            "token"             => 'Cib8SzGY5NR7tDCaYRgpMylvR2Q2cT2izo31UdcvHy',
            "file"              => new CurlFile( $filename ),
            "find_by_udid"      => 0,
            "wall_of_apps"      => 0,
            "callback_email"    => 'soham.pandya@easternts.com'
            );
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0'
        ); // cURL options
        curl_setopt_array($ch, $options);
       $res= curl_exec($ch);
    
      $array_res = json_decode($res,true);
           
               
        if(!curl_errno($ch))
        {
            // echo $ch;
            $info = curl_getinfo($ch);
            if ($info['http_code'] == 200)
            {
               $errmsg = "File uploaded successfully";
               $array_res = json_decode($res,true);
               curl_close($ch);
               sleep(6);
               callApi( $array_res["job"],(int)$xcrud->get('primary'));
            }
            // print_r($info);
        }
        else
        {
            $errmsg = curl_error($ch);
              echo $errmsg;
              curl_close($ch);
        }
        
        
    }
    else
    {
        $errmsg = "Please select the file";
    }
  
  

        
       
    }
}
function callApi($job,$id)
{
                    $ch1 = curl_init();

                    // set url
                    curl_setopt($ch1, CURLOPT_URL, "https://upload.diawi.com/status?token=Cib8SzGY5NR7tDCaYRgpMylvR2Q2cT2izo31UdcvHy&job=".$job);
            
                    //return the transfer as a string
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
            
                    // $output contains the output string
                    $output = curl_exec($ch1);
                    //echo $output;
                   
                    $info1 = curl_getinfo($ch1);
            
                    // close curl resource to free up system resources
                    curl_close($ch1);  
                    
                   
                   if($info1['http_code'] == 200)
                    {
                        $array_res1 = json_decode($output,true);
                        
                        if($array_res1["status"]=="2001")
                        {
                       
                        }
                        else if($array_res1["status"]=="2000")
                        {
                              $db = Xcrud_db::get_instance();
                         $query = "UPDATE brand SET `diawilink` = '".$array_res1['link']."' WHERE id = " .$id;
                   
                         $db->query($query);
                        }
                         
                       
                    }
}
function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function movetop($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}
function movebottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}

function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1')
    {
        $result = '<i class="fa fa-check" />' . 'OK';
    }
    elseif ($value == '2')
    {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .
        '" />';
}
function unset_val($postdata)
{
    $postdata->del('Paid');
}

function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if (strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif (strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function before_list_example($list, $xcrud)
{
    var_dump($list);
}

function after_update_test($pd, $pm, $xc)
{
	
    $xc->search = 0;
}
function get_lat_long_insert($pd, $pm, $xc)
{
	$primary = $xc->get('primary');
	 $points=explode(',',$pd->get('lat_long'));
	$db =Xcrud_db::get_instance();
echo "update p_vendor set latitude='".$points[0]."',longitude='".$points[1]."' where vendor_id=".$db->insert_id();
    $db->query("update p_vendor set latitude='".$points[0]."',longitude='".$points[1]."' where vendor_id=".$db->insert_id());
	
}
function get_lat_long_update($pd, $pm, $xc)
{
	$primary = $xc->get('primary');
	 $points=explode(',',$pd->get('lat_long'));
	$db =Xcrud_db::get_instance();
echo "update p_vendor set latitude='".$points[0]."',longitude='".$points[1]."' where vendor_id=".$db->escape($primary);
    $db->query("update p_vendor set latitude='".$points[0]."',longitude='".$points[1]."' where vendor_id=".$db->escape($primary));
	
}

function before_list_callback($grid_data, $xcrud)
{
       
       
        if(sizeof($grid_data)>0) {
            $xcrud->unset_add();
        }
}

