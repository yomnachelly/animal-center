<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymeeService
{
    private $apiKey;
    private $apiSecret;
    private $baseUrl;
    private $sandbox;

    public function __construct()
    {
        $this->apiKey = config('paymee.api_key');
        $this->apiSecret = config('paymee.api_secret');
        $this->sandbox = config('paymee.sandbox', true);
        $this->baseUrl = $this->sandbox 
            ? 'https://sandbox.paymee.tn/api/v1'
            : 'https://paymee.tn/api/v1';

        // Log de la configuration (à retirer en production)
        Log::info('Paymee Config:', [
            'sandbox' => $this->sandbox,
            'base_url' => $this->baseUrl,
            'api_key_exists' => !empty($this->apiKey),
            'api_secret_exists' => !empty($this->apiSecret)
        ]);
    }

    public function createPayment($amount, $orderId, $firstName, $lastName, $email, $phone = null)
    {
        try {
            // Validation des paramètres requis
            if (empty($this->apiKey) || empty($this->apiSecret)) {
                Log::error('Paymee - Clés API manquantes');
                return [
                    'success' => false,
                    'error' => 'Configuration Paymee manquante'
                ];
            }

            $payload = [
                'amount' => floatval($amount),
                'note' => "Paiement pour la commande #{$orderId}",
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone ?? '+21600000000', // Valeur par défaut pour la Tunisie
                'return_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
                'webhook_url' => route('payment.webhook'),
                'order_id' => $orderId,
                'currency' => 'TND' // Ajouter la devise explicitement
            ];

            Log::info('Paymee Request Payload:', $payload);

            $response = Http::timeout(30)
                ->retry(3, 100)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey . ':' . $this->apiSecret,
                    'Content-Type' => 'application/json',
                ])->post($this->baseUrl . '/payments', $payload);

            Log::info('Paymee API Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                return [
                    'success' => true,
                    'data' => $responseData,
                    'payment_url' => $responseData['data']['payment_url'] ?? null
                ];
            }

            // Gestion des erreurs HTTP
            $errorMessage = $response->json('message') ?? $response->body() ?? 'Erreur inconnue';
            
            Log::error('Paymee API Error Response:', [
                'status' => $response->status(),
                'error' => $errorMessage
            ]);

            return [
                'success' => false,
                'error' => $errorMessage,
                'status' => $response->status()
            ];

        } catch (\Exception $e) {
            Log::error('Paymee API Exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return [
                'success' => false,
                'error' => 'Erreur de connexion à Paymee: ' . $e->getMessage()
            ];
        }
    }


    public function checkPaymentStatus($token)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey . ':' . $this->apiSecret,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . '/payments/' . $token);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            return [
                'success' => false,
                'error' => $response->json('message', 'Erreur inconnue')
            ];

        } catch (\Exception $e) {
            Log::error('Paymee Status Check Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Erreur de connexion a Paymee'
            ];
        }
    }

    public function verifyWebhookSignature($data, $signature)
    {
        $calculatedSignature = hash_hmac('sha256', json_encode($data), $this->apiSecret);
        return hash_equals($calculatedSignature, $signature);
    }

    public function refundPayment($token, $amount = null)
    {
        try {
            $payload = [];
            if ($amount) {
                $payload['amount'] = $amount;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey . ':' . $this->apiSecret,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/payments/' . $token . '/refund', $payload);

            return $response->successful();

        } catch (\Exception $e) {
            Log::error('Paymee Refund Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getPaymentHistory($page = 1, $limit = 10)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey . ':' . $this->apiSecret,
            ])->get($this->baseUrl . '/payments', [
                'page' => $page,
                'limit' => $limit
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            return [
                'success' => false,
                'error' => $response->json('message', 'Erreur inconnue')
            ];

        } catch (\Exception $e) {
            Log::error('Paymee History Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Erreur de connexion a Paymee'
            ];
        }
    }
    public function getPaymentDetails($token)
{
    try {
        $response = Http::timeout(30)
            ->retry(3, 100)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey . ':' . $this->apiSecret,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . '/payments/' . $token);

        Log::info('Paymee Payment Details Response:', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json()
            ];
        }

        return [
            'success' => false,
            'error' => $response->json('message', 'Erreur inconnue'),
            'status' => $response->status()
        ];

    } catch (\Exception $e) {
        Log::error('Paymee Get Payment Details Error: ' . $e->getMessage());
        return [
            'success' => false,
            'error' => 'Erreur de connexion à Paymee'
        ];
    }
}
}
