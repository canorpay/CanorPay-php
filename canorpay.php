<?php


    // URL of the API endpoint
    $url = "https://api.canorpay.com";


    // API Credentials for API request
    $account_id = 'CP00048458';



    // Order data for API request
    $orderData = [
        'buyer_email' => "example@info.com", // Example email format
        'buyer_name' => 'John',
        'buyer_phone' => '0719613348',
        'amount' => 1000,
        'account_id' => $account_id
    ];

    // Encode the data as JSON
    $jsonData = json_encode($orderData);

    // Create a context for the HTTP request
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\n",
            'content' => $jsonData,
        ],
    ];

$context = stream_context_create($options);

// Perform the POST request
$response = file_get_contents($url, false, $context);

// Check if the request was successful
if ($response === FALSE) {
    logError("Error: Unable to connect to the API endpoint.");
}

// Output the response
echo $response;

// Function to log errors
function logError($message)
{
    // Function to log errors
    file_put_contents('error_log.txt', $message . "\n", FILE_APPEND);
}








