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
            <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
                <div style="margin-bottom: 5px;">
                    <!--x-input-label for="email" :value="__('Email')" /-->Введите ваш EMail:<br />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4" style="margin-bottom: 5px;">
                    <!--x-input-label for="password" :value="__('Password')" /-->

                    Введите ваш пароль:<br />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4" style="margin-bottom: 7px;">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Запомнить меня</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>

                    @if (Route::has('password.request'))
                        <br /><a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    @endif

                </div>
            </form>
            <!--form method="post" action="/login/done" >
                Введите логин:<br />
                <input name="login" maxlength="150" /> <br />
                Введите пароль:<br />
                <input name="pass" maxlength="150" type="password" /> <br />
                <p align="center"><input type="submit" value="Отправить"></p>
            </form-->
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
