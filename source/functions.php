<?php
function isEmailExists($db, $tableName, $email)
{       
    
       // SQL Statement
       $sql = "SELECT * FROM ".$tableName." WHERE email='".$email."'";
       // Process the query
       $results = $db->query($sql);

       // Fetch Associative array
       $row = $results->fetch_assoc();

       // Check if there is a result and response to  1 if email is existing
       return (is_array($row) && count($row)>0);
}

function isUserNameExists($db, $tableName, $username)
{
    // SQL Statement
    $sql = "SELECT * FROM ".$tableName." WHERE username='".$username."'";
    // Process the query
    $results = $db->query($sql);

    // Fetch Associative array
    $row = $results->fetch_assoc();

    // Check if there is a result and response to  1 if email is existing
    return (is_array($row) && count($row)>0);
}

function isStudyNameExists($db, $tableName, $studyname)
{
    // SQL Statement
    $sql = "SELECT * FROM ".$tableName." WHERE studyname='".$studyname."'";
    // Process the query
    $results = $db->query($sql);

    // Fetch Associative array
    $row = $results->fetch_assoc();

    // Check if there is a result and response to  1 if email is existing
    return (is_array($row) && count($row)>0);
}
function isProjectNameExists($db, $tableName, $projectname)
{
    // SQL Statement
    $sql = "SELECT * FROM ".$tableName." WHERE projectname='".$projectname."'";
    // Process the query
    $results = $db->query($sql);

    // Fetch Associative array
    $row = $results->fetch_assoc();

    // Check if there is a result and response to  1 if email is existing
    return (is_array($row) && count($row)>0);
}
function isReportIDExists($db, $tableName, $id)
{
    // SQL Statement
    $sql = "SELECT * FROM ".$tableName." WHERE report_id='".$id."'";
    // Process the query
    $results = $db->query($sql);

    // Fetch Associative array
    $row = $results->fetch_assoc();

    // Check if there is a result and response to  1 if email is existing
    return (is_array($row) && count($row)>0);
}


function LoginCheck($db, $tableName, $username,$password)
{
    // SQL Statement
    $sql = "SELECT * FROM ".$tableName." WHERE username='".$username."'";
    // Process the query
    $results = $db->query($sql);

    // Fetch Associative array
    $row = $results->fetch_assoc();
    // Check if there is a result and response to  1 if email is existing
    return (is_array($row) && count($row)>0 && password_verify($password, $row['password']));
}
function select_col($db, $tableName, $column){
    // SQL Statement used join to select certain column
    $sql = "SELECT ".join(',', $column)." FROM ".$tableName." ";
    // Process the query
    $results = $db->query($sql);
    //create an array
    $emparray = array();
    while($row = $results->fetch_assoc())
    {
        $emparray[] = $row;
    }
    return json_encode($emparray);

}
function Get_type($db, $tableName,$username){
    $sql = "SELECT type_id FROM ".$tableName." WHERE username='".$username."'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();
    return $row["type_id"];
}
function Get_typeID($type){
    $type_id ="";
    if($type == "admin"){
        $type_id = "0";
    }
    else if($type == "coord"){
        $type_id = "1";
    }
    else if($type == "review"){
        $type_id = "2";
    }
    else if($type == "oecode"){
        $type_id = "3";
    }
    else if($type == "data"){
        $type_id = "4";
    }
    else{
        $type_id = "5";
    }
    return $type_id;
}

function Get_studyid($db,$tableName,$studyname){
    $sql = "SELECT study_id FROM ".$tableName." WHERE studyname='".$studyname."'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();
    return $row["study_id"];
}
function Get_projectid($db,$tableName,$projectname){
    $sql = "SELECT project_id FROM ".$tableName." WHERE projectname='".$projectname."'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();
    return $row["project_id"];
}
function isReportNameExists($db,$tableName,$reportname){

    $sql = "SELECT * FROM ".$tableName." WHERE reportname='".$reportname."'";

    $results = $db->query($sql);

    $row = $results->fetch_assoc();

    return (is_array($row) && count($row)>0);
}

function isEmpty($input){
    return strlen(trim($input)) == 0;
}

function rc_api_content($token,$report_id){
    $data = array(
        'token' => $token,
        'content' => 'report',
        'format' => 'json',
        'report_id' => $report_id,
        'csvDelimiter' => '',
        'rawOrLabel' => 'label',
        'rawOrLabelHeaders' => 'label',
        'exportCheckboxLabel' => 'true',
        'returnFormat' => 'json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://rc-1.nyspi.org/api/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $output = curl_exec($ch);
    
    curl_close($ch);
    
    return json_decode($output,true);;
}
function cleanup_numbers($string) {
    $numbers = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ");
    $new_string = str_replace($numbers, '', $string);
    return $new_string;
}
function remove_space($string){
    return str_replace(' ', '', $string);
}
function RPT_SW($rpt_content,$selected_id){
    // Iterate through all contents
    $result = [];  // $contentName , $array (column name)
    foreach ($rpt_content as $contentName => $content){
        $array = []; // column name , val
        $repeat=[];  // check if the key is existed inside array
        // Iterate through all rows
        foreach($content as $row){
            if($row['record_id'] == $selected_id){
                $count_email = 0;
                // Check if row has $repeat_instance
                $repeat_instance = false;
                // concatenate repeat instance data
                $concatenate_repeat_instance = "";
                // Iterate through all columns
                foreach($row as $key => $val){
                    // Check if repeat_instance exist in this row
                    if($key == 'redcap_repeat_instance' && !isEmpty($val)) $repeat_instance = true;
                    $contain_rec = str_contains($key, 'rec_new');
                    
                    if(!isEmpty($val) && $key != 'record_id' && $key != 'redcap_event_name' && $key != 'redcap_repeat_instance'){
                        $s = cleanup_numbers($key);
                        if($repeat_instance && $contain_rec){
                            $concatenate_repeat_instance.=(", ".$val);
                            $count_email++;
                        }
                        else{
                            if(!key_exists($s, $repeat)){
                                $array[$s] = array();
                                array_push($array[$s],$val);
                                $repeat[$s] = 1;
                            }
                            else{
                                if($s == 'invite_address_line'){
                                    end($array[$s]);
                                    // Update the value of the last element
                                    $index = key($array[$s]); // Get the key/index of the last element
                                    $array[$s][$index] .= (", ".$val); 
                                }
                                else array_push($array[$s],$val);
                            }
                        }
                    }
                }
                // if repeat_instance exist add to the array
                if($repeat_instance && !isEmpty($concatenate_repeat_instance)){
                    if(!key_exists('Recruitment', $repeat)){
                        $array['Recruitment'] = array();
                        $repeat['Recruitment'] = 1;
                    }
                    // store email individually
                    if($contentName == 'RPT_Emails'){
                        $concatenate_repeat_instance = ltrim($concatenate_repeat_instance, ', ');
                        $email_array = explode(", ", $concatenate_repeat_instance);
                        foreach($email_array as $email){
                            array_push($array['Recruitment'],$email);
                        }
                    }
                    else array_push($array['Recruitment'],ltrim($concatenate_repeat_instance, ', '));
                }
            }
        }
        if(key_exists('Recruitment', $repeat)){
            // Update the value of the last element (latest recruitment)
            // Might have mutiple current emails
            if($contentName == 'RPT_Emails'){
                $sz = count($array['Recruitment']);
                for ($i = $sz-1; $i >= $sz-$count_email; $i--) {
                    $array['Recruitment'][$i].=" (current)";
                }
                
            }
            else{
                // Get the key/index of the last element
                end($array['Recruitment']);
                $index = key($array['Recruitment']); 
                $array['Recruitment'][$index].=" (current)";  
            }         
        }
        // add the content into result
        $result[$contentName] = $array;
    }
    return $result;
}
?>