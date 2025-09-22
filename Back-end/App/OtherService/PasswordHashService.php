<?php

namespace App\OtherService;

class PasswordHashService {
    public static function hashPassword($contrasena): string {
        return password_hash($contrasena, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($contrasena, $hash): bool {
        return password_verify($contrasena, $hash);
    }
}
