<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Price;
use App\Services\BloggerService;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    protected $blogger;

    public function __construct(BloggerService $blogger)
    {
        $this->blogger = $blogger;
    }

    public function index(Request $request)
    {
        $query = $request->get('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'services' => [],
                'portfolio' => [],
                'articles' => []
            ]);
        }

        // 1. Search Services / Prices
        $services = Price::where('title', 'like', "%{$query}%")
            ->orWhere('service_name', 'like', "%{$query}%")
            ->orWhere('subtitle', 'like', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title ?? $item->service_name,
                    'type' => 'Layanan & Paket',
                    'icon' => 'fas fa-tags',
                    'image' => asset('Assets/Image/Illustration.png'), // Use same illustration as banner for consistency
                    'url' => route('harga') . '#package-' . $item->id
                ];
            });

        // 2. Search Portfolio
        $portfolio = Portfolio::where('title', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'type' => 'Portofolio',
                    'icon' => 'fas fa-briefcase',
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
                    'url' => route('portfolio') . '#project-' . $item->id
                ];
            });

        // 3. Search Blog Articles
        $articles = [];
        $blogResults = $this->blogger->searchPosts($query);
        
        if ($blogResults && isset($blogResults->items)) {
            foreach (array_slice($blogResults->items, 0, 5) as $post) {
                // Extract first image from content if exists
                preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->content, $matches);
                $imageUrl = $matches['src'] ?? null;

                $articles[] = [
                    'title' => $post->title,
                    'type' => 'Artikel',
                    'icon' => 'fas fa-newspaper',
                    'image' => $imageUrl,
                    'url' => route('blog.show', $post->id)
                ];
            }
        }

        return response()->json([
            'services' => $services,
            'portfolio' => $portfolio,
            'articles' => $articles
        ]);
    }
}
