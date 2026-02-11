<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, computed } from 'vue';

const props = defineProps({
    cartItems: Array,
    total: Number,
})

const SHIPPING_FEE = 30000

const subTotal = computed(() =>
    props.cartItems.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    )
)

const grandTotal = computed(() =>
    subTotal.value + SHIPPING_FEE
)

onMounted(() => {
    /* Đảm bảo Swiper đã được tải từ CDN trong app.blade.php */
    if (typeof Swiper !== 'undefined') {
        // Khởi tạo Categories Slider
        new Swiper('.categories__container', {
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                350: { slidesPerView: 2, spaceBetween: 18 },
                768: { slidesPerView: 3, spaceBetween: 24 },
                992: { slidesPerView: 5, spaceBetween: 24 },
                1200: { slidesPerView: 6, spaceBetween: 24 },
                1400: { slidesPerView: 8, spaceBetween: 24 },
            },
        });

        // Khởi tạo New Arrivals Slider
        new Swiper('.new__container', {
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 24 },
                992: { slidesPerView: 3, spaceBetween: 24 },
                1400: { slidesPerView: 4, spaceBetween: 24 },
            },
        });
    }
});
</script>

<template>
    <MainLayout>
        <main class="main">
            <!--=============== BREADCRUMB ===============-->
            <section class="breadcrumb">
                <ul class="breadcrumb__list flex container">
                    <li><a :href="route('home')" class="breadcrumb__link">Trang chủ</a></li>
                    <li><span class="breadcrumb__link">></span></li>
                    <li><a :href="route('shop')" class="breadcrumb__link">Cửa hàng</a></li>
                    <li><span class="breadcrumb__link">></span></li>
                    <li><span class="breadcrumb__link">Thanh toán</span></li>
                </ul>
            </section>

            <!--=============== CHECKOUT ===============-->
            <section class="checkout section--lg">
                <div class="checkout__container container grid">
                    <div class="checkout__group">
                        <h3 class="section__title">Thông tin thanh toán</h3>
                        <form class="form grid">
                            <input type="text" placeholder="Họ và Tên" class="form__input" />
                            <input type="text" placeholder="Địa chỉ" class="form__input" />
                            <input type="text" placeholder="Thành phố" class="form__input" />
                            <input type="text" placeholder="Quốc gia" class="form__input" />
                            <input type="text" placeholder="Mã bưu điện" class="form__input" />
                            <input type="text" placeholder="Số điện thoại" class="form__input" />
                            <input type="email" placeholder="Email" class="form__input" />
                            <h3 class="checkout__title">Thông tin bổ sung</h3>
                            <textarea name="" placeholder="Ghi chú" class="form__input textarea"></textarea>
                        </form>
                    </div>
                    <div class="checkout__group">
                        <h3 class="section__title">Tổng đơn hàng</h3>
                        <table class="order__table">
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th>Tổng cộng</th>
                                </tr>
                            </thead>

                            <tr v-for="item in cartItems" :key="item.id">
                                <td>
                                    <img :src="item.product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                                        class="order__img" />
                                </td>

                                <td>
                                    <h3 class="table__title">{{ item.product.name }}</h3>
                                    <p class="table__quantity">x {{ item.quantity }}</p>
                                </td>

                                <td>
                                    <span class="table__price">
                                        {{ (item.price * item.quantity).toLocaleString('vi-VN') }}₫
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>Tạm tính</td>
                                <td colspan="2">{{ subTotal.toLocaleString('vi-VN') }}₫</td>
                            </tr>

                            <tr>
                                <td>Phí vận chuyển</td>
                                <td colspan="2">30.000₫</td>
                            </tr>

                            <tr>
                                <td><b>Tổng cộng</b></td>
                                <td colspan="2">
                                    <b>{{ grandTotal.toLocaleString('vi-VN') }}₫</b>
                                </td>
                            </tr>


                        </table>
                        <div class="payment__methods">
                            <h3 class="checkout__title payment__title">Phương thức thanh toán</h3>
                            <div class="payment__option flex">
                                <input type="radio" name="radio" id="l1" checked class="payment__input" />
                                <label for="l1" class="payment__label">Thanh toán sau khi nhận hàng</label>
                            </div>
                            <div class="payment__option flex">
                                <input type="radio" name="radio" id="l2" class="payment__input" />
                                <label for="l2" class="payment__label">Thanh toán bằng MoMo</label>
                            </div>
                        </div>
                        <button class="btn btn--md">Xác nhận đặt hàng</button>
                    </div>
                </div>
            </section>
        </main>
    </MainLayout>
</template>
