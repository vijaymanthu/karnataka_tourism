<?php
// Account details
function sendsms($mobile, $user_name)
{
    $apiKey = urlencode('lIZAOM6FF/0-POUsK6Pj7ARK38Fo8Erub5BKxDVNFg');
    // Message details
    $numbers = array(+918073114167, +919164374893);
    $sender = urlencode('TXTLCL');
    $message = rawurlencode('A Test Message');

    $numbers = implode(',', $numbers);

    // Prepare data for POST request
    $data = array('From' => 'KATRSM', 'To' => "+91$mobile", 'TemplateName' => 'tourism', 'VAR1' => "$user_name", 'VAR2' => 'Laxmi', 'VAR3' => '+91 9113009196');
    // Send the POST request with cURL
    $ch = curl_init('http://2factor.in/API/V1/acedafe9-2fc2-11eb-83d4-0200cd936042/ADDON_SERVICES/SEND/TSMS');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    // Process your response here
    if($response['Status']== 'Success')
        return true;
    else
        return false;
}
