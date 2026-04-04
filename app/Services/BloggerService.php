<?php

namespace App\Services;

use Google\Client;
use Google\Service\Blogger;
use Illuminate\Support\Facades\Log;

class BloggerService
{
    protected $client;
    protected $blogger;
    protected $blogId;

    public function __construct()
    {
        $this->client = new Client();
        
        // Prioritas pengaturan: Database Setting -> Config (.env)
        $apiKey = setting('blogger_api_key', config('services.blogger.key'));
        $this->blogId = trim(setting('blogger_blog_id', config('services.blogger.blog_id')));

        $this->client->setDeveloperKey($apiKey);
        // Optional: set more config if needed for OAuth
        
        $this->blogger = new Blogger($this->client);
    }

    /**
     * Get the active Blog ID.
     */
    public function getBlogId()
    {
        return $this->blogId;
    }

    /**
     * Get list of posts from Blogger.
     */
    public function getPosts($maxResults = 10, $pageToken = null)
    {
        try {
            $optParams = [
                'maxResults' => $maxResults,
                'fetchBodies' => true,
                'fetchImages' => true,
            ];

            if ($pageToken) {
                $optParams['pageToken'] = $pageToken;
            }

            return $this->blogger->posts->listPosts($this->blogId, $optParams);
        } catch (\Exception $e) {
            Log::error("Blogger API Error (ID: {$this->blogId}): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get a single post by its ID.
     */
    public function getPost($postId)
    {
        try {
            return $this->blogger->posts->get($this->blogId, $postId);
        } catch (\Exception $e) {
            Log::error("Blogger API Error (Get Post): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get a post by path/slug.
     * Note: Blogger slig are usually the full path including .html
     */
    /**
     * Get comments for a specific post.
     */
    public function getComments($postId)
    {
        try {
            $optParams = [
                'fetchBodies' => true,
                'maxResults' => 100, // Reasonable limit
            ];

            return $this->blogger->comments->listComments($this->blogId, $postId, $optParams);
        } catch (\Exception $e) {
            Log::error("Blogger API Error (Get Comments): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Search posts by query.
     */
    public function searchPosts($query)
    {
        try {
            return $this->blogger->posts->search($this->blogId, $query, ['fetchBodies' => true]);
        } catch (\Exception $e) {
            Log::error("Blogger API Error (Search Posts): " . $e->getMessage());
            return null;
        }
    }
}
