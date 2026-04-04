<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            [
                'title' => 'BASIC',
                'subtitle' => 'Perfect for personal sites',
                'price' => 1500000,
                'badge' => null,
                'features' => [
                    '1 Page Custom Design',
                    'Mobile Responsive',
                    'Standard Performance',
                    'Contact Form Integration',
                    '5 Days Delivery',
                ],
                'is_popular' => false,
                'button_text' => 'Pesan Sekarang',
                'button_link' => 'pesan',
                'order' => 1,
            ],
            [
                'title' => 'PRO',
                'subtitle' => 'Most popular for startups',
                'price' => 3500000,
                'badge' => 'MOST POPULAR',
                'features' => [
                    '5 Pages Custom Design',
                    'Advanced Animations',
                    'SEO Optimization',
                    'CMS Dashboard',
                    'Admin Panel Access',
                    '10 Days Delivery',
                ],
                'is_popular' => true,
                'button_text' => 'Pesan Sekarang',
                'button_link' => 'pesan',
                'order' => 2,
            ],
            [
                'title' => 'ENTERPRISE',
                'subtitle' => 'Full scale digital solutions',
                'price' => 7500000,
                'badge' => 'ELITE',
                'features' => [
                    'Unlimited Pages',
                    'Custom System Integration',
                    'Premium Graphics & Icons',
                    '24/7 Priority Support',
                    'Hosting & Domain Included',
                    '15 Days Delivery',
                ],
                'is_popular' => false,
                'button_text' => 'Pesan Sekarang',
                'button_link' => 'pesan',
                'order' => 3,
            ],
        ];

        foreach ($prices as $price) {
            Price::updateOrCreate(
                ['title' => $price['title']],
                $price
            );
        }
    }
}
