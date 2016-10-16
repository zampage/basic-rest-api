<?php

/**
 * Class REST
 * Allows API to extend this set of tools for parsing requests
 *
 * @author Markus Chiarot, zampage.com
 *
 */

class REST
{

    /**
     * gets the request method
     *
     * @return string
     */
    function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * gets request input
     *
     * @return array|string
     */
    function getInput(){
        $input = "";

        switch(self::getMethod()){
            case "POST":
                $input = $this->clean($_POST);
                break;

            case "GET":
                $input = $this->clean($_GET);
                break;

            case "DELETE":
                $input = $this->clean($_GET);
                break;
        }

        return $input;
    }

    /**
     * gets response code from codetable
     *
     * @param int $num response code
     * @return array
     */
    function getCode($num){
        $codes = array(
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            404 => 'Not Found',
            406 => 'Not Acceptable',
            500 => 'Internal Server Error'
        );
        return (array_key_exists($num, $codes)) ? array($num, $codes[$num]) : array(500, $codes[500]);
    }

    /**
     * handles a request and forwards it to function
     */
    function process(){
        $func = strtolower(trim(str_replace("/","",$_REQUEST['x'])));
        ((int)method_exists($this, $func) > 0) ? $this->$func() : $this->respond('', 404);
    }

    /**
     * cleans request input
     *
     * @param array|string $input input which needs to be cleaned
     * @return array|string
     */
    function clean($input){
        $output = array();

        if(is_array($input)){
            foreach($input AS $key => $val){
                $output[$key] = $this->clean($val);
            }
        }else{
            $output = trim(htmlspecialchars($input));
        }

        return $output;
    }

    /**
     * creates a response and sends it
     *
     * @param mixed $data data which will be sent
     * @param int $code the response code
     */
    function respond($data, $code){
        $code = $this->getCode($code);
        header("HTTP/1.1 " . $code[0] . " " . $code[1]);
        header("Content-Type:application/json");
        echo json_encode($data);
        exit;
    }

}