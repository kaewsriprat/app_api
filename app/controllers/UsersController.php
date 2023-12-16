<?php

class UsersController extends Controller
{

    public function index(): void
    {
        echo "Hello from UsersController";
    }

    public function register() {

        $this->check_method('POST');

        if (
            !isset($_POST['fullname']) || !isset($_POST['email']) || !isset($_POST['password'])
            || $_POST['fullname'] == '' || $_POST['email'] == '' || $_POST['password'] == ''
            || $_POST['fullname'] == null || $_POST['email'] == null || $_POST['password'] == null
            ) {

            $this->status = 'error';
            $this->status_code = 400;
            $this->message = 'Please fill all fields';
            $this->api_response();
   
        } else {

            $this->model('UsersModel');
            if($this->UsersModel->if_user_exists(trim($_POST['email']))){
                $this->status = 'error';
                $this->status_code = 400;
                $this->message = 'Email already exists';
                $this->api_response();
            }
            $result = $this->UsersModel->new_user(
                trim($_POST['fullname']), 
                trim($_POST['email']),
                md5(trim($_POST['password'])),
            );

            if($result) {
                $this->status = 'success';
                $this->status_code = 200;
                $this->message = 'Register success';
                $this->api_response();
            } else {
                $this->status = 'error';
                $this->status_code = 400;
                $this->message = 'Register failed';
                $this->api_response();
            }
        }
    }

}

class_alias('UsersController', 'users');

?>