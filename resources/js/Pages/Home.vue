<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { Head } from '@inertiajs/vue3'
import { ref, onMounted, nextTick } from 'vue'
import axios from 'axios'

const categories = ref([])

onMounted(async () => {
  const res = await axios.get('/categories')
  categories.value = res.data

  await nextTick()

  if (typeof Swiper !== 'undefined') {
    new Swiper('.categories__container', {
      spaceBetween: 24,
      loop: categories.value.length > 6,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        350: { slidesPerView: 2, spaceBetween: 18 },
        768: { slidesPerView: 3, spaceBetween: 24 },
        992: { slidesPerView: 4, spaceBetween: 24 },
        1200: { slidesPerView: 5, spaceBetween: 24 },
        1400: { slidesPerView: 6, spaceBetween: 24 },
      },
    })
  }
})

defineProps({
  featuredProducts: {
    type: Array,
    default: () => [],
  },
  popularProducts: {
    type: Array,
    default: () => [],
  },
  newProducts: {
    type: Array,
    default: () => [],
  },
})

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
              <a :href="route('shop')" class="btn">Mua ngay</a>
            </div>
            <img src="/assets/img/home-img-toy-1.png" class="home__img" alt="đồ chơi" />
          </div>
        </section>

        <!--=============== CATEGORIES ===============-->
        <section class="categories container section">
          <h3 class="section__title">
            <span>Danh mục</span> Sản phẩm
          </h3>

          <div class="categories__container swiper">
            <div class="swiper-wrapper">
              <a
                v-for="category in categories"
                :key="category.id"
                :href="route('shop', { category: category.id })"
                class="category__item swiper-slide"
              >
              <img
                :src="category.image_url"
                :alt="category.name"
                class="category__img"
              />


              <h3 class="category__title">{{ category.name }}</h3>
              </a>
            </div>

              <div class="swiper-button-prev categories-nav">
                <i class="fa-solid fa-chevron-left"></i>
              </div>
              <div class="swiper-button-next categories-nav">
                <i class="fa-solid fa-chevron-right"></i>
              </div>
            </div>
        </section>


        <!--=============== PRODUCTS ===============-->
        <section class="products container section">
          <!-- TAB BUTTON -->
          <div class="tab__btns">
            <span class="tab__btn active-tab" data-target="#featured">Nổi bật</span>
            <span class="tab__btn" data-target="#popular">Phổ biến</span>
          </div>

          <div class="tab__items">
            <!-- 🔥 NỔI BẬT -->
            <div class="tab__item active-tab" id="featured">
              <div class="products__container grid">
                <div
                  class="product__item"
                  v-for="product in featuredProducts"
                  :key="product.id"
                >
                  <div class="product__banner">
                    <a
                      v-if="product?.id"
                      :href="route('detail', { id: product.id })"
                      class="product__images"
                    >
                      <img
                        :src="product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                        class="product__img default"
                      />

                      <img
                        :src="product.secondary_image?.image_url 
                              ?? product.primary_image?.image_url 
                              ?? '/assets/img/default.jpg'"
                        class="product__img hover"
                      />
                    </a>

                    <div class="product__actions">
                      <a href="#" class="action__btn" aria-label="Thêm vào yêu thích">
                        <i class="fi fi-rs-heart"></i>
                      </a>
                    </div>

                    <div class="product__badge light-pink">Top Rated</div>
                  </div>

                  <div class="product__content">
                    <span class="product__category">Sản phẩm</span>

                    <a
                      v-if="product?.id"
                      :href="route('detail', { id: product.id })"
                    >
                      <h3 class="product__title">{{ product.name }}</h3>
                    </a>

                    <div class="product__rating">
                      <i
                        v-for="i in 5"
                        :key="i"
                        class="fi"
                        :class="i <= Math.round(product.avg_rating)
                          ? 'fi-rs-star'
                          : 'fi-rs-star-empty'"
                      ></i>
                    </div>

                    <div class="product__price flex">
                        <span class="new__price">
                          {{ Number(product.price).toLocaleString('vi-VN') }}₫
                        </span>
                      </div>


                    <a href="#" class="action__btn cart__btn" aria-label="Thêm vào giỏ hàng">
                      <i class="fi fi-rs-shopping-bag-add"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- 🚀 PHỔ BIẾN -->
            <div class="tab__item" id="popular">
              <div class="products__container grid">
                <div
                  class="product__item"
                  v-for="product in popularProducts"
                  :key="product.id"
                >
                  <div class="product__banner">
                    <a
                      v-if="product?.id"
                      :href="route('detail', { id: product.id })"
                      class="product__images"
                    >
                      <img
                        :src="product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                        class="product__img default"
                      />

                      <img
                        :src="product.secondary_image?.image_url 
                              ?? product.primary_image?.image_url 
                              ?? '/assets/img/default.jpg'"
                        class="product__img hover"
                      />
                    </a>

                    <div class="product__actions">
                      <a href="#" class="action__btn">
                        <i class="fi fi-rs-heart"></i>
                      </a>
                    </div>

                    <div class="product__badge light-pink">Best Seller</div>
                  </div>

                  <div class="product__content">
                    <span class="product__category">Sản phẩm</span>

                    <a
                      v-if="product?.id"
                      :href="route('detail', { id: product.id })"
                    >
                      <h3 class="product__title">{{ product.name }}</h3>
                    </a>
                    <div class="product__rating">
                      <i
                        v-for="i in 5"
                        :key="i"
                        class="fi"
                        :class="i <= Math.round(product.avg_rating)
                          ? 'fi-rs-star'
                          : 'fi-rs-star-empty'"
                      ></i>
                    </div>

                    <div class="product__price flex">
                      <span class="new__price">
                        {{ Number(product.price).toLocaleString('vi-VN') }}₫
                      </span>
                    </div>




                    <a href="#" class="action__btn cart__btn" aria-label="Thêm vào giỏ hàng">
                      <i class="fi fi-rs-shopping-bag-add"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <!--=============== DEALS ===============-->
        <!-- <section class="deals section">
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
                <a :href="route('detail')" class="btn btn--md">Mua ngay</a>
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
                <a :href="route('detail')" class="btn btn--md">Mua ngay</a>
              </div>
            </div>
          </div>
        </section> -->

        <!--=============== NEW ARRIVALS ===============-->
        <section class="new__arrivals container section">
          <h3 class="section__title"><span>Sản phẩm</span> Mới</h3>
          <div class="new__container">
            <div class="products__container grid">
                <div
                  class="product__item"
                  v-for="product in newProducts"
                  :key="product.id"
                >
                  <div class="product__banner">
                    <a
                      v-if="product?.id"
                      :href="route('detail', { id: product.id })"
                      class="product__images"
                    >
                      <img
                        :src="product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                        class="product__img default"
                      />

                      <img
                        :src="product.secondary_image?.image_url 
                              ?? product.primary_image?.image_url 
                              ?? '/assets/img/default.jpg'"
                        class="product__img hover"
                      />
                    </a>

                    <div class="product__actions">
                      <a href="#" class="action__btn" aria-label="Thêm vào yêu thích">
                        <i class="fi fi-rs-heart"></i>
                      </a>
                    </div>

                    <div class="product__badge light-pink">Top Rated</div>
                  </div>

                  <div class="product__content">
                    <span class="product__category">Sản phẩm</span>

                    <a
                      v-if="product?.id"
                      :href="route('detail', { id: product.id })"
                    >
                      <h3 class="product__title">{{ product.name }}</h3>
                    </a>


                    <div class="product__rating">
                      <i
                        v-for="i in 5"
                        :key="i"
                        class="fi"
                        :class="i <= Math.round(product.avg_rating)
                          ? 'fi-rs-star'
                          : 'fi-rs-star-empty'"
                      ></i>
                    </div>

                    <div class="product__price flex">
                        <span class="new__price">
                          {{ Number(product.price).toLocaleString('vi-VN') }}₫
                        </span>
                      </div>


                    <a href="#" class="action__btn cart__btn" aria-label="Thêm vào giỏ hàng">
                      <i class="fi fi-rs-shopping-bag-add"></i>
                    </a>
                  </div>
                </div>
            </div>
          </div>
        </section>

        <!--=============== SHOWCASE ===============-->
        <section class="showcase section">
          <div class="showcase__container container grid">
            <div class="showcase__wrapper">
              <h3 class="section__title">Mới phát hành</h3>
              <div class="showcase__item">
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-1.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-2.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-3.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-4.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
                    <h4 class="showcase__title">Áo thun in hình cá</h4>
                  </a>
                  <div class="showcase__price flex">
                    <span class="new__price">$238.85</span>
                    <span class="old__price">$245.8</span>
                  </div>
                </div>
              </div>
              <div class="showcase__item">
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-5.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
                    <h4 class="showcase__title">Đầm in hoa cổ điển</h4>
                  </a>
                  <div class="showcase__price flex">
                    <span class="new__price">$238.85</span>
                    <span class="old__price">$245.8</span>
                  </div>
                </div>
              </div>
              <div class="showcase__item">
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-6.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-7.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-8.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
                    <h4 class="showcase__title">Đầm Maxi in họa tiết</h4>
                  </a>
                  <div class="showcase__price flex">
                    <span class="new__price">$238.85</span>
                    <span class="old__price">$245.8</span>
                  </div>
                </div>
              </div>
              <div class="showcase__item">
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-9.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-7.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
                    <h4 class="showcase__title">Cotton in hoa thường ngày</h4>
                  </a>
                  <div class="showcase__price flex">
                    <span class="new__price">$238.85</span>
                    <span class="old__price">$245.8</span>
                  </div>
                </div>
              </div>
              <div class="showcase__item">
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-8.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
                    <h4 class="showcase__title">Tay dài bèo nhún trơn</h4>
                  </a>
                  <div class="showcase__price flex">
                    <span class="new__price">$238.85</span>
                    <span class="old__price">$245.8</span>
                  </div>
                </div>
              </div>
              <div class="showcase__item">
                <a href="#" class="showcase__img-box">
                  <img src="/assets/img/showcase-img-9.jpg" alt="" class="showcase__img" />
                </a>
                <div class="showcase__content">
                  <a href="#">
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
    </section>
  </MainLayout>
</template>

