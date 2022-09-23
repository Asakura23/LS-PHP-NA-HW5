<?php

class TModule {
    private $db = null;

    function __construct( &$db ){
        $this->db = $db;
    }

    function execute( $cat ) {
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => 'goods',
            'where'     => '`g_deleted` = 0 AND `g_cat` = ' . $cat,
        ) );
        $ret = "";
        for( $n = 0; $n < $this->db['count']; $n++ ) {
            $tpl = <<<EOF
<div class="products-columns__item">
<div class="products-columns__item__title-product"><a href="/goods/{ID}" class="products-columns__item__title-product__link">{NAME}</a></div>
<div class="products-columns__item__thumbnail"><a href="/goods/{ID}" class="products-columns__item__thumbnail__link"><img src="/img/cover/{IMG}" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
<div class="products-columns__item__description"><span class="products-price">{PRICE} руб</span><a href="/goods/{ID}" class="btn btn-blue">Купить</a></div>
</div>
EOF;
            $tpl = str_replace( '{ID}', $this->db[$n]['g_id'], $tpl );
            $tpl = str_replace( '{NAME}', $this->db[$n]['g_name'], $tpl );
            $tpl = str_replace( '{PRICE}', $this->db[$n]['g_price'], $tpl );
            $tpl = str_replace( '{IMG}', $this->db[$n]['g_image'], $tpl );
            $ret .= $tpl;
        }
        return '<div class="products-category__list">' . $ret . '</div>';
    }
}

?>

