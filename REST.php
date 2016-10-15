<?php

class REST
{

    function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    function getInput(){
        $input = null;

        switch(self::getMethod()){
            case "POST":
                $input = self::clean($_POST);
                break;

            case "GET":
                $input = self::clean($_GET);
                break;

            case "DELETE":
                $input = self::clean($_GET);
                break;
        }

        return $input;
    }

    function clean($input){
        $output = array();

        if(is_array($input)){
            foreach($input AS $key => $val){
                $output[$key] = self::clean($val);
            }
        }else{
            $output = trim(htmlspecialchars($input));
        }

        return $output;
    }

}