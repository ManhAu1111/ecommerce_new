<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="main-layout">
        <header class="header">
        <!-- <div class="header__top">
            <div class="header__container container">
            <div class="header__contact">
                <span>(+01) - 2345 - 6789</span>
                <span>Our location</span>
            </div>
            <p class="header__alert-news">
                Super Values Deals - Save more coupons
            </p>
            <div class="header__top-action">
                <Link :href="route('login')" class="header__top-action">Đăng nhập</Link>
                <span style="margin: 0 8px; color: var(--text-color-light);">|</span>
                <Link :href="route('register')" class="header__top-action">Đăng ký</Link>
            </div>
            </div>
        </div> -->

        <nav class="nav container">
            <a :href="route('home')" class="nav__logo">
            <img
                class="nav__logo-img"
                src="/assets/img/logo_toyMark.png"
                alt="website logo"
            />
            </a>
            <div class="nav__menu" id="nav-menu">
            <div class="nav__menu-top">
                <a :href="route('home')" class="nav__menu-logo">
                <img src="/assets/img/logo.svg" alt="">
                </a>
                <div class="nav__close" id="nav-close">
                <i class="fi fi-rs-cross-small"></i>
                </div>
            </div>
            <ul class="nav__list">
                <li class="nav__item">
                <a :href="route('home')" class="nav__link active-link">Trang chủ</a>
                </li>
                <li class="nav__item">
                <a :href="route('shop')" class="nav__link">Cửa hàng</a>
                </li>
                <li class="nav__item">
                <a :href="route('account')" class="nav__link">Tài khoản</a>
                </li>
                <li class="nav__item">
                <a :href="route('login')" class="nav__link">Đăng nhập</a>
                </li>
            </ul>
            <div class="header__search">
                <input
                type="text"
                placeholder="Tìm kiếm sản phẩm..."
                class="form__input"
                />
                <button class="search__btn">
                <img src="/assets/img/search.png" alt="search icon" />
                </button>
            </div>
            </div>
            <div class="header__user-actions">
            <a href="wishlist.html" class="header__action-btn" title="Danh sách yêu thích">
                <img src="/assets/img/icon-heart.svg" alt="" />
                <span class="count">3</span>
            </a>
            <a :href="route('cart')" class="header__action-btn" title="Giỏ hàng">
                <img src="/assets/img/icon-cart.svg" alt="" />
                <span class="count">3</span>
            </a>
            <div class="header__action-btn nav__toggle" id="nav-toggle">
                <img src="/assets/img/menu-burger.svg" alt="">
            </div>
            </div>
        </nav>
        </header>

        <main>
            <slot />
        </main>

        <footer class="footer container">
        <div class="footer__container grid">
            <div class="footer__content">
            <!-- <a :href="route('home')" class="footer__logo">
                <img src="/assets/img/logo.svg" alt="" class="footer__logo-img" />
            </a> -->
            <a :href="route('home')" class="nav__logo">
            <img
                class="nav__logo-img"
                src="/assets/img/logo_toyMark.png"
                alt="website logo"
            />
            </a>
            <h4 class="footer__subtitle">Liên hệ</h4>
            <p class="footer__description">
                <span>Địa chỉ:</span> 13 Tlemcen Road, Street 32, Beb-Wahren
            </p>
            <p class="footer__description">
                <span>Điện thoại:</span> +01 2222 365 /(+91) 01 2345 6789
            </p>
            <p class="footer__description">
                <span>Giờ làm việc:</span> 10:00 - 18:00, Thứ 2 - Thứ 7
            </p>
            <div class="footer__social">
                <h4 class="footer__subtitle">Theo dõi tôi</h4>
                <div class="footer__links flex">
                <a href="#">
                    <img
                    src="/assets/img/icon-facebook.svg"
                    alt=""
                    class="footer__social-icon"
                    />
                </a>
                <a href="#">
                    <img
                    src="/assets/img/icon-twitter.svg"
                    alt=""
                    class="footer__social-icon"
                    />
                </a>
                <a href="#">
                    <img
                    src="/assets/img/icon-instagram.svg"
                    alt=""
                    class="footer__social-icon"
                    />
                </a>
                <a href="#">
                    <img
                    src="/assets/img/icon-pinterest.svg"
                    alt=""
                    class="footer__social-icon"
                    />
                </a>
                <a href="#">
                    <img
                    src="/assets/img/icon-youtube.svg"
                    alt=""
                    class="footer__social-icon"
                    />
                </a>
                </div>
            </div>
            </div>
            <div class="footer__content">
            <h3 class="footer__title">Thông tin</h3>
            <ul class="footer__links">
                <li><a href="#" class="footer__link">Về chúng tôi</a></li>
                <li><a href="#" class="footer__link">Thông tin giao hàng</a></li>
                <li><a href="#" class="footer__link">Chính sách bảo mật</a></li>
                <li><a href="#" class="footer__link">Điều khoản & Điều kiện</a></li>
                <li><a href="#" class="footer__link">Liên hệ với chúng tôi</a></li>
                <li><a href="#" class="footer__link">Trung tâm hỗ trợ</a></li>
            </ul>
            </div>
            <div class="footer__content">
            <h3 class="footer__title">Tài khoản của tôi</h3>
            <ul class="footer__links">
                <li><a :href="route('login')" class="footer__link">Đăng nhập</a></li>
                <li><a :href="route('cart')" class="footer__link">Xem giỏ hàng</a></li>
                <li><a href="#" class="footer__link">Danh sách yêu thích</a></li>
                <li><a href="#" class="footer__link">Theo dõi đơn hàng</a></li>
                <li><a href="#" class="footer__link">Trợ giúp</a></li>
                <li><a href="#" class="footer__link">Đơn hàng</a></li>
            </ul>
            </div>
            <div class="footer__content">
            <h3 class="footer__title">Cổng thanh toán an toàn</h3>
            <img
                src="/assets/img/payment-method.png"
                alt=""
                class="payment__img"
            />
            </div>
        </div>
        <div class="footer__bottom">
            <p class="copyright">&copy; 2026 TOY MARK. Đã đăng ký bản quyền</p>
            <span class="designer">Thiết kế bởi TOY MARK</span>
        </div>
        </footer>
    </div>
</template>

