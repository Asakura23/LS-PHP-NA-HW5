<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

ini_set('display_errors', 'Off');
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

require_once __DIR__.'/MySQL.php';
$db = new TSimpleDB( array( "host" => "192.168.0.1", "user" => "laravel", "pass" => "laravel", "dbase" => "laravel" ) );

$_AUTH = '<div class="authorization-block"><a href="{URL}register" class="authorization-block__link">Регистрация</a><a href="{URL}login" class="authorization-block__link">Войти</a></div>';
$_ADM = "";
$_COUNT = 0;
if( isset( $_COOKIE['name'] ) ) {
    if( !preg_match( '#[^A-z,a-z,0-9,_]#si', $_COOKIE['name'] ) ) {
        $db->query( array(
            'select'    => "*",
            'from'      => "users",
            'where'     => '`name` = "' . $_COOKIE['name'] . '"',
        ) );
        if( $db['count'] == 1 ) {
            if( $_COOKIE['key'] == $db[0]['password'] ) {
                $_AUTH = "Добро пожаловать";
                setcookie( 'name', $_COOKIE['name'], time()+3600, "/", "azzl.su" );
                setcookie( 'key', $_COOKIE['key'], time()+3600, "/", "azzl.su" );
                setcookie( 'name', $_COOKIE['name'], time()+3600, "/", "localhost" );
                setcookie( 'key', $_COOKIE['key'], time()+3600, "/", "localhost" );
                if( $db[0]['isadmin'] == 1 ) $_ADM = '<li class="nav-list__item"><a href="{URL}admin" class="nav-list__item__link">Управление</a></li>';
                $db->clear();
                $db->query( array(
                    'select'    => "*",
                    'from'      => "basket",
                    'where'     => '`b_owner` = "' . $db[0]['id'] . '"',
                ) );
                $_COUNT = $db['count'];
            }
        }
    }
}

$url_path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$_URL = explode( '/', trim( $url_path, ' /' ) );
$_CONTENT = "";
if( $_URL[0] != "" ) {
    if( file_exists( __DIR__.'/../public/' . $_URL[0] . '.php' ) ) {
        require_once __DIR__.'/../public/' . $_URL[0] . '.php';
        $_MOD = new TModule( $db );
        $_CONTENT = $_MOD->execute( isset( $_URL[1] ) ? $_URL[1] : 1 );
    }
}
$_MENU = "";
$db->clear();
$db->query( array(
    'select'    => "*",
    'from'      => 'categories',
    'where'     => '`c_deleted` = 0',
) );
for( $n = 0; $n < $db['count']; $n++ ) {
    $tpl = '<li class="sidebar-category__item"><a href="/category/{ID}" class="sidebar-category__item__link">{NAME}</a></li>';
    $tpl = str_replace( '{ID}', $db[$n]['c_id'], $tpl );
    $tpl = str_replace( '{NAME}', $db[$n]['c_name'], $tpl );
    $_MENU .= $tpl;
}

$_TEMPLATE = file_get_contents( __DIR__ . '/../index.html' );
$_TEMPLATE = str_replace( '{AUTH}', $_AUTH, $_TEMPLATE );
$_TEMPLATE = str_replace( '{ADM}', $_ADM, $_TEMPLATE );
$_TEMPLATE = str_replace( '{COUNT}', $_COUNT, $_TEMPLATE );
$_TEMPLATE = str_replace( '{URL}', "/", $_TEMPLATE );
$_TEMPLATE = str_replace( '{MENU}', $_MENU, $_TEMPLATE );
$_TEMPLATE = str_replace( '{CONTENT}', $_CONTENT, $_TEMPLATE );

//print_r( $_SERVER );
print $_TEMPLATE;

//$response = $kernel->handle(
    //$request = Request::capture()
//)->send();

//$kernel->terminate($request, $response);
