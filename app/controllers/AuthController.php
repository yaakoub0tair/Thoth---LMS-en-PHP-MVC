<?php
namespace App\Controllers;

use App\Models\Student;

class AuthController {
    private $student;
    
    public function __construct() {
        $this->student = new Student();
    }
    
    public function showLogin() {
        include __DIR__ . '/../views/auth/login.php';
    }
    
    public function showRegister() {
        include __DIR__ . '/../views/auth/register.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs";
                include __DIR__ . '/../views/auth/login.php';
                return;
            }
            
            $student = $this->student->findByEmail($email);
            
            if ($student && password_verify($password, $student['password'])) {
                $_SESSION['user_id'] = $student['id'];
                $_SESSION['user_name'] = $student['name'];
                header('Location: /student/dashboard');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
                include __DIR__ . '/../views/auth/login.php';
            }
        }
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "Veuillez remplir tous les champs";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }
            
            if ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }
            
            if ($this->student->findByEmail($email)) {
                $error = "Cet email est déjà utilisé";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }
            
            if ($this->student->create($name, $email, $password)) {
                header('Location: /login');
                exit;
            } else {
                $error = "Erreur lors de l'inscription";
                include __DIR__ . '/../views/auth/register.php';
            }
        }
    }
    
    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
