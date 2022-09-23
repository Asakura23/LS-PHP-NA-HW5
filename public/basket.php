<?php

class TModule
{
    private $db = null;

    function __construct( &$db ) {
        $this->db = $db;
    }

    function execute( $id ) {
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => "users",
            'where'     => '`name` = "' . $_COOKIE['name'] . '"',
        ) );
        print '"' . $_COOKIE['name'] . '"';
        $this->db->clear();
        $this->db->query( array(
            'insert'    => "basket",
            'fields'    => array( 'b_owner', 'b_good', 'b_email' ),
            'values'    => array( $this->db[0]['id'], $id, $this->db[0]['email'] ),
        ) );
        header( "Location: /goods/" . $id );
        die();
    }

}
