<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);

if (is_file(__DIR__ . '/.env')) {
    $dotenv->load();
}

$secretKey = $_ENV['STRIPE_SECRET_KEY'] ?? '';
$publishableKey = $_ENV['STRIPE_PUBLISHABLE_KEY'] ?? '';

if ($secretKey === '' || $publishableKey === '') {
    throw new RuntimeException('Stripe keys are missing. Add STRIPE_SECRET_KEY and STRIPE_PUBLISHABLE_KEY to your .env file.');
}

return [
    'secret_key' => $secretKey,
    'publishable_key' => $publishableKey,
];