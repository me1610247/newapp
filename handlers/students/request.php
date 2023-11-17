<?php

class Request
{
    public static function isPost() : bool
    {
        return $_SERVER['REQUEST_METHOD']=='POST';
    }
    public static function all(){
        return $_REQUEST;
    }
}