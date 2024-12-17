<?php

require_once 'models/User.php';

class LoginController
{
    public function showLoginForm($errors = [])
    {
        
        if (isset($_SESSION['user'])) {
            header('Location: ?path=inventory');
            exit(); 
        }

        require_once 'views/login.php';
    }

    public function authenticate()
    {
        // Match the form input field name
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $errors = [];

        
        // Validate input
        if (empty($username)) {
            $errors['username'] = 'Username is required.';
        }
        
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        }


        if (empty($errors)) {
            $userModel = new User();
            $user = $userModel->validateCredentials($username, $password);

            if ($user) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username']
                ];
                header('Location: ?path=inventory');
                exit();
            } else {
                error_log('Authentication failed: Invalid credentials for user: ' . $username);
                $errors['general'] = 'Invalid username or password.';
            }
        }

        // If there are errors, re-display the login form with errors
        $this->showLoginForm($errors);
    }
}
