<?php
include ("../../Database.php");
$host = "localhost";
$username = "root";
$passwordDb = "";
$databaseName = "oop_app";
$connection = new Database($host, $username, $passwordDb, $databaseName);
$conn = $connection->connect();
class Validation 
{
        public static function sanitize(mixed $input){
            return htmlentities(htmlspecialchars(trim($input)));
        }
        public static function required(mixed $input):bool{
            return empty($input);
        }
        public static function minVal(string $value,int $length){
            return strlen($value) < $length;
        }
        public static function maxVal(string $value,int $length){
            return strlen($value) > $length;
        }
}