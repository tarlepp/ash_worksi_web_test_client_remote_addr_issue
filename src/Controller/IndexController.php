<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    #[Route(path: '/')]
    public function __invoke(Request $request): JsonResponse
    {
        // This is a bit hacky, but you could do this in request subscriber where you listen `RequestEvent::class`
        $_SERVER['REMOTE_ADDR'] = $request->getClientIp();

        return new JsonResponse(['clientIp' => $_SERVER['REMOTE_ADDR']]);
    }
}
