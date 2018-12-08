<?php
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'user_err' => '',
                    'pass_err' => ''
                ];

                if(empty($data['username'])){
                    $data['user_err'] = 'Masukkan Username';
                }

                if(empty($data['password'])){
                    $data['pass_err'] = 'Masukkan Password';
                }

                if(empty($data['user_err']) && empty($data['pass_err'])){
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['pass_err'] = 'Password Salah';

                        $this->view('users/login', $data);
                    }
                }else{
                    $this->view('users/login', $data);
                }
            }else{
                $data = [
                    'username' => '',
                    'password' => '',
                    'user_err' => '',
                    'pass_err' => ''
                ];

                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['username'] = $user->username;
            $_SESSION['status'] = $user->status;
            redirect('pages/index');
        }

        public function logout(){
            unset($_SESSION['id_user']);
            unset($_SESSION['username']);
            unset($_SESSION['status']);
            session_destroy();
            redirect('users/login');
        }
    }