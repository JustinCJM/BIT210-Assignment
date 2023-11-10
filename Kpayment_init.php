<?php

require_once 'Kconfig.php';
require_once 'stripe-php-master/init.php';

$stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

$response = array(
    'status' => 0,
    'error' => array(
        'message' => 'Invalid Request!'
    )
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents('php://input');
    $request = json_decode($input);
}

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode($response);
    exit;
}

if (!empty($request->createCheckoutSession)) {
    // Define your product details
    $productPrice = 19.99;  // Replace with the actual product price
    $productName = 'Your Product';  // Replace with the actual product name
    $productID = '123456';  // Replace with the actual product ID
    $currency = 'usd';  // Replace with the actual currency code

    // Convert product price to cent
    $stripeAmount = round($productPrice * 100, 2);

    // Create new Checkout Session for the order
    try {
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $productName,
                            'metadata' => [
                                'pro_id' => $productID
                            ]
                        ],
                        'unit_amount' => $stripeAmount,
                        'currency' => $currency,
                    ],
                    'quantity' => 1
                ]
            ],
            'mode' => 'payment',
            'success_url' => STRIPE_SUCCESS_URL . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => STRIPE_CANCEL_URL,
        ]);
    } catch (Exception $e) {
        $api_error = $e->getMessage();
    }

    if (empty($api_error) && $checkout_session) {
        $response = array(
            'status' => 1,
            'message' => 'Checkout Session created successfully!',
            'sessionId' => $checkout_session->id
        );
    } else {
        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Checkout Session creation failed! ' . $api_error
            )
        );
    }
}

var_dump($response);
echo json_encode($response);
?>

