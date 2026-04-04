<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'E-Commerce Website V1',
                'category' => 'Web Development',
                'description' => 'A clean and modern e-commerce solution for small businesses.',
                'image' => 'portfolios/sample1.jpg',
                'link' => '#',
                'is_featured' => true,
            ],
            [
                'title' => 'Corporate Branding UI',
                'category' => 'UI/UX Design',
                'description' => 'A comprehensive design project for a leading financial firm.',
                'image' => 'portfolios/sample2.jpg',
                'link' => '#',
                'is_featured' => true,
            ],
            [
                'title' => 'SaaS Dashboard Design',
                'category' => 'Web App Design',
                'description' => 'A complex data-driven dashboard for a logistics company.',
                'image' => 'portfolios/sample3.jpg',
                'link' => '#',
                'is_featured' => true,
            ],
            [
                'title' => 'Mobile App Rebranding',
                'category' => 'Mobile Design',
                'description' => 'A fresh look for a popular lifestyle application.',
                'image' => 'portfolios/sample4.jpg',
                'link' => '#',
                'is_featured' => false,
            ],
            [
                'title' => 'Marketing Landing Page',
                'category' => 'Web Development',
                'description' => 'High-converting landing page for a tech startup.',
                'image' => 'portfolios/sample5.jpg',
                'link' => '#',
                'is_featured' => false,
            ],
            [
                'title' => 'Educational Platform',
                'category' => 'UX Design',
                'description' => 'A user-friendly learning management system layout.',
                'image' => 'portfolios/sample6.jpg',
                'link' => '#',
                'is_featured' => false,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::updateOrCreate(
                ['title' => $portfolio['title']],
                array_merge($portfolio, ['slug' => Str::slug($portfolio['title'])])
            );
        }
    }
}
