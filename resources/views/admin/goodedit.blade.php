<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>ГеймсМаркет - Авторизация</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ url('/') }}/css/libs.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/main.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/media.css">
  </head>
  <body>
    <div class="main-wrapper">
      <header class="main-header">
        <div class="logotype-container"><a href="{{ url('/') }}" class="logotype-link"><img src="{{ url('/') }}/img/logo.png" alt="Логотип"></a></div>
        <nav class="main-navigation">
          <ul class="nav-list">
            <li class="nav-list__item"><a href="{{ url('/') }}" class="nav-list__item__link">Главная</a></li>
            <li class="nav-list__item"><a href="{{ url('/') }}" class="nav-list__item__link">Мои заказы</a></li>
            <li class="nav-list__item"><a href="{{ url('/') }}" class="nav-list__item__link">Новости</a></li>
            <li class="nav-list__item"><a href="{{ url('/') }}" class="nav-list__item__link">О компании</a></li>
          </ul>
        </nav>
        <div class="header-contact">
          <div class="header-contact__phone"><a href="{{ url('/') }}" class="header-contact__phone-link">Телефон: 33-333-33</a></div>
        </div>
        <div class="header-container">
          <div class="payment-container">
            <div class="payment-basket__status">
              <div class="payment-basket__status__icon-block"><a class="payment-basket__status__icon-block__link"><i class="fa fa-shopping-basket"></i></a></div>
              <div class="payment-basket__status__basket"><span class="payment-basket__status__basket-value">{{ BasketCount() }}</span><span class="payment-basket__status__basket-value-descr">товаров</span></div>
            </div>
          </div>
            <div class="authorization-block">{{ LoginLinks() }}</div>
        </div>
      </header>
      <div class="middle">
        <div class="sidebar">
          <div class="sidebar-item">
            <div class="sidebar-item__title">Категории</div>
            <div class="sidebar-item__content">
              <ul class="sidebar-category">
                {{ LeftMenu() }}
              </ul>
            </div>
          </div>
          <div class="sidebar-item">
            <div class="sidebar-item__title">Последние новости</div>
            <div class="sidebar-item__content">
              <div class="sidebar-news">
                <div class="sidebar-news__item">
                  <div class="sidebar-news__item__preview-news"><img src="{{ url('/') }}/img/cover/game-2.jpg" alt="image-new" class="sidebar-new__item__preview-new__image"></div>
                  <div class="sidebar-news__item__title-news"><a href="{{ url('/') }}/#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a></div>
                </div>
                <div class="sidebar-news__item">
                  <div class="sidebar-news__item__preview-news"><img src="{{ url('/') }}/img/cover/game-1.jpg" alt="image-new" class="sidebar-new__item__preview-new__image"></div>
                  <div class="sidebar-news__item__title-news"><a href="{{ url('/') }}/#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a></div>
                </div>
                <div class="sidebar-news__item">
                  <div class="sidebar-news__item__preview-news"><img src="{{ url('/') }}/img/cover/game-4.jpg" alt="image-new" class="sidebar-new__item__preview-new__image"></div>
                  <div class="sidebar-news__item__title-news"><a href="{{ url('/') }}/#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="main-content">

            <div id="adm-menu" style="float: left; width: 210px; border-right: #9ca3af 1px solid;">
                <div class="sidebar-item__content">
                    <ul class="sidebar-category">
                        <li class="sidebar-category__item" style="width: 200px;"><a href="{{ route('acatsl') }}" class="sidebar-category__item__link" style="font-size: 16px;">Категории</a></li>
                        <li class="sidebar-category__item" style="width: 200px;"><a href="{{ route('agoodsl') }}" class="sidebar-category__item__link" style="font-size: 16px;">Товары</a></li>
                        <li class="sidebar-category__item" style="width: 200px;"><a href="{{ route('abasket') }}" class="sidebar-category__item__link" style="font-size: 16px;">Заказы</a></li>
                        <li class="sidebar-category__item" style="width: 200px;"><a href="{{ route('aemail') }}" class="sidebar-category__item__link" style="font-size: 16px;">Адрес уведомлений</a></li>
                    </ul>
                </div>
            </div>
            <div id="adm-content" style="float: left; width: 500px; padding-left: 20px; padding-top: 7px;">
                Название товара:<br />
                <form method="post" action="/admin/goods/edit/{{$ID}}">
                    @csrf
                    <input maxlength="250" name="name" value="{{$NAME}}" /><br /><br />
                    Описание:<br />
                    <textarea name="desc" cols="80" rows="20">{{$DESC}}</textarea><br /><br />
                    Цена:<br />
                    <input maxlength="10" name="price" value="{{$PRICE}}" /><br /><br />
                    Категория:<br />
                    <select name="cat">
                        {{Adm_CatListSelect($ID)}}
                    </select><br /><br />
                    Изображение:<br />
                    <select name="img">
                        {{Adm_ImgListSelect($IMG)}}
                    </select><br /><br />
                    <input type="checkbox" name="del" value="true" {{$CHECK}}/> Удалить товар<br /><br />
                    <input type="submit" value="Отправить" />
                </form>
			</div>

        </div>
      </div>
      <footer class="footer">
        <div class="footer__footer-content">
          <div class="random-product-container">
            <div class="random-product-container__head">Случайный товар</div>
            <div class="random-product-container__content">
              <div class="item-product">
                <div class="item-product__title-product"><a href="{{ url('/') }}/#" class="item-product__title-product__link">The Witcher 3: Wild Hunt</a></div>
                <div class="item-product__thumbnail"><a href="{{ url('/') }}/#" class="item-product__thumbnail__link"><img src="{{ url('/') }}/img/cover/game-1.jpg" alt="Preview-image" class="item-product__thumbnail__link__img"></a></div>
                <div class="item-product__description">
                  <div class="item-product__description__products-price"><span class="products-price">400 руб</span></div>
                  <div class="item-product__description__btn-block"><a href="{{ url('/') }}/#" class="btn btn-blue">Купить</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer__footer-content__main-content">
            <p>
              Интернет-магазин компьютерных игр ГЕЙМСМАРКЕТ - это
              онлайн-магазин игр для геймеров, существующий на рынке уже 5 лет.
              У нас широкий спектр лицензионных игр на компьютер, ключей для игр - для активации
              и авторизации, а также карты оплаты (game-card, time-card, игровые валюты и т.д.),
              коды продления и многое друго. Также здесь всегда можно узнать последние новости
              из области онлайн-игр для PC. На сайте предоставлены самые востребованные и
              актуальные товары MMORPG, приобретение которых здесь максимально удобно и,
              что немаловажно, выгодно!
            </p>
          </div>
        </div>
        <div class="footer__social-block">
          <ul class="social-block__list bcg-social">
            <li class="social-block__list__item"><a href="{{ url('/') }}/#" class="social-block__list__item__link"><i class="fa fa-facebook"></i></a></li>
            <li class="social-block__list__item"><a href="{{ url('/') }}/#" class="social-block__list__item__link"><i class="fa fa-twitter"></i></a></li>
            <li class="social-block__list__item"><a href="{{ url('/') }}/#" class="social-block__list__item__link"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
      </footer>
    </div>
    <script src="{{ url('/') }}/js/main.js"></script>
  </body>
</html>
