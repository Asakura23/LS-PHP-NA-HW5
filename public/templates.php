<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function LoginLinks() {
    if( Auth::check() ) {
        echo 'С возвращением, ' . Auth::user()['name'] . '! <a href="/logout" class="authorization-block__link">Выйти</a>';
        if( Auth::user()['isadmin'] == 1 )
            echo '<a href="/admin" class="authorization-block__link">Админ</a>';
    } else
        echo '<a href="/registration" class="authorization-block__link">Регистрация</a><a href="/login" class="authorization-block__link">Войти</a>';
}

function BasketCount() {
    if( ! Auth::check() )
        echo 0;
    else
        echo DB::table('basket')->where('b_owner', '=', Auth::user()['id'])->count();
}

function LeftMenu() {
    $rows = DB::table('categories')
            ->where('c_deleted', '=', 0)
            ->get();
    foreach( $rows as $key => $r )
        echo '<li class="sidebar-category__item"><a href="/category/'.$r->c_id.'" class="sidebar-category__item__link">'.$r->c_name.'</a></li>';
}

function ShowCategory( $id ) {
    $rows = DB::table('goods')
            ->where('g_cat', '=', $id)
            ->where('g_deleted', '=', 0)
            ->get();
    foreach( $rows as $key => $r )
        print <<<EOF
    <div class="products-category__list__item">
      <div class="products-category__list__item__title-product"><a href="/goods/{$r->g_id}">{$r->g_name}</a></div>
      <div class="products-category__list__item__thumbnail"><a href="/goods/{$r->g_id}" class="products-category__list__item__thumbnail__link"><img src="/img/cover/{$r->g_image}" alt="Preview-image"></a></div>
      <div class="products-category__list__item__description"><span class="products-price">{$r->g_price} руб.</span><a href="/goods/{$r->g_id}" class="btn btn-blue">Купить</a></div>
    </div>
EOF;
}

function ShowGood( $id ) {
    $rows = DB::table('goods')
        ->where('g_id', '=', $id)
        ->get();
    foreach( $rows as $key => $r ) {
        $desc = "<p>" . str_replace( "\n", "</p><p>", $r->g_description ) . "</p>";
        print <<<EOF
    <div class="content-main__container">
      <div class="product-container">
        <div class="product-container__image-wrap"><img src="/img/cover/{$r->g_image}" class="image-wrap__image-product"></div>
        <div class="product-container__content-text">
          <div class="product-container__content-text__title">{$r->g_name}</div>
          <div class="product-container__content-text__price">
            <div class="product-container__content-text__price__value">Цена: <b>{$r->g_price}</b> руб
            </div><a href="/buy/{$r->g_id}" class="btn btn-blue">Купить</a>
          </div>
          <div class="product-container__content-text__description">
            {$desc}
          </div>
        </div>
      </div>
    </div>
EOF;
    }

}

function Adm_CategoryList() {
    $rows = DB::table('categories')->get();
    $ret = "";
    foreach( $rows as $key => $r )
        echo '<a href="/admin/category/'.$r->c_id.'">'.$r->c_name.'</a>'.( $r->c_deleted == 1 ? ' (удалена)' : '' ).'<br />';
}

function Adm_GoodsList() {
    $rows = DB::table('goods')->get();
    $ret = "";
    foreach( $rows as $key => $r )
        echo '<a href="/admin/goods/'.$r->g_id.'">'.$r->g_name.'</a>'.( $r->g_deleted == 1 ? ' (удалена)' : '' ).'<br />';
}

function Adm_CatListSelect( $curr ) {
    $rows = DB::table('categories')->get();
    foreach($rows as $key => $r)
        echo '<option value="'.$r->c_id.'" '.( $r->c_id == $curr ? 'selected' : '' ).'>'.$r->c_name.'</option>';
}

function Adm_ImgListSelect( $curr ) {
    $d = dir(__DIR__."/../img/cover/");
    while( false !== ( $entry = $d->read() ) ) {
        if( $entry != '.' && $entry != '..' )
            echo '<option value="' . $entry . '" ' . ( $entry == $curr ? 'selected' : '' ) . '>' . $entry . '</option>' . "\n";
    }
}

function Adm_BasketList() {
    $rows = DB::table('basket')
        ->join('goods', 'basket.b_good', '=', 'goods.g_id')
        ->orderBy('b_owner')
        ->get();
    $n = 1;
    foreach($rows as $key => $r) {
        echo $n . '. ' . $r->g_name . ' (' . $r->b_email . ')<br />';
        $n++;
    }
}
