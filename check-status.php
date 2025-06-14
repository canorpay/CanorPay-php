<?php
// The endpoint URL where the request will be sent
$endpointUrl = "https://api.canorpay.com/check-status.php";

// Order ID that you want to check the status for
$order_id = "684dafbe98e98";

// Data to be sent in the POST request
$postData = [
    'order_id' => $order_id
];

    // Initialize cURL
    $ch = curl_init($endpointUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Send as POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Add JSON data as POST fields
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Execute the request and get the response
    $response = curl_exec($ch);


// Check for cURL errors

if (curl_errno($ch)) {
    echo json_encode([
        "status" => "error",
        "message" => 'cURL error: ' . curl_error($ch)
    ]);
} else {
    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Format the response to match the desired structure
    if ($responseData['status'] === 'success') {
        echo json_encode([
            "status" => "success",
            "order_id" => $responseData['order_id'],
            "message" => $responseData['message'],
            "payment_status" => $responseData['payment_status']
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => $responseData['message']
        ]);
    }
}

// Close cURL session
curl_close($ch);