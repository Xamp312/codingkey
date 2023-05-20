<?php 

$url = "http://api.weatherstack.com/current?access_key=79356d16e508c4509e7f989658340622&query=Islamabad";    

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true
]);
$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);
if ($httpCode === 200) {
    echo '<b>JSON:</b> <br />'.$response.'<br />';
    $decodedarray = json_decode($response);
    
    echo '<br /><b>Pretty Array:</b> <br />';
    print("<pre>".print_r($decodedarray,true)."</pre>");
} else {
    echo "Error: " . $response;
}



?>