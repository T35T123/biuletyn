<?php

    require_once(__DIR__.'/user/register.php'); //
    require_once(__DIR__.'/user/account.php'); //


    class Validation{

        protected function __construct(){}

        protected function __clone(){}

        protected static function normalize($data){

            return htmlentities($data, ENT_QUOTES, 'utf-8');

        }

    }

    class RegisterValidation extends Validation{

        private static $_login, $_password, $_password_confirm; 

        public static function validate($l, $p, $c){

            self::$_login = parent::normalize($l);
						self::$_password = parent::normalize($p);
						self::$_password_confirm = parent::normalize($c);

            try{
                self::_isLoginSet($l);
                self::_isPasswordSet($p);
                self::_arePasswordsSame($p, $c);
                self::_isPasswordStrong($p);
                self::_isLoginTooLong($l);
                self::_areInputsCorrect([$l,$p]);

                $register = new Register(self::$_login, self::$_password);
                $register->isExistUserWithLogin();
								$register->addUserToDatabase();

            }catch(Exception $e){
               header("Location: /panel?err=".$e->getMessage()); 
            }

        }

        private static function _isLoginTooLong($l){
            if(strlen($l) > 30){
                throw new Exception("Login is too long! (max 20 letters)");
            }
        }

        private static function _isLoginSet($l){
            if(!strlen($l)){
                throw new Exception("Login isn't set!");
            }
        }

        private static function _isPasswordSet($p){
             if(!strlen($p)){
                throw new Exception("Password isn't set!");
             }
        }

        private static function _arePasswordsSame($p, $c){
            if($p != $c){
                throw new Exception("Passwords aren't same!");
            }
        }

        private static function _isPasswordStrong($p){
            if(strlen($p) < 8){
                throw new Exception('Password must have min. 8 letters!');
            }
        }

        private static function _areInputsCorrect($inputs){
            foreach($inputs as $input){
                $correct = false;
                for($i=0; $i<strlen($input); $i++){
                   if($input[$i] != ' ') $correct = true;
                }
                if(!$correct){
                    throw new Exception("Input must includes only characters, no whitespaces!");
                }
            }
        }

    }

    class LoginValidation extends Validation {

        private static $_error_count, $_login, $_password;

        public static function validate($l, $p){
            self::$_login = parent::normalize($l);
            self::$_password = parent::normalize($p);

            try{
                self::_tryLogin();
            }catch(Exception $e){
                return $e->getMessage();
            }

        }

        private static function _tryLogin(){
            $account = new Account(self::$_login, self::$_password);
            $account->login();
        }

    }

?>
