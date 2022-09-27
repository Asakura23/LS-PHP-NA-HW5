<?php

class TModule {
    private $db = null;

    function __construct( &$db ){
        $this->db = $db;
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => "users",
            'where'     => '`name` = "' . $_COOKIE['name'] . '"',
        ) );
/*
        if( $db['count'] != 1 || $_COOKIE['key'] == $db[0]['password'] || $db[0]['isadmin'] == 1 ) {
            header( "Location: /" );
            die();
        }
*/
    }

    function execute( $cat ) {
        $_URL = explode( '/', trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), ' /' ) );
        if( !isset( $_URL[1] ) ) {
            return '<a href="/admin/cats">Редактировать категории</a><br/><a href="/admin/goods">Редактировать товары</a><br/><a href="/admin/baskets">Заказы</a><br/><a href="/admin/notify">Адрес уведомлений</a><br/>';
        }else{
            switch( $_URL[1] ){
                case 'cats':     return $this->edit_cat( $_URL ); break;
                case 'goods':    return $this->edit_good( $_URL ); break;
                case 'baskets':  return $this->baskets( $_URL ); break;
                case 'notify':  return $this->notify( $_URL ); break;
            }
        }
    }

    function edit_cat( $_URL ) {
        if( !isset( $_URL[2] ) ) {
            // Список
            $this->db->clear();
            $this->db->query( array(
                'select'    => "*",
                'from'      => "categories",
            ) );
            $ret = "";
            for( $n = 0; $n < $this->db['count']; $n++ ){
                $ret .= '<a href="/admin/cats/' . $this->db[$n]['c_id'] . '">' . $this->db[$n]['c_name'] . '</a><br/>';
            }
            $ret .= '<br /><br /><a href="/admin/cats/new">Создать новую</a><br/>';
            return $ret;
        }else{
            if( !isset( $_URL[3] ) ) {
                if( is_numeric( $_URL[2] ) ){
                    $this->db->clear();
                    $this->db->query( array(
                        'select'    => "*",
                        'from'      => "categories",
                        'where'     => '`c_id` = ' . $_URL[2],
                    ) );
                    $ret = <<<EOF
Название категории:<br />
<form method="post" action="/admin/cats/{ID}/{KEY}">
<input maxlength="250" name="name" value="{NAME}" /><br /><br />
Описание:<br />
<textarea name="desc" cols="80" rows="20">{DESC}</textarea><br /><br />
<input type="checkbox" name="del" value="true" {CHECK}/> Удалить категорию<br /><br />
<input type="submit" value="Отправить" />
</form>
EOF;
                    $ret = str_replace( '{ID}', $this->db[0]['c_id'], $ret );
                    $ret = str_replace( '{NAME}', $this->db[0]['c_name'], $ret );
                    $ret = str_replace( '{DESC}', $this->db[0]['c_description'], $ret );
                    $ret = str_replace( '{KEY}', sha1( time() ), $ret );
                    $ret = str_replace( '{CHECK}', $this->db[0]['c_deleted'] == 1 ? 'checked' : '', $ret );
                } else {
                    $ret = <<<EOF
Название категории:<br />
<form method="post" action="/admin/cats/new/{KEY}">
<input maxlength="250" name="name" value="" /><br /><br />
Описание:<br />
<textarea name="desc" cols="80" rows="20"></textarea><br /><br />
<input type="submit" value="Отправить" />
</form>
EOF;
                }

                return $ret;
            } else {
                if( is_numeric( $_URL[2] ) ){
                    $this->db->clear();
                    $this->db->query( array(
                        'update'    => "categories",
                        'fields'    => array( 'c_name' => mysql_escape_string( $_POST['name'] ), 'c_description' => mysql_escape_string( $_POST['desc'] ), 'c_deleted' => isset( $_POST['del'] ) ? 1 : 0 ),
                        'where'     => '`c_id` = ' . $_URL[2],
                    ) );
                }else{
                    $this->db->clear();
                    $this->db->query( array(
                        'insert'    => "categories",
                        'fields'    => array( 'c_name', 'c_description' ),
                        'values'    => array( mysql_escape_string( $_POST['name'] ), mysql_escape_string( $_POST['desc'] ) ),
                    ) );
                }
                header( "Location: /admin/cats/" . $_URL[2] );
                die();
            }
        }
    }

    function baskets( $_URL ) {
        $this->db->clear();
        $this->db->query( array(
            'select'    => "b.*, g.*",
            'from'      => array( 'b' => "basket", 'g' => "goods" ),
            'where'     => "`b_good` = `g_id` AND `b_deleted` = 0",
            'order'     => "`b_owner`",
        ) );
        $ret = "";
        for( $n = 0; $n < $this->db['count']; $n++ ) {
            $ret .= $this->db[$n]['b_id'] . '. ' . $this->db[$n]['g_name'] . ' (' . $this->db[$n]['b_email'] . ')<br />';
        }
        return $ret;
    }

    function edit_good( $_URL ) {
        if( !isset( $_URL[2] ) ) {
            // Список
            $this->db->clear();
            $this->db->query( array(
                'select'    => "*",
                'from'      => "goods",
            ) );
            $ret = "";
            for( $n = 0; $n < $this->db['count']; $n++ ){
                $ret .= '<a href="/admin/goods/' . $this->db[$n]['g_id'] . '">' . $this->db[$n]['g_name'] . '</a><br/>';
            }
            $ret .= '<br /><br /><a href="/admin/goods/new">Создать новый</a><br/>';
            return $ret;
        }else{
            if( !isset( $_URL[3] ) ){
                if( is_numeric( $_URL[2] ) ){
                    $ret = <<<EOF
Название товара:<br />
<form method="post" action="/admin/goods/{ID}/{KEY}">
<input maxlength="250" name="name" value="{NAME}" /><br /><br />
Описание:<br />
<textarea name="desc" cols="80" rows="20">{DESC}</textarea><br /><br />
Цена:<br />
<input maxlength="10" name="price" value="{PRICE}" /><br /><br />
Категория:<br />
<select name="cat">
    {CATS}
</select><br /><br />
Изображение:<br />
<select name="img">
    {IMAGES}
</select><br /><br />
<input type="checkbox" name="del" value="true" {CHECK}/> Удалить товар<br /><br />
<input type="submit" value="Отправить" />
</form>
EOF;
                    $this->db->clear();
                    $this->db->query( array(
                        'select'    => "*",
                        'from'      => "goods",
                        'where'     => '`g_id` = ' . $_URL[2],
                    ) );
                    $_name = $this->db[0]['g_name'];
                    $_desc = $this->db[0]['g_description'];
                    $_price = $this->db[0]['g_price'];
                    $_cat = $this->db[0]['g_cat'];
                    $_image = $this->db[0]['g_image'];
                    $_del = $this->db[0]['g_deleted'];

                    $imgs = '<option value="">Выберите из списка</option>' . "\n";
                    $d = dir(__DIR__."/../img/cover/");
                    while( false !== ( $entry = $d->read() ) ) {
                        if( $entry != '.' && $entry != '..' )
                            $imgs .= '<option value="' . $entry . '" ' . ( $entry == $_image ? 'selected' : '' ) . '>' . $entry . '</option>' . "\n";
                    }
                    $this->db->clear();
                    $this->db->query( array(
                        'select'    => "*",
                        'from'      => "categories",
                    ) );
                    $cats = '<option value="-1">Выберите из списка</option>' . "\n";
                    for( $n = 0; $n < $this->db['count']; $n++ )
                        $cats .= '<option value="' . $this->db[$n]['c_id'] . '" ' . ( $this->db[$n]['c_id'] == $_cat ? 'selected' : '' ) . '>' . $this->db[$n]['c_name'] . '</option>' . "\n";

                    $ret = str_replace( '{ID}', $_URL[2], $ret );
                    $ret = str_replace( '{IMAGES}', $imgs, $ret );
                    $ret = str_replace( '{CATS}', $cats, $ret );
                    $ret = str_replace( '{KEY}', sha1( time() ), $ret );
                    $ret = str_replace( '{NAME}', $_name, $ret );
                    $ret = str_replace( '{DESC}', $_desc, $ret );
                    $ret = str_replace( '{PRICE}', $_price, $ret );
                    $ret = str_replace( '{CHECK}', $_del == 1 ? 'checked' : '', $ret );

                    return $ret;
                }else {
                    $ret = <<<EOF
Название товара:<br />
<form method="post" action="/admin/goods/new/{KEY}">
<input maxlength="250" name="name" value="" /><br /><br />
Описание:<br />
<textarea name="desc" cols="80" rows="20"></textarea><br /><br />
Цена:<br />
<input maxlength="10" name="price" value="0" /><br /><br />
Категория:<br />
<select name="cat">
    {CATS}
</select><br /><br />
Изображение:<br />
<select name="img">
    {IMAGES}
</select><br /><br />
<input type="submit" value="Отправить" />
</form>
EOF;
                    $imgs = '<option value="">Выберите из списка</option>';
                    $d = dir(__DIR__."/../img/cover/");
                    while( false !== ( $entry = $d->read() ) ) {
                        if( $entry != '.' && $entry != '..' )
                            $imgs .= '<option value="' . $entry . '">' . $entry . '</option>';
                    }
                    $this->db->clear();
                    $this->db->query( array(
                        'select'    => "*",
                        'from'      => "categories",
                    ) );
                    $cats = '<option value="-1">Выберите из списка</option>';
                    for( $n = 0; $n < $this->db['count']; $n++ )
                        $cats .= '<option value="' . $this->db[$n]['c_id'] . '">' . $this->db[$n]['c_name'] . '</option>';

                    $ret = str_replace( '{IMAGES}', $imgs, $ret );
                    $ret = str_replace( '{CATS}', $cats, $ret );
                    $ret = str_replace( '{KEY}', sha1( time() ), $ret );
                }
                return $ret;
            }else{
                if( is_numeric( $_URL[2] ) ){
                    $this->db->clear();
                    $this->db->query( array(
                        'update'    => "goods",
                        'fields'    => array( 'g_name' => $_POST['name'], 'g_cat' => $_POST['cat'], 'g_image' => $_POST['img'], 'g_price' => $_POST['price'], 'g_description' => mysql_escape_string( $_POST['desc'] ), 'g_deleted' => isset( $_POST['del'] ) ? 1 : 0 ),
                        'where'     => '`g_id` = ' . $_URL[2],
                    ) );
                    header( "Location: /admin/goods/" . $_URL[2] );
                    die();
                }else {
                    $this->db->clear();
                    $this->db->query( array(
                        'insert'    => "goods",
                        'fields'    => array( 'g_name', 'g_cat', 'g_image', 'g_price', 'g_description' ),
                        'values'    => array( $_POST['name'], $_POST['cat'], $_POST['img'], $_POST['price'], mysql_escape_string( $_POST['desc'] ) ),
                    ) );
                    header( "Location: /admin/goods" );
                    die();
                }
            }
        }
    }

    function notify( $_URL ) {
        if( !isset( $_URL[2] ) ) {
            $ret = <<<EOF
Адрес уведомлений:<br />
<form method="post" action="/admin/notify/{KEY}">
<input maxlength="250" name="email" value="{EMAIL}" /><br /><br />
<input type="submit" value="Отправить" />
</form>
EOF;
            $mail = "";
            if( file_exists( __DIR__ . '/../notify.mail' ) )
                $mail = file_get_contents( __DIR__ . '/../notify.mail' );
            $ret = str_replace( '{EMAIL}', $mail, $ret );
            return $ret;
        }else{
            file_put_contents( __DIR__ . '/../notify.mail', $_POST['email'] );
            header( "Location: /admin/notify" );
            die();
        }
    }
}

?>
