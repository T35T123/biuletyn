<?php

    require_once(__DIR__.'/../database/dbutils.php');

    class Account{

        private $_login;
        private $_password;

        private $_error;

        public function __construct($login, $password){

            $this->_error = 'Login or password is incorrect.';

            $this->_login = $login;
            $this->_password = $password;
        }

        public function login(){
            $result = DbUtils::executeQuery('select * from user where login="%s"', [$this->_login]);
            if(!$result->num_rows) throw new Exception($this->_error);
            else{
                $row = mysqli_fetch_assoc($result);
                if(!password_verify($this->_password, $row['password'])){
                    throw new Exception($this->_error);
                }else{
                    session_start();
                    $_SESSION['active'] = true;
                    header('Location: /panel');
                }
            }
        }

    }

?>
