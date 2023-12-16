<?php

class AuthController extends Controller
{

    public function index(): void
    {

        Site::redirect('/auth/login');

    }


    public function login()
    {
        if (isset($_SESSION['isLogin'])) {
            Site::redirect('/admin');
        }

        $error = null;
        if (count($_POST) > 0) {
            $email = trim($_POST['emailInput']);
            $password = trim($_POST['passwordInput']);
            if ($email == '' || $password == '') {
                $error = "Invalid email or password";
            }
            $this->model('AuthModel');
            $credential = $this->AuthModel->checkCredential($email, $password);

            if ($credential) {
                $this->createSession($credential);
                Site::redirect('/admin');
            } else {
                $error = "Invalid email or password";
            }
        }

        $data = array(
            'title' => 'Login',
            'error' => $error,
        );

        $this->view('auth/login', $data);
    }

    private function createSession($user)
    {
        session_start();
        $_SESSION['user']['isLogin'] = true;
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['prefix'] = $user['prefix'];
        $_SESSION['user']['firstname'] = $user['firstname'];
        $_SESSION['user']['lastname'] = $user['lastname'];
        $_SESSION['user']['fullname'] = $user['prefix'] . $user['firstname'] . ' ' . $user['lastname'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['position'] = $user['position'];
        $_SESSION['user']['office_id'] = $user['office_id'];
        $_SESSION['user']['roles'] = explode(',', $user['roles']);
        $_SESSION['user']['active'] = $user['active'];
        $_SESSION['user']['last_login'] = $user['last_login'];
        $_SESSION['user']['created_date'] = $user['created_date'];
        $_SESSION['user']['updated_date'] = $user['updated_date'];
    }

    public function logout()
    {
        session_start();
        session_destroy();
        Site::redirect('/auth/login');
    }
}

class_alias('AuthController', 'auth');