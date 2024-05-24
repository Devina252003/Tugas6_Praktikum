<?php
include_once 'config/conn.php';

class AuthController {
    static function login() {
        view('auth_page/layout', ['url' => 'login']);
    }

    static function register() {
        view('auth_page/layout', ['url' => 'register']);
    }
    
    static function saveLogin() {
        $post = array_map('htmlspecialchars', $_POST);
        $user = User::login([
            'email' => $post['email'], 
            'password' => $post['password']
        ]);
        if ($user) {
            unset($user['Password']); 
            $_SESSION['user'] = $user;
            header('Location: '.BASEURL.'index');
        }
        else {
            header('Location: '.BASEURL.'login?failed=true');
        }
    }

    static function saveRegister() {
        $post = array_map('htmlspecialchars', $_POST);
        $user = User::register([
            'Fullname' => $post['Fullname'], 
            'Username' => $post['Username'], 
            'Email' => $post['Email'], 
            'Password' => $post['Password']
        ]);
        if ($user) {
            header('Location: '.BASEURL.'login');
        }
        else {
            header('Location: '.BASEURL.'register?failed=true');
        }
    }

    static function logout() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header('Location: '.BASEURL);
    }

    static function forgotPassword() {}
}
?>
