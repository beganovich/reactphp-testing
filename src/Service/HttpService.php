<?php

namespace App\Service;

use App\Context;
use App\Controller\PostsController;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use React\Http\Message\Response;
use App\Interface\ServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

class HttpService implements ServiceInterface
{
    private HttpServer $httpServer;
    private SocketServer $socketServer;

    public function __construct(
        public readonly Context $context,
    )
    {
        $this->socketServer = new SocketServer('0.0.0.0:8080');

        $this->httpServer = new HttpServer(
            $this->handler(...)
        );
    }

    public function handler(ServerRequestInterface $request): Response
    {
        if ($request->getUri()->getPath() !== '/posts') {
            return Response::json([
                'error' => 'Not found',
            ]);
        }

        $controller = new PostsController();

        return $controller->index(
            context: $this->context,
            request: $request,
        );
    }

    public function boot(): void
    {
        $this->httpServer->listen($this->socketServer);
    }
}
