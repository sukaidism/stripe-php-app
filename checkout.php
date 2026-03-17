<?php

declare(strict_types=1);

use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Price;
use Stripe\Stripe;

require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: products.php', true, 303);
    exit;
}

$priceId = trim((string) ($_POST['price_id'] ?? ''));
$productName = trim((string) ($_POST['product_name'] ?? 'Product'));

if ($priceId === '') {
    http_response_code(400);
    echo 'Missing Stripe Price ID. This product cannot be checked out yet.';
    exit;
}

Stripe::setApiKey($config['secret_key']);

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseUrl = sprintf('%s://%s/stripe-php-app', $scheme, $host);

try {
    $price = Price::retrieve($priceId);
    $isRecurring = isset($price->recurring) && $price->recurring !== null;
    $isMetered = $isRecurring
        && isset($price->recurring->usage_type)
        && $price->recurring->usage_type === 'metered';

    $lineItem = ['price' => $priceId];

    if (!$isMetered) {
        $lineItem['quantity'] = 1;
    }

    $checkoutSession = Session::create([
        'mode' => $isRecurring ? 'subscription' : 'payment',
        'line_items' => [$lineItem],
        'success_url' => $baseUrl . '/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $baseUrl . '/cancel.php?price_id=' . urlencode($priceId) . '&product_name=' . urlencode($productName),
        'metadata' => [
            'product_name' => $productName,
        ],
    ]);

    header('Location: ' . $checkoutSession->url, true, 303);
    exit;
} catch (ApiErrorException $exception) {
    http_response_code(500);
    echo 'Stripe checkout failed: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8');
}
