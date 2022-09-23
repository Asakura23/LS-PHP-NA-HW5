<?php

class TModule
{
    private $db = null;

    function __construct(&$db) {
        $this->db = $db;
    }

    function execute( $id ) {
        $this->db->clear();
        $this->db->query( array(
            'select'    => "*",
            'from'      => 'goods',
            'where'     => '`g_deleted` = 0 AND `g_id` = ' . $id,
        ) );
        if( $this->db['count'] != 1 ) return "";
        $tpl = <<<EOF
        <div class="product-container">
                <div class="product-container__image-wrap"><img src="/img/cover/{IMG}" class="image-wrap__image-product"></div>
                <div class="product-container__content-text">
                  <div class="product-container__content-text__title">{NAME}</div>
                  <div class="product-container__content-text__price">
                    <div class="product-container__content-text__price__value">
        Цена: <b>{PRICE}</b>
        руб
                    </div><a href="/basket/{ID}" class="btn btn-blue">Купить</a>
                  </div>
                  <div class="product-container__content-text__description">
                    {DESC}
                  </div>
                </div>
              </div>
EOF;
        $_desc = $this->db[0]['g_description'];
        $_desc = str_replace( '\n', '</p><p>', $_desc );
        $desc = '<p>' . $_desc . '</p>';
        $tpl = str_replace( '{ID}', $this->db[0]['g_id'], $tpl );
        $tpl = str_replace( '{IMG}', $this->db[0]['g_image'], $tpl );
        $tpl = str_replace( '{DESC}', $_desc, $tpl );
        $tpl = str_replace( '{NAME}', $this->db[0]['g_name'], $tpl );
        $tpl = str_replace( '{PRICE}', $this->db[0]['g_price'], $tpl );

        return $tpl;
    }
}

?>
