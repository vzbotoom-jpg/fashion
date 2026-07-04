<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // General Settings
            [
                'key' => 'store_name',
                'value' => 'Fashion Pre-Order Store',
                'group' => 'general',
                'description' => 'Nama toko',
                'is_public' => true,
            ],
            [
                'key' => 'store_email',
                'value' => 'info@fashionpreorder.com',
                'group' => 'general',
                'description' => 'Email toko',
                'is_public' => true,
            ],
            [
                'key' => 'store_phone',
                'value' => '081234567890',
                'group' => 'general',
                'description' => 'Nomor telepon toko',
                'is_public' => true,
            ],
            [
                'key' => 'store_address',
                'value' => 'Jl. Fashion No. 123, Jakarta',
                'group' => 'general',
                'description' => 'Alamat toko',
                'is_public' => true,
            ],
            [
                'key' => 'store_description',
                'value' => 'Toko fashion terpercaya dengan layanan pre-order dan custom order',
                'group' => 'general',
                'description' => 'Deskripsi toko',
                'is_public' => true,
            ],
            [
                'key' => 'timezone',
                'value' => 'Asia/Jakarta',
                'group' => 'general',
                'description' => 'Zona waktu',
                'is_public' => false,
            ],
            [
                'key' => 'currency',
                'value' => 'IDR',
                'group' => 'general',
                'description' => 'Mata uang',
                'is_public' => true,
            ],

            // Payment Settings
            [
                'key' => 'payment_methods',
                'value' => 'bank_transfer,credit_card,e_wallet',
                'group' => 'payment',
                'description' => 'Metode pembayaran yang tersedia',
                'is_public' => true,
            ],
            [
                'key' => 'bank_transfer_account',
                'value' => 'BCA',
                'group' => 'payment',
                'description' => 'Nama bank',
                'is_public' => true,
            ],
            [
                'key' => 'bank_transfer_number',
                'value' => '1234567890',
                'group' => 'payment',
                'description' => 'Nomor rekening bank',
                'is_public' => true,
            ],
            [
                'key' => 'bank_transfer_name',
                'value' => 'Fashion Pre-Order Store',
                'group' => 'payment',
                'description' => 'Nama pemilik rekening',
                'is_public' => true,
            ],
            [
                'key' => 'midtrans_enabled',
                'value' => 'false',
                'group' => 'payment',
                'description' => 'Aktifkan Midtrans',
                'is_public' => false,
            ],
            [
                'key' => 'midtrans_server_key',
                'value' => '',
                'group' => 'payment',
                'description' => 'Server key Midtrans',
                'is_public' => false,
            ],
            [
                'key' => 'midtrans_client_key',
                'value' => '',
                'group' => 'payment',
                'description' => 'Client key Midtrans',
                'is_public' => false,
            ],

            // Shipping Settings
            [
                'key' => 'shipping_methods',
                'value' => 'standard,express,same_day',
                'group' => 'shipping',
                'description' => 'Metode pengiriman yang tersedia',
                'is_public' => true,
            ],
            [
                'key' => 'shipping_cost_standard',
                'value' => '20000',
                'group' => 'shipping',
                'description' => 'Biaya pengiriman standar',
                'is_public' => true,
            ],
            [
                'key' => 'shipping_cost_express',
                'value' => '50000',
                'group' => 'shipping',
                'description' => 'Biaya pengiriman express',
                'is_public' => true,
            ],
            [
                'key' => 'shipping_cost_same_day',
                'value' => '100000',
                'group' => 'shipping',
                'description' => 'Biaya pengiriman same day',
                'is_public' => true,
            ],
            [
                'key' => 'free_shipping_threshold',
                'value' => '500000',
                'group' => 'shipping',
                'description' => 'Minimal pembelian untuk gratis ongkir',
                'is_public' => true,
            ],
            [
                'key' => 'shipping_zone',
                'value' => 'Indonesia',
                'group' => 'shipping',
                'description' => 'Zona pengiriman',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}