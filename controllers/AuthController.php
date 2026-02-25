<?php
require_once __DIR__ . '/../models/User.php'; // [cite: 140]
session_start(); // [cite: 141]

class AuthController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn); // [cite: 145]
    }

    public function register($email, $password) {
        return $this->userModel->register($email, $password); // [cite: 149]
    }

    public function verify($code) {
        return $this->userModel->verify($code); // [cite: 152]
    }

    public function login($email, $password) {
        $result = $this->userModel->login($email, $password); // [cite: 154]
        if (is_array($result)) { // [cite: 155]
            $_SESSION['user'] = $result['email']; // [cite: 156]
            header("Location: index.php?action=home"); // [cite: 159]
            exit();
        }
        return $result; // [cite: 160]
    }

    public function logout() {
        session_destroy(); // [cite: 165]
        header("Location: index.php?action=login"); // [cite: 166]
        exit();
    }
}