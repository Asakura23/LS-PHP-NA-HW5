<?php

class TModule {
    private $db = null;

    function __construct( &$db ){
        $this->db = $db;
    }

    function execute( $none = 1 ) {
        if( $none != 1 ) return $this->finish();
        $tpl = <<<EOF
<form method="post" action="/register/{KEY}" >
    Введите логин:<br />
    <input name="login" maxlength="150" /> <br />
    Введите EMail:<br />
    <input name="mail" maxlength="150" /> <br />
    Введите пароль:<br />
    <input name="pass" maxlength="150" type="password" /> <br />
    Повторите пароль:<br />
    <input name="pass1" maxlength="150" type="password" /> <br />
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
        if( $this->db['count'] > 0 ) return "Такой логин уже зарегистрирован";
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => "users",
            'where'     => '`name` = "' . $_POST['login'] . '"',
        ) );
        if( $this->db['count'] > 0 ) return "Такой логин уже зарегистрирован";

        if( preg_match( '#[^A-z,a-z,0-9,_,\.,@]#si', $_POST['mail'] ) ) return "EMail содержит недопустимые символы";
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => "users",
            'where'     => '`email` = "' . $_POST['mail'] . '"',
        ) );
        if( $this->db['count'] > 0 ) return "Такой EMail уже зарегистрирован";

        if( $_POST['pass'] != $_POST['pass1'] ) return "Указанные пароли должны совпадать";

        $this->db->clear();
        $this->db->query( array(
            'insert'    => "users",
            'fields'    => array( 'name', 'email', 'password' ),
            'values'    => array( $_POST['login'], $_POST['mail'], sha1( $_POST['pass'] ) ),
        ) );
        return "Регистрация успешна!";
    }
}

?>
