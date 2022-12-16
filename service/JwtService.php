<?php

namespace App\service;

use DateTimeImmutable;
use Firebase\JWT\JWT;

class JwtService
{
    public static function encode(int $expire, string $username): string
    {
        $iat = new DateTimeImmutable();
        $secret = env('JWT_SECRET');
        $exp = $iat->modify("+" . $expire . " minutes")->getTimestamp();
        $serverName = "localhost:8000";

        $data = [
            'iat' => $iat,
            'iss' => $serverName,
            'nbf' => $iat,
            'exp' => $exp,
            'username' => $username,
        ];

        return JWT::encode($data, $secret, 'HS256');
    }
}
