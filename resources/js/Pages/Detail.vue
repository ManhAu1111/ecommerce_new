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
          <li><a :href="route('home')" class="breadcrumb__link">Home</a></li>
          <li><span class="breadcrumb__link"></span>></li>
          <li><span class="breadcrumb__link">Fashion</span></li>
          <li><span class="breadcrumb__link"></span>></li>
          <li><span class="breadcrumb__link">Henley Shirt</span></li>
        </ul>
      </section>

      <!--=============== DETAILS ===============-->
      <section class="details section--lg">
        <div class="details__container container grid">
          <div class="details">
            <div class="details__group">

              <!-- KHUNG HIỂN THỊ CHÍNH -->
              <div class="details__main">

                  <!-- MODEL 3D (mặc định hiển thị) -->
                  <model-viewer
                    id="mainViewer"
                    src="/uploads/model3d/1/kid_toy_low_poly.glb"
                    camera-controls
                    auto-rotate
                    camera-orbit="0deg 75deg 105%"
                    min-camera-orbit="auto auto 80%"
                    max-camera-orbit="auto auto 120%"
                    style="width:100%; height:100%;">
                  </model-viewer>


                  <!-- ẢNH LỚN (ẩn ban đầu) -->
                  <img
                      id="mainImage"
                      src=""
                      alt=""
                      class="details__img"
                      style="display:none;"
                  />
              </div>

              <!-- THANH ẢNH NHỎ -->
              <div class="details__small-images grid">

                  <!-- THUMB MODEL -->
                  <div class="thumb active" data-type="model">
                      <model-viewer
                          src="/uploads/model3d/1/kid_toy_low_poly.glb"
                          interaction-prompt="none"
                          disable-zoom
                          disable-pan
                          disable-tap
                          style="width:100%; height:100%; background:#eee;">
                      </model-viewer>
                  </div>

                  <!-- THUMB ẢNH -->
                  <img
                      src="/uploads/product_images/1/1.jpg"
                      class="details__small-img thumb"
                      data-type="image"
                      data-src="/uploads/product_images/1/1.jpg"
                  />

                  <img
                      src="/uploads/product_images/1/2.jpg"
                      class="details__small-img thumb"
                      data-type="image"
                      data-src="/uploads/product_images/1/2.jpg"
                  />

                  <img
                      src="/uploads/product_images/1/3.jpg"
                      class="details__small-img thumb"
                      data-type="image"
                      data-src="/uploads/product_images/1/3.jpg"
                  />
              </div>
            </div>
          </div>

          <div class="details__group">
            <h3 class="details__title">Đồ chơi gỗ mê cung hạt – Bead Maze Montessori cho bé</h3>
            <p class="details__brand">Danh mục: <span>Đồ chơi trí tuệ</span></p>
            <div class="details__price flex">
              <span class="new__price">250.000₫</span>
            </div>
            <p class="short__description">
              Đồ chơi mê cung hạt gỗ giúp bé rèn luyện tư duy logic, khả năng phối hợp tay – mắt và nhận biết màu sắc thông qua việc di chuyển các hạt trên khung dây kim loại nhiều hình dạng.
            </p>
            <ul class="products__list">
              <li class="list__item flex">
                <i class="fi-rs-crown"></i> 1 Year Al Jazeera Brand Warranty
              </li>
              <li class="list__item flex">
                <i class="fi-rs-refresh"></i> 30 Days Return Policy
              </li>
              <li class="list__item flex">
                <i class="fi-rs-credit-card"></i> Cash on Delivery available
              </li>
            </ul>
            <div class="details__action">
              <input type="number" class="quantity" value="3" />
              <a href="#" class="btn btn--sm">Thêm vào giỏ hàng</a>
              <a href="#" class="details__action-btn">
                <i class="fi fi-rs-heart"></i>
              </a>
            </div>
            <ul class="details__meta">
              <li class="meta__list flex"><span>SKU:</span>FWM15VKT</li>
              <li class="meta__list flex">
                <span>Tags:</span>Clothes, Women, Dress
              </li>
              <li class="meta__list flex">
                <span>Availability:</span>8 Items in Stock
              </li>
            </ul>
          </div>
        </div>
      </section>

      <!--=============== REVIEWS ONLY ===============-->
      <section class="details__review container">

        <!-- ADD REVIEW -->
        <div class="review__form">
          <h4 class="review__form-title">Add a review</h4>

          <!-- STAR RATING -->
          <div class="rate__product" id="starRating">
            <i class="fi fi-rs-star" data-value="1"></i>
            <i class="fi fi-rs-star" data-value="2"></i>
            <i class="fi fi-rs-star" data-value="3"></i>
            <i class="fi fi-rs-star" data-value="4"></i>
            <i class="fi fi-rs-star" data-value="5"></i>
          </div>
          <input type="hidden" id="ratingValue" value="0">

          <form class="form grid">
            <textarea class="form__input textarea" placeholder="Write Comment"></textarea>
            <div class="form__group grid">
              <input type="text" placeholder="Name" class="form__input">
              <input type="email" placeholder="Email" class="form__input">
            </div>
            <div class="form__btn">
              <button class="btn">Submit Review</button>
            </div>
          </form>
        </div>

        <!-- TOGGLE BUTTON -->
        <button class="btn btn--outline review__toggle" id="toggleReviews">
          Show reviews
        </button>

        <!-- REVIEW LIST -->
        <div class="reviews__wrapper hidden" id="reviewsWrapper">

          <div class="reviews__container grid" id="reviewsList">
            <!-- REVIEW ITEM -->
            <div class="review__single">
              <div>
                <img src="/assets/img/avatar-1.jpg" class="review__img" />
                <h4 class="review__title">Jacky Chan</h4>
              </div>
              <div class="review__data">
                <div class="review__rating">
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                </div>
                <p class="review__description">
                  Thank you, very fast shipping from Poland only 3days.
                </p>
                <span class="review__date">December 4, 2022</span>
              </div>
            </div>
            <div class="review__single">
              <div>
                <img src="/assets/img/avatar-1.jpg" class="review__img" />
                <h4 class="review__title">Jacky Chan</h4>
              </div>
              <div class="review__data">
                <div class="review__rating">
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                </div>
                <p class="review__description">
                  Thank you, very fast shipping from Poland only 3days.
                </p>
                <span class="review__date">December 4, 2022</span>
              </div>
            </div>
            <div class="review__single">
              <div>
                <img src="/assets/img/avatar-1.jpg" class="review__img" />
                <h4 class="review__title">Jacky Chan</h4>
              </div>
              <div class="review__data">
                <div class="review__rating">
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                </div>
                <p class="review__description">
                  Thank you, very fast shipping from Poland only 3days.
                </p>
                <span class="review__date">December 4, 2022</span>
              </div>
            </div>
            <div class="review__single">
              <div>
                <img src="/assets/img/avatar-1.jpg" class="review__img" />
                <h4 class="review__title">Jacky Chan</h4>
              </div>
              <div class="review__data">
                <div class="review__rating">
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                  <i class="fi fi-rs-star active"></i>
                </div>
                <p class="review__description">
                  Thank you, very fast shipping from Poland only 3days.
                </p>
                <span class="review__date">December 4, 2022</span>
              </div>
            </div>
          </div>

          <!-- PAGINATION -->
          <div class="review__pagination" id="reviewPagination"></div>
        </div>

      </section>


      <!--=============== PRODUCTS ===============-->
      <section class="products container section--lg">
        <h3 class="section__title"><span>Related</span> Products</h3>
        <div class="products__container grid">
          <div class="product__item">
            <div class="product__banner">
              <a :href="route('detail')" class="product__images">
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
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Add to Wishlist"
                >
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
              <a :href="route('detail')">
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
          <div class="product__item">
            <div class="product__banner">
              <a :href="route('detail')" class="product__images">
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
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Add to Wishlist"
                >
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
              <a :href="route('detail')">
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
          <div class="product__item">
            <div class="product__banner">
              <a :href="route('detail')" class="product__images">
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
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Add to Wishlist"
                >
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
              <a :href="route('detail')">
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
          <div class="product__item">
            <div class="product__banner">
              <a :href="route('detail')" class="product__images">
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
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>
                <a
                  href="#"
                  class="action__btn"
                  aria-label="Add to Wishlist"
                >
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
              <a :href="route('detail')">
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
            Sign in to Newsletter
          </h3>
          <p class="newsletter__description">
            ...and receive $25 coupon for first shopping.
          </p>
          <form action="" class="newsletter__form">
            <input
              type="text"
              placeholder="Enter Your Email"
              class="newsletter__input"
            />
            <button type="submit" class="newsletter__btn">Subscribe</button>
          </form>
        </div>
      </section>
    </main>
    </MainLayout>
</template>

