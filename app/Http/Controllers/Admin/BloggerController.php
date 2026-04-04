<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BloggerService;
use Illuminate\Http\Request;

class BloggerController extends Controller
{
    protected $bloggerService;

    public function __construct(BloggerService $bloggerService)
    {
        $this->bloggerService = $bloggerService;
    }

    /**
     * Display a listing of the Blogger posts.
     */
    public function index(Request $request)
    {
        $pageToken = $request->query('page');
        $posts = $this->bloggerService->getPosts(20, $pageToken);
        
        $error = null;
        if (!$posts) {
            $error = "Gagal mengambil data dari Blogger. Pastikan konfigurasi di file .env sudah benar.";
        }

        return view('admin.blogger.index', [
            'posts' => $posts ? $posts->getItems() : [],
            'nextPageToken' => $posts ? $posts->getNextPageToken() : null,
            'prevPageToken' => $posts ? $posts->getPrevPageToken() : null,
            'error' => $error,
            'blogId' => setting('blogger_blog_id', config('services.blogger.blog_id'))
        ]);
    }
}
