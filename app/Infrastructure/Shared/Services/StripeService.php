<?php

namespace App\Infrastructure\Shared\Services;

use Stripe\Customer;
use Stripe\Event;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    public function createPaymentIntent(
        int $amountCents,
        string $currency,
        string $customerId,
        array $metadata = [],
    ): PaymentIntent {
        return PaymentIntent::create([
            'amount' => $amountCents,
            'currency' => $currency,
            'customer' => $customerId,
            'metadata' => $metadata,
            'automatic_payment_methods' => ['enabled' => true],
        ]);
    }

    public function retrievePaymentIntent(string $paymentIntentId): PaymentIntent
    {
        return PaymentIntent::retrieve($paymentIntentId);
    }

    /**
     * Crea o recupera un Customer de Stripe.
     * Si se proporciona $existingStripeId, recupera el existente.
     * Si no, crea uno nuevo con el email y nombre del cliente.
     */
    public function createOrRetrieveCustomer(
        string $email,
        string $name,
        ?string $existingStripeId = null,
        array $metadata = [],
    ): Customer {
        if ($existingStripeId) {
            return Customer::retrieve($existingStripeId);
        }

        return Customer::create([
            'email' => $email,
            'name' => $name,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Verifica la firma del webhook de Stripe y construye el evento.
     *
     * @throws \Stripe\Exception\SignatureVerificationException
     */
    public function constructWebhookEvent(string $payload, string $sigHeader): Event
    {
        return Webhook::constructEvent(
            $payload,
            $sigHeader,
            config('stripe.webhook_secret'),
        );
    }
}
