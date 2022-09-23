<?php

class TModule {
    private $db = null;

    function __construct( &$db ){
        $this->db = $db;
    }

    function execute( $none = 1 ) {
        if( $none != 1 ) return $this->finish();
        $tpl = <<<EOF
<form method="post" action="/login/{KEY}" >
    Введите логин:<br />
    <input name="login" maxlength="150" /> <br />
    Введите пароль:<br />
    <input name="pass" maxlength="150" type="password" /> <br />
    <p align="center"><input type="submit" value="Отправить"></p>
</form>
EOF;
        $tpl = str_replace( '{KEY}', sha1( time() ), $tpl );
        return $tpl;
    }

    function finish() {
        if( preg_match( '#[^A-z,a-z,0-9,_]#si', $_POST['login'] ) ) return "Логин содержит недопустимые символы";
        if( strlen( $_POST['login'] ) < 4 ) return "Слишком короткий логин";
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => "users",
            'where'     => '`name` = "' . $_POST['login'] . '"',
        ) );
        if( $this->db['count'] != 1 ) return "Ошибка авторизации";
        if( sha1( $_POST['pass'] ) != $this->db[0]['password'] ) return "Ошибка авторизации";

        setcookie( 'name', $this->db[0]['name'], time()+3600, "/", "azzl.su" );
        setcookie( 'key', $this->db[0]['password'], time()+3600, "/", "azzl.su" );
        setcookie( 'name', $this->db[0]['name'], time()+3600, "/", "localhost" );
        setcookie( 'key', $this->db[0]['password'], time()+3600, "/", "localhost" );

        return "Авторизация успешна!";
    }
}

?>
