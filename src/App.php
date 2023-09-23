<?php

namespace App;

use App\Service\HttpService;

class App
{
    private HttpService $httpService;

    public function __construct()
    {
        $this->httpService = new HttpService(
            context: new Context(),
        );
    }

    public function start(): void
    {
        $this->httpService->boot();
    }
}
