<?php

    require_once(__DIR__.'/../database/dbutils.php');

    class Register{

        private $_login;
        private $_password;

        public function __construct($l, $n, $p){
            $this->_login = $l;
            $this->_password = $p;
            $this->_hashPassword();
        }

        private function _hashPassword(){
            $this->_password = password_hash($this->_password, PASSWORD_DEFAULT);
        }

        public function isExistUserWithLogin(){
            $result = DbUtils::executeQuery('select login from user where login="%s"', [$this->_login]);
            if(!!$result->num_rows) throw new Exception("User with this login already exist!");
        }

        public function addUserToDatabase(){
            $result = DbUtils::executeQuery('insert into user(login,password) values("%s", "%s")', [$this->_login, $this->_password]);
            if($result){
                session_start();
            }else{
                throw new Exception('Database error, please register when we resolve problem.');
            }
        }

    }

?>
