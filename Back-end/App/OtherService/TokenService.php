<?php

namespace App\OtherService;

require __DIR__ . '/../../vendor/autoload.php';
include_once __DIR__ . '/../config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class TokenService {
    public static function generateToken($usuario) {
        $payload = [
            'sub' => $usuario->getId(),
            'role' => $usuario->getRole(),
            'iat' => time(),
            'exp' => JWT_EXPIRE,
            'iss' => 'daw2025_app_back',
            'aud' => 'daw2025_app_front'
        ];

        return JWT::encode($payload, JWT_SECRET, 'HS256');
    }

    public static function validateToken($token) {
        try {
            return JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
        } catch (Exception $e) {
            return null;
        }
    }

}

