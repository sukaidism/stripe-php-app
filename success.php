<?php

declare(strict_types=1);

$sessionId = (string) ($_GET['session_id'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        :root {
            --success: #1f7a39;
            --success-soft: #e9f8ee;
            --text: #203147;
            --muted: #66758e;
            --line: #d9e7dd;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: radial-gradient(circle at 10% 5%, #f2fff5 0%, transparent 35%), #f4f9f6;
            min-height: 100vh;
            display: grid;
            place-items: center;
            color: var(--text);
            padding: 20px;
        }

        .box {
            width: min(92vw, 560px);
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 18px 40px rgba(32, 51, 71, 0.1);
        }

        .badge {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 28px;
            background: var(--success-soft);
            color: var(--success);
            margin-bottom: 14px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 30px;
            color: var(--success);
        }

        .lead {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
        }

        .session {
            margin-top: 18px;
            border: 1px dashed var(--line);
            border-radius: 12px;
            padding: 12px;
            background: #fbfefc;
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
            word-break: break-all;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            border-radius: 10px;
            padding: 10px 14px;
        }

        .btn.primary {
            background: var(--success);
            color: #fff;
        }

        .btn.ghost {
            border: 1px solid var(--line);
            color: var(--text);
            background: #fff;
        }
    </style>
</head>
<body>
<div class="box">
    <div class="badge">✓</div>
    <h1>Payment Successful</h1>
    <p class="lead">Thank you for your purchase. Your Stripe payment was completed successfully.</p>
    <?php if ($sessionId !== ''): ?>
        <div class="session">
            <p class="label">Stripe Session ID</p>
            <p class="value"><?php echo htmlspecialchars($sessionId, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
    <div class="actions">
        <a class="btn primary" href="products.php">Continue Shopping</a>
        <a class="btn ghost" href="products.php">Back to Products</a>
    </div>
</div>
</body>
</html>
