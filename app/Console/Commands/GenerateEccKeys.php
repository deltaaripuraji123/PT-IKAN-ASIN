<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpseclib3\Crypt\EC;

class GenerateEccKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecc:generate-keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new ECC key pair for encryption and decryption.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating ECC key pair...');

        $keyPath = storage_path('app/keys/');
        $privateKeyPath = $keyPath . 'private.key';
        $publicKeyPath = $keyPath . 'public.key';

        // Cek jika kunci sudah ada
        if (file_exists($privateKeyPath) || file_exists($publicKeyPath)) {
            if (!$this->confirm('Key files already exist. Do you want to overwrite them?')) {
                $this->info('Operation cancelled.');
                return self::SUCCESS;
            }
        }

        // Buat folder jika belum ada
        if (!is_dir($keyPath)) {
            mkdir($keyPath, 0755, true);
        }

        // Generate kunci dengan algoritma Curve25519 (modern dan direkomendasikan)
        $privateKey = EC::createKey('Ed25519');
        $publicKey = $privateKey->getPublicKey();

        // Simpan kunci privat
        file_put_contents($privateKeyPath, $privateKey->toString('PKCS8'));
        $this->info("Private key saved to: {$privateKeyPath}");

        // Simpan kunci publik
        file_put_contents($publicKeyPath, $publicKey->toString('PKCS8'));
        $this->info("Public key saved to: {$publicKeyPath}");

        // Set permission file kunci privat agar hanya bisa dibaca oleh owner
        chmod($privateKeyPath, 0600);
        chmod($publicKeyPath, 0644);

        $this->info('ECC key pair generated successfully!');
        
        return self::SUCCESS;
    }
}