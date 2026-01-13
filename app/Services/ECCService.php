<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\AES;

class ECCService
{
    private string $publicKey;
    private string $privateKey;
    private AES $cipher;

    public function __construct()
    {
        $this->loadKeys();
        $this->cipher = new AES('cbc'); 
        $this->cipher->setKey($this->deriveKeyFromPrivateKey());
    }

    private function loadKeys(): void
    {
        $keyPath = storage_path('app/keys/');
        $publicKeyPath = $keyPath . 'public.key';
        $privateKeyPath = $keyPath . 'private.key';

        if (!file_exists($publicKeyPath) || !file_exists($privateKeyPath)) {
            throw new Exception('ECC key files not found. Please run php artisan ecc:generate-keys');
        }

        $this->publicKey = file_get_contents($publicKeyPath);
        $this->privateKey = file_get_contents($privateKeyPath);
    }

    private function deriveKeyFromPrivateKey(): string
    {
        return hash('sha256', $this->privateKey, true);
    }

    public function encrypt(string $plaintext): string
    {
        try {
            $iv = random_bytes(16);
            $this->cipher->setIV($iv);
            $ciphertext = $this->cipher->encrypt($plaintext);

            return base64_encode($iv . $ciphertext);
        } catch (\Exception $e) {
            Log::error('ECC Encryption Failed: ' . $e->getMessage());
            throw new Exception('Encryption process failed.');
        }
    }

    public function decrypt(?string $base64Ciphertext): ?string
    {
        if ($base64Ciphertext === null || $base64Ciphertext === '') {
            return null;
        }

        try {
            $data = base64_decode($base64Ciphertext, true);
            if ($data === false || strlen($data) < 16) {
                throw new Exception('Invalid ciphertext format.');
            }

            $iv = substr($data, 0, 16);
            $ciphertext = substr($data, 16);

            $this->cipher->setIV($iv);
            return $this->cipher->decrypt($ciphertext);
        } catch (\Exception $e) {
            Log::error('ECC Decryption Error: ' . $e->getMessage());
            return $base64Ciphertext; // fallback untuk data lama
        }
    }
}