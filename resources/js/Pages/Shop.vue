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
          <li><a href="index.html" class="breadcrumb__link">Trang chủ</a></li>
          <li><span class="breadcrumb__link"></span>></li>
          <li><span class="breadcrumb__link">Cửa hàng</span></li>
        </ul>
      </section>

      <!--=============== PRODUCTS ===============-->
      <section class="products container section--lg">
        <p class="total__products">Chúng tôi tìm thấy <span>688</span> sản phẩm cho bạn!</p>
        <div class="products__container grid">
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-1-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-1-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-pink">Hot</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-2-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-2-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-green">Hot</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-3-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-3-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-orange">Hot</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-4-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-4-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-blue">Hot</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-5-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-5-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-blue">-30%</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-6-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-6-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-blue">-22%</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-7-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-7-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-green">-22%</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-8-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-8-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-10-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-10-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-blue">-30%</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-11-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-11-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-blue">-22%</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-4-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-4-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
              <div class="product__badge light-green">-22%</div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
          <div class="product__item">
            <div class="product__banner">
              <a href="details.html" class="product__images">
                <img
                  src="assets/img/product-12-1.jpg"
                  alt=""
                  class="product__img default"
                />
                <img
                  src="assets/img/product-12-2.jpg"
                  alt=""
                  class="product__img hover"
                />
              </a>
              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Xem nhanh">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Thêm vào yêu thích"
                >
                  <i class="fi fi-rs-heart"></i>
                </a>
                <a href="#" class="action__btn" aria-label="So sánh">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
            </div>
            <div class="product__content">
              <span class="product__category">Quần áo</span>
              <a href="details.html">
                <h3 class="product__title">Áo sơ mi họa tiết</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>
              <a
                href="#"
                class="action__btn cart__btn"
                aria-label="Add To Cart"
              >
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
        </div>
        <ul class="pagination">
          <li><a href="#" class="pagination__link active">01</a></li>
          <li><a href="#" class="pagination__link">02</a></li>
          <li><a href="#" class="pagination__link">03</a></li>
          <li><a href="#" class="pagination__link">...</a></li>
          <li><a href="#" class="pagination__link">16</a></li>
          <li><a href="#" class="pagination__link icon">
            <i class="fi-rs-angle-double-small-right"></i>
          </a></li>
        </ul>
      </section>

      <!--=============== NEWSLETTER ===============-->
      <section class="newsletter section">
        <div class="newsletter__container container grid">
          <h3 class="newsletter__title flex">
            <img
              src="/assets/img/icon-email.svg"
              alt=""
              class="newsletter__icon"
            />
            Đăng ký nhận bản tin
          </h3>
          <p class="newsletter__description">
            ...và nhận phiếu giảm giá $25 cho lần mua sắm đầu tiên.
          </p>
          <form action="" class="newsletter__form">
            <input
              type="text"
              placeholder="Nhập email của bạn"
              class="newsletter__input"
            />
            <button type="submit" class="newsletter__btn">Đăng ký</button>
          </form>
        </div>
      </section>
    </main>
    </MainLayout>

</template>
