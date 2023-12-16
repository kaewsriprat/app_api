<?php

class UsersController extends Controller
{
    public function index(): void
    {
        if (count($_SESSION) == 0 || $_SESSION['user']['isLogin'] == false) {
            Site::redirect('/auth/login');
        }

        $this->model('UsersModel');


        $data = array(
            'title' => 'จัดการผู้ใช้งาน',
            'users' => $this->UsersModel->get_users_data()
        );
        $this->adminView('users/users', $data);
    }
}

class_alias('UsersController', 'users');

?>