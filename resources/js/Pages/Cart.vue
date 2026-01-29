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
          <li><span class="breadcrumb__link">Giỏ hàng</span></li>
        </ul>
      </section>

      <!--=============== CART ===============-->
      <section class="cart section--lg container">
        <div class="table__container">
          <table class="table">
            <thead>
              <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng phụ</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <img src="/assets//img/product-1-2.jpg" alt="" class="table__img" />
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
                <td><input type="number" value="3" class="quantity" /></td>
                <td><span class="subtotal">$220</span></td>
                <td><i class="fi fi-rs-trash table__trash"></i></td>
              </tr>
              <tr>
                <td>
                  <img src="/assets//img/product-7-1.jpg" alt="" class="table__img" />
                </td>
                <td>
                  <h3 class="table__title">Amazon Essentials Women's Tank</h3>
                  <p class="table__description">
                    Lorem ipsum dolor sit amet consectetur.
                  </p>
                </td>
                <td>
                  <span class="table__price">$110</span>
                </td>
                <td><input type="number" value="3" class="quantity" /></td>
                <td><span class="subtotal">$220</span></td>
                <td><i class="fi fi-rs-trash table__trash"></i></td>
              </tr>
              <tr>
                <td>
                  <img src="/assets//img/product-2-1.jpg" alt="" class="table__img" />
                </td>
                <td>
                  <h3 class="table__title">
                    Amazon Brand - Daily Ritual Women's Jersey
                  </h3>
                  <p class="table__description">
                    Lorem ipsum dolor sit amet consectetur.
                  </p>
                </td>
                <td>
                  <span class="table__price">$110</span>
                </td>
                <td><input type="number" value="3" class="quantity" /></td>
                <td><span class="subtotal">$220</span></td>
                <td><i class="fi fi-rs-trash table__trash"></i></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="cart__actions">
          <a href="#" class="btn flex btn__md">
            <i class="fi-rs-shuffle"></i> Cập nhật giỏ hàng
          </a>
          <a href="#" class="btn flex btn__md">
            <i class="fi-rs-shopping-bag"></i> Tiếp tục mua sắm
          </a>
        </div>

        <div class="divider">
          <i class="fi fi-rs-fingerprint"></i>
        </div>

        <div class="cart__group grid">
          <div>
            <div class="cart__shippinp">
              <h3 class="section__title">Tính phí vận chuyển</h3>
              <form action="" class="form grid">
                <input type="text" class="form__input" placeholder="Tỉnh / Quốc gia" />
                <div class="form__group grid">
                  <input type="text" class="form__input" placeholder="Thành phố" />
                  <input type="text" class="form__input" placeholder="Mã bưu điện" />
                </div>
                <div class="form__btn">
                  <button class="btn flex btn--sm">
                    <i class="fi-rs-shuffle"></i> Cập nhật
                  </button>
                </div>
              </form>
            </div>
            <div class="cart__coupon">
              <h3 class="section__title">Mã giảm giá</h3>
              <form action="" class="coupon__form form grid">
                <div class="form__group grid">
                  <input type="text" class="form__input" placeholder="Nhập mã giảm giá" />
                  <div class="form__btn">
                    <button class="btn flex btn--sm">
                      <i class="fi-rs-label"></i> Áp dụng
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="cart__total">
            <h3 class="section__title">Tổng giỏ hàng</h3>
            <table class="cart__total-table">
              <tr>
                <td><span class="cart__total-title">Tổng phụ</span></td>
                <td><span class="cart__total-price">$240.00</span></td>
              </tr>
              <tr>
                <td><span class="cart__total-title">Vận chuyển</span></td>
                <td><span class="cart__total-price">$10.00</span></td>
              </tr>
              <tr>
                <td><span class="cart__total-title">Tổng cộng</span></td>
                <td><span class="cart__total-price">$250.00</span></td>
              </tr>
            </table>
            <a :href="route('checkout')" class="btn flex btn--md">
              <i class="fi fi-rs-box-alt"></i> Tiến hành thanh toán
            </a>
          </div>
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
