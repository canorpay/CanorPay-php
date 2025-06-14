#   CanorPay Order Creation and Status Check Scripts

This repository contains PHP scripts to interact with the CanorPay API for order creation and order status checking. It also includes a webhook handler for receiving payment notifications.

---

## 📑 Table of Contents

- [Order Creation Script](#order-creation-script)
  - [Overview](#overview)
  - [Script Components](#script-components)
  - [API Endpoint](#api-endpoint)
  - [Order Data](#order-data)
  - [cURL Configuration](#curl-configuration)
  - [Error Logging](#error-logging)
  - [Error Handling](#error-handling)
  - [Example Usage](#example-usage)
  - [Notes](#notes)
- [Order Status Check Script](#order-status-check-script)
  - [Overview](#overview-1)
  - [Script Components](#script-components-1)
  - [API Endpoint](#api-endpoint-1)
  - [Post Data](#post-data)
  - [cURL Configuration](#curl-configuration-1)
  - [Error Handling](#error-handling-1)
  - [Example Usage](#example-usage-1)
  - [Notes](#notes-1)
- [Webhook Handling](#webhook-handling)
  - [Webhook Example](#webhook-example)
  - [How It Works](#how-it-works)

---

## 🧾 Order Creation Script

### Overview
Sends a POST request to the CanorPay API to create an order. Includes basic error logging.

### Script Components

#### API Endpoint


#### Order Data
```php
$url = "https://api.canorpay.com";
$orderData = [
    'buyer_email' => "CUSTOMER_EMAIL",
    'buyer_name' => 'CUSTOMER_NAME',
    'buyer_phone' => 'CUSTOMER_PHONE_NUMBER',
    'amount' => 1000,
    'account_id' => 'YOUR_ACCOUNT_ID'
];



| Parameter    | Type    | Description                          |
| ------------ | ------- | ------------------------------------ |
| buyer_name  | string  | Customer's full name                 |
| buyer_phone | string  | Customer's phone number              |
| buyer_email | string  | Customer's email address             |
| amount       | integer | Amount to be paid (in minor units)   |
| account_id  | string  | Your CanorPay account ID              |


