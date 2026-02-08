<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { router } from '@inertiajs/vue3'
import { reactive, computed } from 'vue'

const props = defineProps({
  products: Object,
  categories: Array,
  filters: Object
})

const filter = reactive({
  category: props.filters?.category ?? [],
  price_min: props.filters?.price_min ?? '',
  price_max: props.filters?.price_max ?? '',
})

// format hiển thị tiền
const formatMoney = (value) => {
  if (!value) return ''
  return Number(value).toLocaleString('vi-VN')
}

// computed cho input
const priceMinDisplay = computed({
  get() {
    return formatMoney(filter.price_min)
  },
  set(value) {
    filter.price_min = value.replace(/\D/g, '')
  }
})

const priceMaxDisplay = computed({
  get() {
    return formatMoney(filter.price_max)
  },
  set(value) {
    filter.price_max = value.replace(/\D/g, '')
  }
})

const applyFilter = () => {
  router.get('/shop', {
    category: filter.category,
    price_min: filter.price_min,
    price_max: filter.price_max,
  }, {
    preserveState: true,
    preserveScroll: true,
  })
}
</script>



<template>
    <MainLayout>
                <main class="main">
      <!--=============== BREADCRUMB ===============-->
      <section class="breadcrumb">
        <ul class="breadcrumb__list flex container">
          <li><a :href="route('home')" class="breadcrumb__link">Trang chủ</a></li>
          <li><span class="breadcrumb__link"></span>></li>
          <li><span class="breadcrumb__link">Cửa hàng</span></li>
        </ul>
      </section>

      <!--=============== PRODUCTS ===============-->
      <section class="products container section--lg">
        <div class="shop__layout grid">
          <!-- FILTER SIDEBAR -->
          <aside class="shop__filter">
            <h3 class="filter__title">Bộ lọc</h3>

            <!-- Filter Giá -->
            <div class="filter__group">
              <h4 class="filter__heading">Khoảng giá</h4>

              <div class="filter__price">
                <input
                  type="text"
                  placeholder="Từ"
                  class="filter__input"
                  v-model="priceMinDisplay"
                />
                <span>-</span>
                <input
                  type="text"
                  placeholder="Đến"
                  class="filter__input"
                  v-model="priceMaxDisplay"
                />
              </div>

              <button class="filter__btn" @click="applyFilter">
                Áp dụng
              </button>
            </div>


            <!-- Filter Category -->
            <div class="filter__group">
              <h4 class="filter__heading">Danh mục</h4>

              <label
                v-for="cate in categories"
                :key="cate.id"
                class="filter__checkbox"
              >
                <input
                  type="checkbox"
                  :value="cate.id"
                  v-model="filter.category"
                  @change="applyFilter"
                />
                <span class="checkbox__custom"></span>
                <span class="checkbox__label">{{ cate.name }}</span>
              </label>
            </div>

          </aside>
          <!-- PRODUCTS LIST -->
          <div>
            <p class="total__products">
              Chúng tôi tìm thấy
              <span>{{ products.total }}</span>
              sản phẩm cho bạn!
            </p>  

            <div class="products__container grid">
              <div
                class="product__item"
                v-for="product in products.data"
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
                      :src="
                        product.secondary_image?.image_url
                        ?? product.primary_image?.image_url
                        ?? '/assets/img/default.jpg'
                      "
                      class="product__img hover"
                    />
                  </a>

                  <div class="product__actions">
                    <a href="#" class="action__btn" aria-label="Yêu thích">
                      <i class="fi fi-rs-heart"></i>
                    </a>
                  </div>

                  <div
                    v-if="product.quantity === 0"
                    class="product__badge light-red"
                  >
                    Hết hàng
                  </div>
                  <div
                    v-else
                    class="product__badge light-green"
                  >
                    Mới
                  </div>
                </div>

                <div class="product__content">
                  <span class="product__category">
                    {{ product.categories?.[0]?.name ?? 'Sản phẩm' }}
                  </span>

                  <a
                    v-if="product?.id"
                    :href="route('detail', { id: product.id })"
                  >
                    <h3 class="product__title">
                      {{ product.name }}
                    </h3>
                  </a>

                  <div class="product__rating">
                    <i
                      v-for="i in 5"
                      :key="i"
                      class="fi"
                      :class="
                        i <= Math.round(product.avg_rating)
                          ? 'fi-rs-star'
                          : 'fi-rs-star-empty'
                      "
                    ></i>
                  </div>

                  <div class="product__price flex">
                    <span class="new__price">
                      {{ Number(product.price).toLocaleString('vi-VN') }}₫
                    </span>
                  </div>

                  <a
                    href="#"
                    class="action__btn cart__btn"
                    aria-label="Thêm vào giỏ"
                    :class="{ disabled: product.quantity === 0 }"
                  >
                    <i class="fi fi-rs-shopping-bag-add"></i>
                  </a>
                </div>
              </div>
            </div>

            <ul
              v-if="products.last_page > 1"
              class="pagination"
            >
              <li
                v-for="link in products.links"
                :key="link.label"
                :class="[
                  'pagination__item',
                  {
                    active: link.active,
                    disabled: !link.url
                  }
                ]"
              >
                <!-- Link click được -->
                <a
                  v-if="link.url"
                  href="#"
                  class="pagination__link"
                  @click.prevent="$inertia.visit(link.url)"
                >
                  <span v-if="link.label.includes('Previous')">«</span>
                  <span v-else-if="link.label.includes('Next')">»</span>
                  <span v-else v-html="link.label"></span>
                </a>

                <!-- Không click được (disabled / active) -->
                <span
                  v-else
                  class="pagination__link"
                >
                  <span v-if="link.label.includes('Previous')">«</span>
                  <span v-else-if="link.label.includes('Next')">»</span>
                  <span v-else v-html="link.label"></span>
                </span>
              </li>
            </ul>
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
