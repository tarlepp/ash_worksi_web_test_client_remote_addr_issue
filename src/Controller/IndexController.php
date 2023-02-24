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
        return new JsonResponse(['clientIp' => $request->getClientIp()]);
    }
}
