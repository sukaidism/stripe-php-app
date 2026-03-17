<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="result-page success-page">
<div class="result-box">
    <div class="result-badge">✓</div>
    <h1 class="result-title">Payment Successful</h1>
    <p class="result-lead">Thank you for your purchase. Your Stripe payment was completed successfully.</p>
    <div class="result-actions">
        <a class="result-btn primary" href="products.php">Continue Shopping</a>
        <a class="result-btn ghost" href="products.php">Back to Products</a>
    </div>
</div>
</body>
</html>
