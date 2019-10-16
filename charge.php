<?php
require_once('vendor/autoload.php');

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
  "amount" => 1000000,
  "currency" => "usd",
  "description" => "Some stuff",
  "customer" => $customer->id
));

// Redirect to success page
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);