<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\BloggerService;

$service = new BloggerService();
$posts = $service->getPosts(10);

if ($posts) {
    foreach ($posts->getItems() ?? [] as $post) {
        $id = $post->getId();
        $title = $post->getTitle();
        echo "ID: $id | Title: $title\n";
        
        // Try to get comments for this post
        try {
            $comments = $service->getComments($id);
            if ($comments) {
                $count = count($comments->getItems() ?? []);
                echo "  -> Found $count comments.\n";
            } else {
                echo "  -> Failed to get comments (returned null).\n";
            }
        } catch (\Exception $e) {
            echo "  -> Error: " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "Gagal mengambil daftar postingan.\n";
}
