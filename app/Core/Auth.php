<?php
namespace App\Core;

class Auth {
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }
    
    public static function user() {
        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name']
            ];
        }
        return null;
    }
}
