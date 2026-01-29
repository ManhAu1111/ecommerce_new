<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

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
                    <li><span class="breadcrumb__link"></span>></li>
                    <li><a :href="route('shop')" class="breadcrumb__link">Cửa hàng</a></li>
                    <li><span class="breadcrumb__link"></span>></li>
                    <li><span class="breadcrumb__link">Yêu thích</span></li>
                </ul>
            </section>

            <!--=============== WISHLIST ===============-->
            <section class="wishlist section--lg container">
                <div class="table__container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Tình trạng tồn kho</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="assets//img/product-1-2.jpg" alt="" class="table__img" />
                                </td>
                                <td>
                                    <h3 class="table__title">
                                        J.Crew Mercantile Women's Short-Sleeve
                                    </h3>
                                    <p class="table__description">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </p>
                                </td>
                                <td>
                                    <span class="table__price">$110</span>
                                </td>
                                <td><span class="table__stock">In Stock</span></td>
                                <td><a href="#" class="btn btn--sm">Thêm vào giỏ hàng</a></td>
                                <td><i class="fi fi-rs-trash table__trash"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!--=============== NEWSLETTER ===============-->
            <section class="newsletter section">
                <div class="newsletter__container container grid">
                    <h3 class="newsletter__title flex">
                        <img src="/assets/img/icon-email.svg" alt="" class="newsletter__icon" />
                        Đăng ký nhận bản tin
                    </h3>
                    <p class="newsletter__description">
                        ...và nhận phiếu giảm giá $25 cho lần mua sắm đầu tiên.
                    </p>
                    <form action="" class="newsletter__form">
                        <input type="text" placeholder="Nhập email của bạn" class="newsletter__input" />
                        <button type="submit" class="newsletter__btn">Đăng ký</button>
                    </form>
                </div>
            </section>
        </main>
    </MainLayout>
</template>
