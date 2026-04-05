<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\BloggerService;

$service = new BloggerService();
$blogId = $service->getBlogId();
$postId = '8777174624734892211'; // ID dari Orbit WA API

echo "Blog ID: $blogId\n";
echo "Post ID: $postId\n";

try {
    $comments = $service->getComments($postId);
    if ($comments) {
        $count = count($comments->getItems() ?? []);
        echo "Found $count comments.\n";
        foreach ($comments->getItems() ?? [] as $comment) {
            echo "- " . $comment->getAuthor()->getDisplayName() . ": " . substr($comment->getContent(), 0, 50) . "...\n";
        }
    } else {
        echo "No comments found (result is null).\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
