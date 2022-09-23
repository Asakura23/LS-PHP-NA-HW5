<?php

class TModule {
    private $db = null;

    function __construct( &$db ){
        $this->db = $db;
    }

    function execute( $cat ) {
        $_URL = explode( '/', trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), ' /' ) );
        
    }
}

?>
