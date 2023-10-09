<?php
include 'session_check.php';
include 'config.php';

$data = array(
    'token' => $_SESSION['token'],
    'content' => 'report',
    'format' => 'json',
    'report_id' => $_SESSION['id'],
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
// printf $output;

curl_close($ch);

echo $output;



?>