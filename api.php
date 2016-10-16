<?php

require_once('REST.php');

class API extends REST
{

    function __construct(){
        $this->process();
    }

    function customer(){
        $c = array(
            "Markus Chiarot",
            "Max Muster",
            "Yet Another Person"
        );
        $this->respond($c, 200);
    }

}

new API();