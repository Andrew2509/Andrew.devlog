<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Portfolio;
use App\Services\BloggerService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    protected $blogger;

    public function __construct(BloggerService $blogger)
    {
        $this->blogger = $blogger;
    }

    public function index()
    {
        $urls = [];

        // 1. Static Pages
        $urls[] = [
            'loc' => url('/'),
            'lastmod' => now()->startOfMonth()->format('Y-m-d'),
            'priority' => '1.0',
            'changefreq' => 'daily'
        ];

        $staticPages = [
            ['path' => '/portofolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['path' => '/harga', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/blog', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['path' => '/pesan', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/privacy', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['path' => '/terms', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => url($page['path']),
                'lastmod' => now()->startOfWeek()->format('Y-m-d'),
                'priority' => $page['priority'],
                'changefreq' => $page['changefreq']
            ];
        }

        // 2. Service Categories (Dynamic)
        $categories = ServiceCategory::all();
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => route('harga', ['category' => $category->slug]),
                'lastmod' => $category->updated_at ? $category->updated_at->format('Y-m-d') : now()->format('Y-m-d'),
                'priority' => '0.7',
                'changefreq' => 'weekly'
            ];
        }

        // 3. Blog Posts from Blogger (Dynamic)
        $posts = $this->blogger->getPosts(50); // Get 50 latest posts
        if ($posts && $posts->getItems()) {
            foreach ($posts->getItems() as $post) {
                // Determine lastmod from post update time
                $updatedAt = isset($post->updated) ? date('Y-m-d', strtotime($post->updated)) : now()->format('Y-m-d');
                
                $urls[] = [
                    'loc' => route('blog.show', ['id' => $post->id]),
                    'lastmod' => $updatedAt,
                    'priority' => '0.6',
                    'changefreq' => 'monthly'
                ];
            }
        }

        return response()->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
}
