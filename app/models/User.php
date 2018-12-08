<?php
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function login($username, $password){
            $this->db->query('SELECT * FROM user WHERE username = :username');
            $this->db->bind(':username', $username);

            $row = $this->db->single();

            $hashed_password = $row->password;

            $password_hash = md5($password);
            
            if($password_hash == $hashed_password){
                return $row;
            } else {
                return False;
            }
        }
    }