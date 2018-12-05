<?php

    require_once(__DIR__.'/dbinfo.php');

    class DbUtils{

        private function __construct(){}

        private function __clone(){}

        public static function executeQuery($sql, $args, $database='biuletyn'){
            try{
                $conn = new mysqli(DbInfo::IP, DbInfo::USER, DbInfo::PASSWORD, $database);
								$conn->set_charset('utf8');
								self::sql_normalize($args, $conn);
                if($conn->connect_errno!=0){
                    throw new Exception(mysqli_connect_errno());
                }else{
                    $result = $conn->query(vsprintf($sql, $args));
                    $conn->close();
                    return $result;
                }
            }catch(Exception $e){
                //obsulga bledu
            }

        }

        private static function sql_normalize(&$args, $mysqli){
            for($i=0; $i<count($args); $i++){
                $args[$i] = $mysqli->real_escape_string($args[$i]);
            }
        }

    }

?>
