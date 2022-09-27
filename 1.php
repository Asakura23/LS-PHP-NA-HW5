<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
})->name('home');

/* ---------------------------------
    Авторизация / регистрация
--------------------------------- */
Route::get('/dashboard', function () {
    if( Auth::check() ) return redirect()->route('home');
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/login', function() {
    return view('dashboard');
})->name('login');

Route::get('/registration', function() {
    return view('register');
})->name('registration');

Route::get('/logout', function() {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

/* ---------------------------------
    Страницы каталога
--------------------------------- */

Route::get('/category/{number?}', function($number){
    return view('category',['ID'=>$number]);
})->where('number', '[0-9]+')->name('category');

Route::get('/goods/{number?}', function($number){
    return view('goods',['ID'=>$number]);
})->where('number', '[0-9]+')->name('goods');

Route::get('/buy/{number?}', function($number){
    if( !Auth::check() ) return redirect()->route('login');
    DB::table('basket')->insert( array(
        'b_owner'   => Auth::user()['id'],
        'b_good'    => $number,
        'b_email'   => Auth::user()['email']
    ) );
    $mail = "";
    if( file_exists( __DIR__ . '/../.notify' ) )
        $mail = file_get_contents( __DIR__ . '/../.notify' );
    if( strlen($mail) > 0 )
        Mail::to($mail)->send(new OrderShipped());
    return redirect()->route('goods', [$number]);
});

/* ---------------------------------
    Админка
--------------------------------- */

Route::get('/admin', function() {
    return view('admin.empty');
})->middleware(['auth'])->name('admin');

// -------------------------
//  Категории
Route::get('/admin/category/list', function() {
    return view('admin.catlist');
})->middleware(['auth'])->name('acatsl');

Route::get('/admin/category/{number?}', function($number) {
    $data = DB::table('categories')->where('c_id', '=', $number)->get();
    foreach($data as $key => $r)
        return view('admin.catedit',
                            [ 'ID'      => $r->c_id,
                              'NAME'    => $r->c_name,
                              'DESC'    => $r->c_description,
                              'CHECK'   => $r->c_deleted == 1 ? ' checked' : '',
                            ]);
})->middleware(['auth'])->where('number', '[0-9]+')->name('acats');

Route::post('/admin/category/edit/{number?}', function($number) {
    DB::table('categories')
        ->where('c_id', $number)
        ->update([
            'c_name'        => $_POST['name'],
            'c_description' => $_POST['desc'],
            'c_deleted'     => isset( $_POST['del'] ) ? 1 : 0
        ]);
    return redirect()->route('acatsl');
})->middleware(['auth'])->where('number', '[0-9]+')->name('acatse');
// -------------------------

// -------------------------
//  Товары
Route::get('/admin/goods/list', function() {
    return view('admin.goodlist');
})->middleware(['auth'])->name('agoodsl');

Route::get('/admin/goods/{number?}', function($number) {
    $data = DB::table('goods')->where('g_id', '=', $number)->get();
    foreach($data as $key => $r)
        return view('admin.goodedit',[
            'ID'        => $number,
            'NAME'      => $r->g_name,
            'DESC'      => $r->g_description,
            'PRICE'     => $r->g_price,
            'IMG'       => $r->g_image,
            'CHECK'     => $r->g_deleted == 1 ? ' checked' : '',
        ]);
})->middleware(['auth'])->where('number', '[0-9]+')->name('agoods');

Route::post('/admin/goods/edit/{number?}', function($number) {
    DB::table('goods')
        ->where('g_id', $number)
        ->update([
            'g_name'        => $_POST['name'],
            'g_description' => $_POST['desc'],
            'g_price'       => $_POST['price'],
            'g_cat'         => $_POST['cat'],
            'g_image'       => $_POST['img'],
            'g_deleted'     => isset( $_POST['del'] ) ? 1 : 0
        ]);
    return redirect()->route('agoodsl');
})->middleware(['auth'])->where('number', '[0-9]+')->name('agoodse');
// -------------------------

Route::get('/admin/basket', function() {
    return view('admin.basketlist');
})->middleware(['auth'])->name('abasket');

Route::get('/admin/email', function() {
    $mail = "";
    if( file_exists( __DIR__ . '/../.notify' ) )
        $mail = file_get_contents( __DIR__ . '/../.notify' );
    return view('admin.email', ['EMAIL' => $mail]);
})->middleware(['auth'])->name('aemail');

Route::post('/admin/email/edit', function() {
    file_put_contents( __DIR__ . '/../.notify', $_POST['email'] );
    return redirect()->route('aemail');
})->middleware(['auth'])->name('aemaile');
