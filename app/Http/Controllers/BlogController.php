<?php

namespace App\Http\Controllers;

use App\Services\BloggerService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogger;

    public function __construct(BloggerService $blogger)
    {
        $this->blogger = $blogger;
    }

    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request)
    {
        $pageToken = $request->get('page');
        $posts = $this->blogger->getPosts(12, $pageToken); // We take 12 posts per page
        
        // Handle API key or Blog ID not configured
        if (!$posts) {
            return view('page.blog', [
                'posts' => [],
                'nextPageToken' => null,
                'prevPageToken' => null,
                'error' => 'Gagal mengambil data dari Blogger. Pastikan API Key dan Blog ID sudah benar di konfigurasi .env'
            ]);
        }

        return view('page.blog', [
            'posts' => $posts->getItems() ?? [],
            'nextPageToken' => $posts->getNextPageToken(),
            'prevPageToken' => $posts->getPrevPageToken(),
        ]);
    }

    /**
     * Display the specified blog post.
     */
    public function show($id, Request $request)
    {
        $post = $this->blogger->getPost($id);

        if (!$post) {
            abort(404, 'Postingan tidak ditemukan.');
        }

        // Fetch latest posts for "Other articles" section
        $latestPosts = $this->blogger->getPosts(4); // Fetch 4, we might filter out current one
        $otherPosts = [];
        if ($latestPosts && $latestPosts->getItems()) {
            foreach ($latestPosts->getItems() as $item) {
                if ($item->getId() !== $id) {
                    $otherPosts[] = $item;
                }
                if (count($otherPosts) >= 3) break;
            }
        }

        return view('page.blog-detail', [
            'post' => $post,
            'blogId' => $this->blogger->getBlogId(),
            'otherPosts' => $otherPosts
        ]);
    }
}
