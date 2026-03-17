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
    <style>
        :root {
            --warning: #a55325;
            --warning-soft: #fff2e8;
            --text: #203147;
            --muted: #6e7c93;
            --line: #f0dfd5;
            --accent: #ff6a2b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: radial-gradient(circle at 12% 8%, #fff8f1 0%, transparent 35%), #fff7f2;
            display: grid;
            place-items: center;
            min-height: 100vh;
            color: var(--text);
            padding: 20px;
        }

        .box {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 28px;
            width: min(92vw, 560px);
            box-shadow: 0 18px 40px rgba(74, 49, 34, 0.12);
        }

        .badge {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 28px;
            background: var(--warning-soft);
            color: var(--warning);
            margin-bottom: 14px;
        }

        h1 {
            margin: 0 0 8px;
            color: var(--warning);
            font-size: 30px;
        }

        .lead {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
        }

        .product {
            margin-top: 18px;
            padding: 12px;
            border: 1px dashed var(--line);
            border-radius: 12px;
            background: #fffcfa;
        }

        .label {
            margin: 0 0 4px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
        }

        .value {
            margin: 0;
            font-weight: 700;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn.primary {
            color: #fff;
            background: linear-gradient(160deg, #ff8d4e, #ff5a18);
        }

        .btn.ghost {
            color: var(--text);
            border: 1px solid var(--line);
            background: #fff;
        }
    </style>
</head>
<body>
<div class="box">
    <div class="badge">!</div>
    <h1>Payment Cancelled</h1>
    <p class="lead">You may try again anytime. No payment was charged.</p>

    <?php if ($productName !== ''): ?>
        <div class="product">
            <p class="label">Selected Product</p>
            <p class="value"><?php echo htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>

    <div class="actions">
        <?php if ($priceId !== ''): ?>
            <form action="checkout.php" method="post">
                <input type="hidden" name="price_id" value="<?php echo htmlspecialchars($priceId, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'); ?>">
                <button class="btn primary" type="submit">Retry Stripe Checkout</button>
            </form>
        <?php endif; ?>
        <a class="btn ghost" href="products.php">Back to Products</a>
    </div>
</div>
</body>
</html>
