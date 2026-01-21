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
    <section class="home__container">
    <main class="main">
      <!--=============== HOME ===============-->
      <section class="home section--lg">
        <div class="home__container container grid">
          <div class="home__content">
            <span class="home__subtitle">Đồ chơi nổi bật</span>
            <h1 class="home__title">
              Thế giới đồ chơi <span>Vô vàn niềm vui</span>
              </h1>
              <p class="home__description">
              Khám phá những món đồ chơi thú vị 
            </p>
            <a href="shop.html" class="btn">Mua ngay</a>
          </div>
          <img src="/assets/img/home-img-toy-1.png" class="home__img" alt="đồ chơi" />
        </div>
      </section>

      <!--=============== CATEGORIES ===============-->
      <section class="categories container section">
        <h3 class="section__title"><span>Danh mục</span> Phổ biến</h3>
        <div class="categories__container swiper">
          <div class="swiper-wrapper">
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-1.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Áo thun</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-2.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Túi xách</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-3.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Dép</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-4.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Khăn & Mũ</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-5.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Giày</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-6.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Vỏ gối</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-7.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Jumpsuit</h3>
            </a>
            <a href="shop.html" class="category__item swiper-slide">
              <img
                src="/assets/img/category-8.jpg"
                alt=""
                class="category__img"
              />
              <h3 class="category__title">Mũ</h3>
            </a>
          </div>

          <div class="swiper-button-prev">
            <i class="fi fi-rs-angle-left"></i>
          </div>
          <div class="swiper-button-next">
            <i class="fi fi-rs-angle-right"></i>
          </div>
        </div>
      </section>

      <!--=============== PRODUCTS ===============-->
      <section class="products container section">
        <div class="tab__btns">
          <span class="tab__btn active-tab" data-target="#featured"
            >Nổi bật</span
          >
          <span class="tab__btn" data-target="#popular">Phổ biến</span>
          <span class="tab__btn" data-target="#new-added">Mới thêm</span>
        </div>

        <div class="tab__items">
          <div class="tab__item active-tab" content id="featured">
            <div class="products__container grid">
              <div class="product__item">
                <div class="product__banner">
                  <a href="details.html" class="product__images">
                    <img
                      src="/assets/img/product-1-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-1-2.jpg"
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
                      src="/assets/img/product-2-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-2-2.jpg"
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
                      src="/assets/img/product-3-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-3-2.jpg"
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
                      src="/assets/img/product-4-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-4-2.jpg"
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
                      src="/assets/img/product-5-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-5-2.jpg"
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
                      src="/assets/img/product-6-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-6-2.jpg"
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
                      src="/assets/img/product-7-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-7-2.jpg"
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
                      src="/assets/img/product-8-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-8-2.jpg"
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
          </div>
          <div class="tab__item" content id="popular">
            <div class="products__container grid">
              <div class="product__item">
                <div class="product__banner">
                  <a href="details.html" class="product__images">
                    <img
                      src="/assets/img/product-9-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-9-2.jpg"
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
                      src="/assets/img/product-2-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-2-2.jpg"
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
                      src="/assets/img/product-10-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-10-2.jpg"
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
                      src="/assets/img/product-4-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-4-2.jpg"
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
                      src="/assets/img/product-5-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-5-2.jpg"
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
                      src="/assets/img/product-11-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-11-2.jpg"
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
                      src="/assets/img/product-7-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-7-2.jpg"
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
                      src="/assets/img/product-8-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-8-2.jpg"
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
          </div>
          <div class="tab__item" content id="new-added">
            <div class="products__container grid">
              <div class="product__item">
                <div class="product__banner">
                  <a href="details.html" class="product__images">
                    <img
                      src="/assets/img/product-1-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-1-2.jpg"
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
                      src="/assets/img/product-12-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-12-2.jpg"
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
                      src="/assets/img/product-13-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-13-2.jpg"
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
                      src="/assets/img/product-4-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-4-2.jpg"
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
                      src="/assets/img/product-10-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-10-2.jpg"
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
                      src="/assets/img/product-6-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-6-2.jpg"
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
                      src="/assets/img/product-9-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-9-2.jpg"
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
                      src="/assets/img/product-8-1.jpg"
                      alt=""
                      class="product__img default"
                    />
                    <img
                      src="/assets/img/product-8-2.jpg"
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
          </div>
        </div>
      </section>

      <!--=============== DEALS ===============-->
      <section class="deals section">
        <div class="deals__container container grid">
          <div class="deals__item">
            <div class="deals__group">
              <h3 class="deals__brand">Ưu đãi trong ngày</h3>
              <span class="deals__category">Số lượng có hạn</span>
            </div>
            <h4 class="deals__title">Bộ sưu tập mùa hè Thiết kế hiện đại</h4>
            <div class="deals__price flex">
              <span class="new__price">$139.00</span>
              <span class="old__price">$160.99</span>
            </div>
            <div class="deals__group">
              <p class="deals__countdown-text">Nhanh lên! Ưu đãi kết thúc sau:</p>
              <div class="countdown">
                <div class="countdown__amount">
                  <p class="countdown__period">02</p>
                  <span class="unit">Ngày</span>
                </div>
                <div class="countdown__amount">
                  <p class="countdown__period">22</p>
                  <span class="unit">Giờ</span>
                </div>
                <div class="countdown__amount">
                  <p class="countdown__period">57</p>
                  <span class="unit">Phút</span>
                </div>
                <div class="countdown__amount">
                  <p class="countdown__period">28</p>
                  <span class="unit">Giây</span>
                </div>
              </div>
            </div>
            <div class="deals__btn">
              <a href="details.html" class="btn btn--md">Mua ngay</a>
            </div>
          </div>
          <div class="deals__item">
            <div class="deals__group">
              <h3 class="deals__brand">Thời trang nữ</h3>
              <span class="deals__category">Áo & Túi xách</span>
            </div>
            <h4 class="deals__title">Thử điều gì đó mới mẻ cho kỳ nghỉ</h4>
            <div class="deals__price flex">
              <span class="new__price">$178.00</span>
              <span class="old__price">$256.99</span>
            </div>
            <div class="deals__group">
              <p class="deals__countdown-text">Nhanh lên! Ưu đãi kết thúc sau:</p>
              <div class="countdown">
                <div class="countdown__amount">
                  <p class="countdown__period">02</p>
                  <span class="unit">Ngày</span>
                </div>
                <div class="countdown__amount">
                  <p class="countdown__period">22</p>
                  <span class="unit">Giờ</span>
                </div>
                <div class="countdown__amount">
                  <p class="countdown__period">57</p>
                  <span class="unit">Phút</span>
                </div>
                <div class="countdown__amount">
                  <p class="countdown__period">28</p>
                  <span class="unit">Giây</span>
                </div>
              </div>
            </div>
            <div class="deals__btn">
              <a href="details.html" class="btn btn--md">Mua ngay</a>
            </div>
          </div>
        </div>
      </section>

      <!--=============== NEW ARRIVALS ===============-->
      <section class="new__arrivals container section">
        <h3 class="section__title"><span>Sản phẩm</span> Mới</h3>
        <div class="new__container swiper">
          <div class="swiper-wrapper">
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-1-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-1-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-pink">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-2-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-2-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-green">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-3-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-3-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-orange">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-4-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-4-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-blue">Hot</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-5-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-5-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-blue">-30%</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-6-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-6-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-blue">-22%</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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
            <div class="product__item swiper-slide">
              <div class="product__banner">
                <a href="details.html" class="product__images">
                  <img
                    src="/assets/img/product-7-1.jpg"
                    alt=""
                    class="product__img default"
                  />
                  <img
                    src="/assets/img/product-7-2.jpg"
                    alt=""
                    class="product__img hover"
                  />
                </a>
                <div class="product__actions">
                  <a href="#" class="action__btn" aria-label="Quick View">
                    <i class="fi fi-rs-eye"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Add to Wishlist">
                    <i class="fi fi-rs-heart"></i>
                  </a>
                  <a href="#" class="action__btn" aria-label="Compare">
                    <i class="fi fi-rs-shuffle"></i>
                  </a>
                </div>
                <div class="product__badge light-green">-22%</div>
              </div>
              <div class="product__content">
                <span class="product__category">Clothing</span>
                <a href="details.html">
                  <h3 class="product__title">Colorful Pattern Shirts</h3>
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

          <div class="swiper-button-prev">
            <i class="fi fi-rs-angle-left"></i>
          </div>
          <div class="swiper-button-next">
            <i class="fi fi-rs-angle-right"></i>
          </div>
        </div>
      </section>

      <!--=============== SHOWCASE ===============-->
      <section class="showcase section">
        <div class="showcase__container container grid">
          <div class="showcase__wrapper">
            <h3 class="section__title">Mới phát hành</h3>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-1.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">
                    Đầm cotton in hoa
                  </h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-2.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">
                    Áo kiểu tay dài bèo nhún
                  </h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-3.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">
                    Áo thun cổ V in nhiều màu
                  </h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
          </div>
          <div class="showcase__wrapper">
            <h3 class="section__title">Ưu đãi & Xả hàng</h3>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-4.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">Áo thun in hình cá</h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-5.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">Đầm in hoa cổ điển</h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-6.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">
                    Áo thun sọc tròn nhiều màu
                  </h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
          </div>
          <div class="showcase__wrapper">
            <h3 class="section__title">Bán chạy nhất</h3>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-7.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">
                    Áo kiểu tay dài in hình học
                  </h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-8.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">Đầm Maxi in họa tiết</h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-9.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">
                    Jumpsuit dây in hoa cúc
                  </h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
          </div>
          <div class="showcase__wrapper">
            <h3 class="section__title">Xu hướng</h3>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-7.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">Cotton in hoa thường ngày</h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-8.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">Tay dài bèo nhún trơn</h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
            <div class="showcase__item">
              <a href="details.html" class="showcase__img-box">
                <img
                  src="/assets/img/showcase-img-9.jpg"
                  alt=""
                  class="showcase__img"
                />
              </a>
              <div class="showcase__content">
                <a href="details.html">
                  <h4 class="showcase__title">In nhiều màu cổ V</h4>
                </a>
                <div class="showcase__price flex">
                  <span class="new__price">$238.85</span>
                  <span class="old__price">$245.8</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!--=============== NEWSLETTER ===============-->
      <section class="newsletter section home__newsletter">
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
    </section>
  </MainLayout>
</template>
