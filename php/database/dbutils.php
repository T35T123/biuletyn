<?php

//    require_once(__DIR__.'/dbinfo.php');

    class DbUtils{

        private function __construct(){}

				private function __clone(){}

				private static $insertId;

        public static function executeQuery($sql, $args, $database='biuletyn'){
            
	
	$IP = "127.0.0.1";
	$USER = "root";
	$PASSWORD = "ZSTInfo-2018#";

	try{
                $conn = new mysqli($IP, $USER, $PASSWORD, $database);
								$conn->set_charset('utf8');
								self::sql_normalize($args, $conn);
                if($conn->connect_errno!=0){
                    throw new Exception(mysqli_connect_errno());
                }else{
                    $result = $conn->query(vsprintf($sql, $args));
										self::$insertId = $conn->insert_id;
										$conn->close();
                    return $result;
                }
            }catch(Exception $e){
                //obsulga bledu
            }

				}

				public static function getInsertId(){

					return self::$insertId;

				}

        private static function sql_normalize(&$args, $mysqli){
            for($i=0; $i<count($args); $i++){
                $args[$i] = $mysqli->real_escape_string($args[$i]);
            }
        }

    }

?>
