<?php

class Auth extends Controller {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password'])
            ];

            if (empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['confirm_password'])) {
                $data['error'] = 'Please fill out all fields';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['error'] = 'Passwords do not match';
            } else {
                $userModel = $this->model('User');
                if ($userModel->register($data)) {
                    header('Location: /auth/login');
                } else {
                    $data['error'] = 'Something went wrong';
                }
            }

            $this->view('auth/register', $data);
        } else {
            $this->view('auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'remember_me' => isset($_POST['remember_me'])
            ];

            if (empty($data['email']) || empty($data['password'])) {
                $data['error'] = 'Please fill out all fields';
            } else {
                $userModel = $this->model('User');
                $loggedInUser = $userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // Create session
                    $_SESSION['user_id'] = $loggedInUser['id'];
                    $_SESSION['user_email'] = $loggedInUser['email'];
                    $_SESSION['user_name'] = $loggedInUser['username'];

                    // Set a cookie if remember me is checked
                    if ($data['remember_me']) {
                        setcookie('user_id', $loggedInUser['id'], time() + (86400 * 30), "/"); // 30 days
                    }

                    header('Location: /');
                } else {
                    $data['error'] = 'Invalid credentials';
                }
            }

            $this->view('auth/login', $data);
        } else {
            $this->view('auth/login');
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        setcookie('user_id', '', time() - 3600, '/'); // Expire the cookie
        session_destroy();
        header('Location: /auth/login');
    }
}
?>