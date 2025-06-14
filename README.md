# CanorPay Order Creation and Status Check Scripts

This repository contains PHP scripts for interacting with the **CanorPay API**. The scripts demonstrate how to create an order and check its payment status.

## Table of Contents

- [Order Creation Script](#order-creation-script)
  - [Overview](#overview)
  - [Script Components](#script-components)
  - [API Endpoint](#api-endpoint)
  - [Order Data](#order-data)
  - [Request Configuration](#request-configuration)
  - [Error Logging](#error-logging)
  - [Example Usage](#example-usage)
- [Order Status Check Script](#order-status-check-script)
  - [Overview](#overview-1)
  - [Script Components](#script-components-1)
  - [API Endpoint](#api-endpoint-1)
  - [Post Data](#post-data)
  - [cURL Configuration](#curl-configuration)
  - [Error Handling](#error-handling)
  - [Example Usage](#example-usage-1)
- [Notes](#notes)

---

## Order Creation Script

### Overview

This script sends a JSON POST request to the **CanorPay API** to create a new payment order. It also includes a simple error logging function.

### Script Components

#### API Endpoint

```
https://api.canorpay.com
```

### Order Data

The following fields are sent in the POST request:

```php
$orderData = [
    'buyer_email' => 'example@info.com',
    'buyer_name' => 'John',
    'buyer_phone' => '0719613348',
    'amount' => 1000,
    'account_id' => 'CP00048458'
];
```

| Parameter      | Type     | Description                       |
|----------------|----------|-----------------------------------|
| buyer_email    | string   | Customer's email address          |
| buyer_name     | string   | Full name of the buyer            |
| buyer_phone    | string   | Customer's phone number           |
| amount         | integer  | Amount to be paid (in TZS)        |
| account_id     | string   | Your CanorPay account ID          |

### Request Configuration

The script uses PHP's `file_get_contents` with a stream context:

```php
$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/json\r\n",
        'content' => json_encode($orderData),
    ],
];
```

### Error Logging

```php
function logError($message)
{
    file_put_contents('error_log.txt', $message . "\n", FILE_APPEND);
}
```

### Example Usage

1. Replace the placeholder values with real data.
2. Save as `canorpay.php`.
3. Run using a browser or command line (`php canorpay.php`).

---

## Order Status Check Script

### Overview

This script checks the status of an existing order via the CanorPay API using `cURL`.

### Script Components

#### API Endpoint

```
https://api.canorpay.com/check-status.php
```

### Post Data

```php
$postData = [
    'order_id' => '684dafbe98e98'
];
```

| Parameter  | Type    | Description                    |
|------------|---------|--------------------------------|
| order_id   | string  | The ID of the order to check   |

### cURL Configuration

The script uses `cURL` to make a JSON POST request:

```php
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
```

### Error Handling

```php
if (curl_errno($ch)) {
    echo json_encode([
        "status" => "error",
        "message" => 'cURL error: ' . curl_error($ch)
    ]);
}
```

Success Response:

```json
{
  "status": "success",
  "order_id": "684dafbe98e98",
  "message": "Payment received",
  "payment_status": "COMPLETED"
}
```

Error Response:

```json
{
  "status": "error",
  "message": "Order not found"
}
```

### Example Usage

1. Replace the order ID with the one you want to verify.
2. Save as `check-status.php`.
3. Run via terminal or browser.

---

## Notes

- Ensure `error_log.txt` is writable if you're using logging.
- Secure sensitive data such as `account_id`.
- Consider using `.env` files or a config system for API credentials in production.
