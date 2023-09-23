<?php

namespace App\Controller;

use App\Context;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

class PostsController
{
    public function index(Context $context, ServerRequestInterface $request): Response
    {
        $posts = [];

        $query = $context->database->prepare('SELECT id, title, content FROM posts LIMIT :limit');
        $query->bindValue(':limit', $request->getQueryParams()['limit'] ?? 100, SQLITE3_INTEGER);
        
        $results = $query->execute();

        while ($result = $results->fetchArray(mode: SQLITE3_ASSOC)) {
            \array_push($posts, $result);
        }

        return Response::json([
            'posts' => $posts,
        ]);
    }
}