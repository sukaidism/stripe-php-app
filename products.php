<?php

declare(strict_types=1);

use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

$config = require __DIR__ . '/config.php';
$products = [];
$errorMessage = '';

try {
	$stripe = new StripeClient($config['secret_key']);
	$response = $stripe->products->all([
		'active' => true,
		'limit' => 24,
		'expand' => ['data.default_price'],
	]);

	$products = $response->data;
} catch (ApiErrorException $exception) {
	$errorMessage = 'Unable to load products from Stripe API right now.';
} catch (Throwable $exception) {
	$errorMessage = 'Unexpected error while loading products.';
}

function formatAmount(mixed $price): string
{
	if (!is_object($price) || !isset($price->unit_amount)) {
		return 'No price set';
	}

	$amount = (int) $price->unit_amount;
	$currency = strtoupper((string) ($price->currency ?? 'USD'));

	return sprintf('%s %s', $currency, number_format($amount / 100, 2));
}

function productImageUrl(mixed $product): string
{
	if (is_object($product) && isset($product->images) && is_array($product->images) && !empty($product->images[0])) {
		return (string) $product->images[0];
	}

	return 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=700&q=80';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stripe Products</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="layout">
	<aside class="sidebar">
		<div class="brand">
			<span class="brand-dot" aria-hidden="true">
				<svg viewBox="0 0 24 24" role="img" focusable="false">
					<path d="M5 4.8C5 3.81 5.81 3 6.8 3H19v15H7.2C6.43 18 5.75 18.3 5.25 18.78C5.09 18.94 5 19.13 5 19.35V4.8ZM7.2 20H20a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6.8A2.8 2.8 0 0 0 4 3.8V19.35C4 20.81 5.19 22 6.65 22H20v-2H7.2c-.66 0-1.2-.54-1.2-1.2s.54-1.2 1.2-1.2H20v-2H7.2c-.44 0-.86.09-1.25.26V4.8c0-.44.36-.8.8-.8H18v12H7.2a3.16 3.16 0 0 0-1.2.24V4.8Z" />
				</svg>
			</span>
			<span>Bookla</span>
		</div>

		<div class="menu-title">Main</div>
		<a class="menu-item active" href="#"><span class="menu-pill"></span>Products</a>

		<div class="menu-title">Preferences</div>
		<a class="menu-item" href="#"><span class="menu-pill"></span>Settings</a>
		<a class="menu-item" href="#"><span class="menu-pill"></span>Log Out</a>
	</aside>

	<main class="main">
		<section class="panel">
			<header class="panel-header">
				<div class="title-block">
					<h1>Products</h1>
					<p>Experience checkout with Stripe Integration.</p>
				</div>
				<div class="header-actions">
					<button class="action" type="button">Filter</button>
					<button class="action" type="button">Search Product</button>
					<button class="action primary" type="button">Add Product</button>
				</div>
			</header>

			<?php if ($errorMessage !== ''): ?>
				<div class="error"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<?php if (empty($products)): ?>
				<div class="empty">No products found in Stripe yet.</div>
			<?php else: ?>
				<div class="grid">
					<?php foreach ($products as $index => $product): ?>
						<?php
						$checkoutProductId = (string) ($product->id ?? '');
						$checkoutProductName = (string) ($product->name ?? 'Unnamed product');
						$checkoutPrice = formatAmount($product->default_price ?? null);
						$checkoutPriceId = is_object($product->default_price) && isset($product->default_price->id)
							? (string) $product->default_price->id
							: '';
						?>
						<article class="card" style="animation-delay: <?php echo ($index * 0.04); ?>s;">
							<img
								class="thumb"
								src="<?php echo htmlspecialchars(productImageUrl($product), ENT_QUOTES, 'UTF-8'); ?>"
								alt="<?php echo htmlspecialchars((string) ($product->name ?? 'Product image'), ENT_QUOTES, 'UTF-8'); ?>"
							>
							<div class="card-body">
								<p class="name"><?php echo htmlspecialchars($checkoutProductName, ENT_QUOTES, 'UTF-8'); ?></p>
								<div class="meta">
									<span class="price"><?php echo htmlspecialchars($checkoutPrice, ENT_QUOTES, 'UTF-8'); ?></span>
								</div>
								<form class="checkout-form" action="checkout.php" method="post">
									<input type="hidden" name="price_id" value="<?php echo htmlspecialchars($checkoutPriceId, ENT_QUOTES, 'UTF-8'); ?>">
									<input type="hidden" name="product_id" value="<?php echo htmlspecialchars($checkoutProductId, ENT_QUOTES, 'UTF-8'); ?>">
									<input type="hidden" name="product_name" value="<?php echo htmlspecialchars($checkoutProductName, ENT_QUOTES, 'UTF-8'); ?>">
									<input type="hidden" name="price" value="<?php echo htmlspecialchars($checkoutPrice, ENT_QUOTES, 'UTF-8'); ?>">
									<button class="checkout-btn" type="submit" <?php echo $checkoutPriceId === '' ? 'disabled' : ''; ?>>
										<?php echo $checkoutPriceId === '' ? 'No Stripe Price' : 'Checkout'; ?>
									</button>
								</form>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<footer class="panel-footer">
				<button class="page" type="button">1</button>
				<button class="page current" type="button">2</button>
				<button class="page" type="button">3</button>
				<button class="page" type="button">4</button>
			</footer>
		</section>
	</main>
</div>
</body>
</html>