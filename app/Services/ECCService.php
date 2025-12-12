<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\EC;
use phpseclib3\Exception\NoKeyLoadedException;

class ECCService
{
    private string $publicKey;
    private string $privateKey;
    private AES $cipher;

    public function __construct()
    {
        $this->loadKeys();
        // Kita akan menurunkan kunci enkripsi dari kunci privat ECC
        $this->cipher = new AES('cbc'); // Menggunakan mode CBC
        $this->cipher->setKey($this->deriveKeyFromPrivateKey());
    }

    /**
     * Memuat kunci dari file.
     */
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
    
    /**
     * Menurunkan kunci simetris 256-bit (32-byte) dari kunci privat ECC.
     * Kita menggunakan hash() bawaan PHP dan mengambil output binernya.
     */
    private function deriveKeyFromPrivateKey(): string
    {
        // Hash string kunci privat dengan SHA-256 dan ambil output binernya (32-byte)
        return hash('sha256', $this->privateKey, true); // <--- TAMBAHKAN 'true' DI SINI
    }

    /**
     * Mengenkripsi data plaintext.
     * @param string $plaintext
     * @return string (base64 encoded ciphertext)
     */
    public function encrypt(string $plaintext): string
    {
        try {
            $iv = random_bytes(16); // AES menggunakan IV 16-byte untuk mode CBC
            $this->cipher->setIV($iv);
            $ciphertext = $this->cipher->encrypt($plaintext);
            
            // Kembalikan IV + Ciphertext, keduanya di-encode Base64
            return base64_encode($iv . $ciphertext);
        } catch (\Exception $e) {
            Log::error('ECC Encryption Failed: ' . $e->getMessage());
            throw new Exception('Encryption process failed.');
        }
    }

    /**
     * Mendekripsi data ciphertext.
     * @param string $base64Ciphertext
     * @return string (plaintext)
     */
    public function decrypt(string $base64Ciphertext): string
    {
        try {
            $data = base64_decode($base64Ciphertext, true);
            if ($data === false || strlen($data) < 16) {
                 throw new Exception('Invalid ciphertext format.');
            }

            // Pisahkan IV dan ciphertext
            $iv = substr($data, 0, 16);
            $ciphertext = substr($data, 16);
            
            $this->cipher->setIV($iv);
            return $this->cipher->decrypt($ciphertext);
        } catch (\Exception $e) {
            Log::error('ECC Decryption Error: ' . $e->getMessage());
            // Kembalikan nilai asli jika dekripsi gagal (misalnya data lama yang tidak terenkripsi)
            return $base64Ciphertext;
        }
    }
}