<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'customer_name' => 'Andi Wijaya',
                'customer_email' => 'andi@example.com',
                'content' => 'Produknya sangat berkualitas! Saya sangat puas dengan pembelian saya di sini. Pre-order yang cepat dan pelayanan yang ramah.',
                'rating' => 5,
            ],
            [
                'customer_name' => 'Siti Rahayu',
                'customer_email' => 'siti@example.com',
                'content' => 'Saya pesan custom order dan hasilnya melebihi ekspektasi. Tim desain sangat profesional dan komunikatif.',
                'rating' => 5,
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_email' => 'budi@example.com',
                'content' => 'Koleksi fashion-nya selalu update dan sesuai tren. Harga terjangkau dengan kualitas premium.',
                'rating' => 4,
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'customer_email' => 'dewi@example.com',
                'content' => 'Pelayanan pre-order sangat memuaskan. Ukuran pas dan pengiriman tepat waktu. Rekomendasi banget!',
                'rating' => 5,
            ],
            [
                'customer_name' => 'Rizky Pratama',
                'customer_email' => 'rizky@example.com',
                'content' => 'Saya sudah beberapa kali pesan di sini, selalu puas. Bahan berkualitas dan desain yang menarik.',
                'rating' => 4,
            ],
            [
                'customer_name' => 'Maya Putri',
                'customer_email' => 'maya@example.com',
                'content' => 'Custom order saya sangat bagus! Mereka benar-benar memperhatikan detail dan keinginan pelanggan.',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                [
                    'customer_name' => $testimonial['customer_name'],
                    'content' => $testimonial['content'],
                ],
                array_merge($testimonial, ['is_active' => true])
            );
        }
    }
}