<script setup>
import { Link, usePage, router } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted, computed } from 'vue'
import axios from 'axios'

const showMenu = ref(false)
const showLogoutModal = ref(false)
const search = ref('')

const page = usePage()
const user = computed(() => page.props.auth.user)

// cart count LOCAL
const cartCount = ref(0)

const loadCartCount = async () => {
    if (!user.value) return
    const res = await axios.get(route('cart.count'))
    cartCount.value = res.data.count
}

const logout = () => {
    router.post(route('logout'))
}

const submitSearch = () => {
    router.get('/shop', { search: search.value }, {
        preserveState: true,
        preserveScroll: true,
    })
}

onMounted(() => {
    loadCartCount()
    window.addEventListener('cart-updated', loadCartCount)
})

onUnmounted(() => {
    window.removeEventListener('cart-updated', loadCartCount)
})
</script>

<template>
    <div class="main-layout">
        <header class="header">
            <nav class="nav container">
                <a :href="route('home')" class="nav__logo">
                    <img class="nav__logo-img" src="/assets/img/logo_toyMark.png" alt="website logo" />
                </a>
                <div class="nav__menu" :class="{ 'show-menu': showMenu }">
                    <div class="nav__menu-top">
                        <Link :href="route('home')" class="nav__menu-logo">
                            <img src="/assets/img/logo_toyMark.png" alt="">
                        </Link>
                        <div class="nav__close" @click="showMenu = false">
                            <i class="fi fi-rs-cross-small"></i>
                        </div>
                    </div>
                    <ul class="nav__list">
                        <li class="nav__item">
                            <Link :href="route('home')" class="nav__link"
                                :class="{ 'active-link': route().current('home') }">
                                Trang chủ
                            </Link>
                        </li>

                        <li class="nav__item">
                            <Link :href="route('shop')" class="nav__link"
                                :class="{ 'active-link': route().current('shop*') }">
                                Cửa hàng
                            </Link>
                        </li>

                        <li class="nav__item" v-if="user">
                            <Link :href="route('account')" class="nav__link"
                                :class="{ 'active-link': route().current('account*') }">
                                Tài khoản
                            </Link>
                        </li>

                        <li class="nav__item" v-if="!user">
                            <Link :href="route('login')" class="nav__link"
                                :class="{ 'active-link': route().current('login') }">
                                Đăng nhập
                            </Link>
                        </li>
                    </ul>
                    <div class="header__search">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." class="form__input" v-model="search"
                            @keyup.enter="submitSearch" />
                        <button class="search__btn" @click="submitSearch">
                            <img src="/assets/img/search.png" alt="search icon" />
                        </button>
                    </div>
                </div>
                <div class="header__user-actions">
                    <a v-if="user" :href="route('wishlist')" class="header__action-btn" title="Danh sách yêu thích">
                        <img src="/assets/img/icon-heart.svg" alt="" />
                        <span class="count">3</span>
                    </a>
                    <a v-if="user" :href="route('cart.index')" class="header__action-btn" title="Giỏ hàng">
                        <img src="/assets/img/icon-cart.svg" alt="" />
                        <span class="count" v-if="cartCount > 0">
                            {{ cartCount }}
                        </span>
                    </a>
                    <button v-if="user" @click="showLogoutModal = true" class="header__action-btn" title="Đăng xuất"
                        type="button">
                        <img src="/assets/img/logout.svg" alt="logout" />
                    </button>
                    <div class="header__action-btn nav__toggle" @click="showMenu = true">
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
                        <img class="nav__logo-img" src="/assets/img/logo_toyMark.png" alt="website logo" />
                    </a>
                    <h4 class="footer__subtitle">Liên hệ</h4>
                    <p class="footer__description">
                        <span>Địa chỉ:</span> Đại học Kiến Trúc Hà Nội
                    </p>
                    <p class="footer__description">
                        <span>Điện thoại:</span> +0123456789
                    </p>
                    <p class="footer__description">
                        <span>Giờ làm việc:</span> 8:00 - 20:00, Thứ 2 - Thứ 7
                    </p>
                    <div class="footer__social">
                        <h4 class="footer__subtitle">Theo dõi tôi</h4>
                        <div class="footer__links flex">
                            <a href="#">
                                <img src="/assets/img/icon-facebook.svg" alt="" class="footer__social-icon" />
                            </a>
                            <a href="#">
                                <img src="/assets/img/icon-twitter.svg" alt="" class="footer__social-icon" />
                            </a>
                            <a href="#">
                                <img src="/assets/img/icon-instagram.svg" alt="" class="footer__social-icon" />
                            </a>
                            <a href="#">
                                <img src="/assets/img/icon-pinterest.svg" alt="" class="footer__social-icon" />
                            </a>
                            <a href="#">
                                <img src="/assets/img/icon-youtube.svg" alt="" class="footer__social-icon" />
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
                        <li v-if="!user">
                            <Link :href="route('login')" class="footer__link">
                                Đăng nhập
                            </Link>
                        </li>

                        <li v-if="user">
                            <Link :href="route('account')" class="footer__link">
                                Tài khoản
                            </Link>
                        </li>
                        <li><a :href="route('cart.index')" class="footer__link">Xem giỏ hàng</a></li>
                        <li><a href="#" class="footer__link">Danh sách yêu thích</a></li>
                        <li><a href="#" class="footer__link">Theo dõi đơn hàng</a></li>
                        <li><a href="#" class="footer__link">Trợ giúp</a></li>
                        <li><a href="#" class="footer__link">Đơn hàng</a></li>
                    </ul>
                </div>
                <div class="footer__content">
                    <h3 class="footer__title">Cổng thanh toán an toàn</h3>
                    <img src="/assets/img/payment-method.png" alt="" class="payment__img" />
                </div>
            </div>
            <div class="footer__bottom">
                <p class="copyright">&copy; 2026 TOY MARK. Đã đăng ký bản quyền</p>
                <span class="designer">Thiết kế bởi TOY MARK</span>
            </div>
        </footer>
    </div>

    <!-- hỏi đăng xuất -->
    <!-- Logout Confirm Modal -->
    <div v-if="showLogoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Xác nhận đăng xuất
            </h2>

            <p class="text-gray-600 mb-6">
                Bạn có chắc chắn muốn đăng xuất khỏi tài khoản không?
            </p>

            <div class="flex justify-end gap-3">
                <button @click="showLogoutModal = false"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                    Hủy
                </button>

                <button @click="logout"
                    class="px-4 py-2 rounded-lg text-white bg-[#088179] hover:bg-[#066f68] transition">
                    Đăng xuất
                </button>
            </div>
        </div>
    </div>

</template>
