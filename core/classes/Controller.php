<?php

/**
 * Controller
 *
 * @package CRUD MVC OOP PDO
 * @link    https://github.com/utoyvo/crud-mvc-oop-pdo/blob/master/core/classes/Controller.php
 */

abstract class Controller
{
    protected static $token = TOKEN;
    protected $status;
    protected $status_code;
    protected $message;
    protected $data;

    private $route  = [];
    private $args   = 0;
    private $params = [];

    function __construct()
    {
        // $this->accept_type();
        $this->request_token(self::$token);

        $this->route = explode('/', URI);
        $this->args  = count($this->route);
        $this->router();
    }

    /**
     * Index
     */
    abstract function index();

    /**
     * Router
     */
    private function router(): void
    {
        if (class_exists($this->route[1])) {
            if ($this->args >= 3) {
                if (method_exists($this, $this->route[2])) {
                    $this->uriCaller(2, 3);
                } else {
                    $this->uriCaller(0, 2);
                }
            } else {
                $this->uriCaller(0, 2);
            }
        } else {
            if ($this->args >= 2) {
                if (method_exists($this, $this->route[1])) {
                    $this->uriCaller(1, 2);
                } else {
                    $this->uriCaller(0, 1);
                }
            } else {
                $this->uriCaller(0, 1);
            }
        }
    }

    /**
     * UriCaller
     */
    private function uriCaller(int $method, int $param): void
    {
        for ($i = $param; $i < $this->args; $i++) {
            $this->params[$i] = $this->route[$i];
        }

        if ($method === 0) {
            call_user_func_array(array($this, 'index'), $this->params);
        } else {
            call_user_func_array(array($this, $this->route[$method]), $this->params);
        }
    }

    /**
     * Model
     */
    public function model(string $path): void
    {
        $class = explode('/', $path);
        $class = $class[count($class) - 1];
        // $path  = strtolower($path);

        require(ROOT . '/app/models/' . $path . '.php');

        $this->$class = new $class;
    }

    /**
     * View
     */
    public function view(string $path, array $data = []): void
    {
        if (is_array($data)) {
            extract($data);
        }
        $path = strtolower($path);
        require(ROOT . '/app/views/template/header.php');
        require(ROOT . '/app/views/' . $path . '.php');
        require(ROOT . '/app/views/template/footer.php');
    }

    public function adminView(string $path, array $data = []): void
    {
        if (is_array($data)) {
            extract($data);
        }
        $path = strtolower($path);
        require(ROOT . '/app/views/template/adminHeader.php');
        require(ROOT . '/app/views/template/sidenav.php');
        require(ROOT . '/app/views/template/navbar.php');
        require(ROOT . '/app/views/' . $path . '.php');
        require(ROOT . '/app/views/template/adminFooter.php');
    }


    protected function request_token($token) {
        $headers = apache_request_headers();
        //read Authorization or authorization header
        if(isset($headers['Authorization'])) {
            $access_token = $headers['Authorization'];
        } else if(isset($headers['authorization'])) {
            $access_token = $headers['authorization'];
        } else {
            $access_token = '';
        }

        if($access_token == '') {
            $this->status = 'error';
            $this->status_code = 401;
            $this->message = 'Access token required';
            $this->api_response();
        }

        if($access_token != $token) {
            $this->status = 'error';
            $this->status_code = 401;
            $this->message = 'Invalid access token';
            $this->api_response();
        }
    }

    protected function accept_type() {
        $headers = apache_request_headers();
        
        if(isset($headers['Accept'])) {
            $accept_type = $headers['Accept'];
        } else if(isset($headers['accept'])) {
            $accept_type = $headers['accept'];
        } else {
            $accept_type = '';
        }

        if($accept_type != 'application/json') {
            $this->status = 'error';
            $this->status_code = 406;
            $this->message = 'Accept type not allowed';
            $this->api_response();
        }
    }

    protected function check_method($method) {
        if($_SERVER['REQUEST_METHOD'] != $method) {
            $this->status = 'error';
            $this->status_code = 405;
            $this->message = 'Method not allowed';
            $this->api_response();
        }
    }
 
    protected function api_response() {
        $response = array(
            'status' => $this->status,
            'status_code' => $this->status_code,
            'message' => $this->message,
            'data' => $this->data
        );

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}