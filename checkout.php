<?php

declare(strict_types=1);

$productId = $_GET['product_id'] ?? '';
$productName = $_GET['product_name'] ?? 'Unknown product';
$price = $_GET['price'] ?? 'No price set';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Checkout Simulation</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
	<style>
		body {
			margin: 0;
			font-family: 'Plus Jakarta Sans', sans-serif;
			background: linear-gradient(180deg, #f6f9ff 0%, #eef2ff 100%);
			color: #1f2b3d;
			min-height: 100vh;
			display: grid;
			place-items: center;
		}

		.box {
			width: min(92vw, 460px);
			background: #fff;
			border: 1px solid #e6ebf4;
			border-radius: 18px;
			padding: 24px;
			box-shadow: 0 18px 36px rgba(30, 44, 71, 0.12);
		}

		h1 {
			margin: 0 0 10px;
			font-size: 24px;
		}

		p {
			margin: 8px 0;
		}

		.label {
			color: #6b7690;
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 0.08em;
		}

		.value {
			font-weight: 700;
			font-size: 16px;
		}

		.actions {
			display: flex;
			gap: 10px;
			margin-top: 18px;
		}

		.btn {
			padding: 10px 14px;
			border-radius: 10px;
			font-weight: 700;
			border: none;
			cursor: pointer;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			justify-content: center;
		}

		.btn.primary {
			background: linear-gradient(160deg, #6b7bff, #3f53f6);
			color: #fff;
		}

		.btn.secondary {
			background: #f1f4fb;
			color: #3c4a63;
		}
	</style>
</head>
<body>
	<section class="box">
		<h1>Checkout Simulation</h1>
		<p>This is a sample checkout preview for your Stripe catalog flow.</p>

		<p class="label">Product</p>
		<p class="value"><?php echo htmlspecialchars((string) $productName, ENT_QUOTES, 'UTF-8'); ?></p>

		<p class="label">Price</p>
		<p class="value"><?php echo htmlspecialchars((string) $price, ENT_QUOTES, 'UTF-8'); ?></p>

		<p class="label">Product ID</p>
		<p class="value"><?php echo htmlspecialchars((string) $productId, ENT_QUOTES, 'UTF-8'); ?></p>

		<div class="actions">
			<a class="btn secondary" href="products.php">Back to products</a>
			<button class="btn primary" type="button">Pay now (demo)</button>
		</div>
	</section>
</body>
</html>
