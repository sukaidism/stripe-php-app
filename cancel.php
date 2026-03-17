<?php

declare(strict_types=1);

$priceId = trim((string) ($_GET['price_id'] ?? ''));
$productName = trim((string) ($_GET['product_name'] ?? 'Selected Product'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Canceled</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="result-page cancel-page">
<div class="result-box">
    <div class="result-badge">!</div>
    <h1 class="result-title">Payment Cancelled</h1>
    <p class="result-lead">You may try again anytime. No payment was charged.</p>

    <?php if ($productName !== ''): ?>
        <div class="result-product">
            <p class="result-label">Selected Product</p>
            <p class="result-value"><?php echo htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>

    <div class="result-actions">
        <?php if ($priceId !== ''): ?>
            <form action="checkout.php" method="post">
                <input type="hidden" name="price_id" value="<?php echo htmlspecialchars($priceId, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'); ?>">
                <button class="result-btn primary" type="submit">Retry Stripe Checkout</button>
            </form>
        <?php endif; ?>
        <a class="result-btn ghost" href="products.php">Back to Products</a>
    </div>
</div>
</body>
</html>
