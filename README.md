# stripe-php-app

# Stripe PHP App

A simple PHP application that connects to Stripe to display products and simulate a checkout flow using Stripe Checkout.

## What this project does

This project was built as a straightforward Stripe integration exercise using plain PHP and Composer.

It can:

- load Stripe API keys from a `.env` file
- fetch products from Stripe
- display products in a styled catalog page
- redirect users to Stripe Checkout
- show success and cancel result pages after checkout

## Tech stack

- PHP
- Composer
- Stripe PHP SDK
- vlucas/phpdotenv

## Project setup

Clone the repository first:

```bash
git clone <your-repository-url>
cd stripe-php-app

Install the dependencies:

```bash
composer install

Create your environment file:

```bash
cp .env.example .env

Add Stripe keys in .env:
```bash
STRIPE_SECRET_KEY=your_secret_key_here
STRIPE_PUBLISHABLE_KEY=your_publishable_key_here