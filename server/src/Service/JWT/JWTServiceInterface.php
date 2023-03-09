<?php

namespace App\Service\JWT;

use Symfony\Component\HttpFoundation\Request;

interface JWTServiceInterface
{
    public function extractBearerTokenFromRequest(Request $request): string;
    public function decodeBearerToken(string $token): array;
}