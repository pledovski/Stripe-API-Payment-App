<?php
require_once('vendor/autoload.php');
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/Customer.php');
require_once('models/Transaction.php');

\Stripe\Stripe::setApiKey('sk_test_gB5L7TQWy5QWk0jz4rkMJ6F400EhxLNmxm');

// Sanitize POST array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

// Create customer in StripeElement
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));

// Charge the customer
$charge = \Stripe\Charge::create(array(
  "amount" =>   10000,
  "currency" => "usd",
  "description" => "Some stuff",
  "customer" => $customer->id
));

// Transaction data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status
];

// Instatiate Transaction
$transaction = new Transaction();

// Add Transaction to DB
$transaction->addTransaction($transactionData);

// Customer data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  'last_name' => $last_name,
  'email' => $email
];

// Instatiate Customer
$customer = new Customer();

// Add Customer to DB
$customer->addCustomer($customerData);

// Redirect to success page
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);