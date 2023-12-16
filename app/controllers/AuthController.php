<?php

class AuthController extends Controller
{

    public function index(): void
    {
        echo "Hello from AuthController";
    }

    public function login()
    {

        $this->check_method('POST');

        if (
            !isset($_POST['email']) || !isset($_POST['password'])
            || $_POST['email'] == '' || $_POST['password'] == ''
            || $_POST['email'] == null || $_POST['password'] == null
            ) {

            $this->status = 'error';
            $this->status_code = 400;
            $this->message = 'Please fill all fields';
            $this->api_response();
   
        } else {

            $this->model('AuthModel');
            $this->model('UsersModel');
            $result = $this->AuthModel->check_credential(
                trim($_POST['email']),
                md5(trim($_POST['password'])),
            );

            if($result) {
                $this->status = 'success';
                $this->status_code = 200;
                $this->message = 'Login success';
                $this->data = $this->UsersModel->get_user_by_id($result['id']);
                $this->api_response();
            } else {
                $this->status = 'error';
                $this->status_code = 400;
                $this->message = 'Login failed';
                $this->api_response();
            }
        }
    }
}

class_alias('AuthController', 'auth');