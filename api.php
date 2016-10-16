<?php

/*
 * import REST class
 */
require_once('REST.php');

/**
 * Class API
 * lets you handle API requests
 *
 * @author Markus Chiarot, zampage.com
 */
class API extends REST
{

    /**
     * API constructor.
     * immediately starts to process the request
     */
    function __construct(){
        $this->process();
    }

    /**
     * custom request function
     */
    function customers(){

        /*
         * data table
         */
        $customers = array(
            "Markus Chiarot",
            "Max Muster",
            "Yet Another Person"
        );

        /*
         *
         */
        $this->respond($customers, 200);

    }

    /**
     * another custom request function
     */
    function password(){

        /*
         * check if a specific method is used
         */
        if( $this->isMethod('GET') ){
            $this->respond('supersecretpassword', 200);
        }

        /*
         * if the wrong method is used deny the request with code 406
         */
        $this->respond('You are not allowed to set/update/delete the password!', 406);

    }

}

/*
 * init API
 */
new API();