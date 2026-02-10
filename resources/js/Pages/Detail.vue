<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, watch, computed, onMounted } from 'vue'
import { addToCart } from '@/Services/cartService'
import axios from 'axios'

const relatedProducts = ref([])

const props = defineProps({
  product: Object
})

const qty = ref(1)

onMounted(async () => {
  const res = await axios.get(`/products/${props.product.id}/related`)
  relatedProducts.value = res.data
})

// đảm bảo không vượt min / max kể cả khi user gõ tay
watch(qty, (val) => {
  if (val < 1) qty.value = 1
  if (val > props.product.quantity) qty.value = props.product.quantity
})

/* trạng thái hiển thị: model hay image */
const activeType = ref('model')
const activeImage = ref(null)

/* giá VN */
const formattedPrice = computed(() =>
  Number(props.product.price).toLocaleString('vi-VN') + '₫'
)

const categories = computed(() => {
  return props.product.categories ?? []
})


/* đổi thumbnail */
function showModel() {
  activeType.value = 'model'
}

function showImage(src) {
  activeType.value = 'image'
  activeImage.value = src
}

const truncate = (text, limit = 50) => {
  if (!text) return ''
  return text.length > limit
    ? text.slice(0, limit) + '...'
    : text
}
const wishlisted = ref(props.product.is_wishlisted ?? false)

watch(
  () => props.product.is_wishlisted,
  (val) => {
    wishlisted.value = val ?? false
  }
)

const toggleWishlist = async () => {
  try {
    const res = await axios.post('/wishlist/toggle', {
      product_id: props.product.id
    })

    wishlisted.value = res.data.wishlisted
  } catch (err) {
    if (err.response?.status === 401) {
      window.location.href = '/login'
    } else {
      console.error(err)
    }
  }
}

const toggleRelatedWishlist = async (product) => {
  try {
    const res = await axios.post('/wishlist/toggle', {
      product_id: product.id
    })

    product.is_wishlisted = res.data.wishlisted
  } catch (err) {
    if (err.response?.status === 401) {
      window.location.href = '/login'
    }
  }
}

// Thêm vào giỏ hàng
const handleAddToCart = async () => {
  if (!props.product?.id || props.product.quantity === 0) return

  try {
    await addToCart(props.product.id, qty.value)
  } catch (err) {
    console.error('Add to cart failed', err)
  }
}

const handleAddRelatedToCart = async (product) => {
  if (!product?.id || product.quantity === 0) return

  try {
    await addToCart(product.id, 1)
  } catch (err) {
    console.error('Add related product failed', err)
  }
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
          <li><a :href="route('shop')" class="breadcrumb__link">Cửa hàng</a></li>
          <li><span class="breadcrumb__link"></span>></li>
          <li><span class="breadcrumb__link">{{ product.name }}</span></li>
        </ul>
      </section>

      <!--=============== DETAILS ===============-->
      <section class="details section--lg">
        <div class="details__container container grid">
          <div class="details">
            <div class="details__group">

              <!-- KHUNG HIỂN THỊ CHÍNH -->
              <div class="details__main">

                <!-- MODEL 3D -->
                <model-viewer v-show="activeType === 'model'" id="mainViewer" :src="product.model_url" camera-controls
                  auto-rotate camera-orbit="0deg 75deg 105%" min-camera-orbit="auto auto 80%"
                  max-camera-orbit="auto auto 120%" style="width:100%; height:100%;">
                </model-viewer>

                <!-- ẢNH LỚN -->
                <img v-show="activeType === 'image'" :src="activeImage" class="details__img" />
              </div>


              <!-- THANH ẢNH NHỎ -->
              <div class="details__small-images grid">

                <!-- THUMB MODEL -->
                <!-- MODEL -->
                <div class="thumb" :class="{ active: activeType === 'model' }" @click="showModel">
                  <model-viewer :src="product.model_url" interaction-prompt="none" disable-zoom disable-pan
                    disable-tap />
                </div>

                <!-- IMAGES -->
                <img v-for="img in product.images" :key="img.id" :src="img.image_url" class="details__small-img thumb"
                  :class="{ active: activeImage === img.image_url }" @click="showImage(img.image_url)" />

              </div>

            </div>
          </div>

          <div class="details__group">
            <h3 class="details__title">{{ product.name }}</h3>
            <p class="details__brand">
              Danh mục:
              <template v-for="(category, index) in categories" :key="category.id">
                <a :href="route('shop', { category: category.id })" class="details__category-link">
                  {{ category.name }}
                </a>
                <span v-if="index < categories.length - 1">, </span>
              </template>
            </p>
            <div class="details__price flex">
              <span class="new__price">{{ formattedPrice }}</span>
            </div>
            <p class="short__description">{{ product.description }}</p>
            <ul class="products__list">
              <li class="list__item flex">
                <i class="fi-rs-crown"></i> Đồ chơi chính hãng, an toàn cho trẻ em
              </li>
              <li class="list__item flex">
                <i class="fi-rs-refresh"></i> Hỗ trợ đổi trả trong 30 ngày
              </li>
              <li class="list__item flex">
                <i class="fi-rs-credit-card"></i> Thanh toán qua ví điện tử MOMO hoặc trực tiếp tiện lợi
              </li>
            </ul>
            <div class="details__action">
              <template v-if="product.quantity > 0">
                <input type="number" class="quantity" v-model.number="qty" :min="1" :max="product.quantity" />
              </template>

              <span v-else class="out-stock">
                Hết hàng
              </span>


              <button type="button" class="btn btn--sm" :disabled="product.quantity === 0" @click="handleAddToCart">
                Thêm vào giỏ hàng
              </button>

              <button type="button" class="details__action-btn" :class="{ active: wishlisted }" @click="toggleWishlist">
                <i class="fi" :class="wishlisted ? 'fi-sr-heart' : 'fi-rs-heart'"></i>
              </button>


            </div>
            <ul class="details__meta">
              <!-- <li class="meta__list flex"><span>SKU:</span>FWM15VKT</li>
              <li class="meta__list flex">
                <span>Tags:</span>Clothes, Women, Dress
              </li> -->
              <li class="meta__list flex">
                <span>Số lượng:</span>{{ product.quantity }} trong kho
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
      <!--=============== RELATED PRODUCTS ===============-->
      <section v-if="relatedProducts.length" class="products container section--lg">
        <h3 class="section__title">
          <span>Sản phẩm</span> liên quan
        </h3>

        <div class="products__container grid">
          <div class="product__item" v-for="product in relatedProducts" :key="product.id">
            <div class="product__banner">
              <a v-if="product?.id" :href="route('detail', { id: product.id })" class="product__images">
                <img :src="product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                  class="product__img default" />

                <img :src="product.secondary_image?.image_url
                  ?? product.primary_image?.image_url
                  ?? '/assets/img/default.jpg'
                  " class="product__img hover" />
              </a>

              <div class="product__actions">
                <button type="button" class="action__btn" :class="{ active: product.is_wishlisted }"
                  @click.stop="toggleRelatedWishlist(product)" aria-label="Thêm vào yêu thích"
                  title="Thêm vào yêu thích">
                  <i class="fi" :class="product.is_wishlisted ? 'fi-sr-heart' : 'fi-rs-heart'"></i>
                </button>
              </div>

              <div class="product__badge light-blue">
                Liên quan
              </div>
            </div>

            <div class="product__content">
              <span class="product__category">
                {{ product.categories?.[0]?.name ?? 'Sản phẩm' }}
              </span>

              <a v-if="product?.id" :href="route('detail', { id: product.id })">
                <h3 class="product__title">
                  {{ truncate(product.name, 50) }}
                </h3>
              </a>

              <div class="product__rating">
                <i v-for="i in 5" :key="i" class="fi" :class="i <= Math.round(product.avg_rating ?? 0)
                  ? 'fi-rs-star'
                  : 'fi-rs-star-empty'
                  "></i>
              </div>

              <div class="product__price flex">
                <span class="new__price">
                  {{ Number(product.price).toLocaleString('vi-VN') }}₫
                </span>
              </div>

              <button type="button" class="action__btn cart__btn" aria-label="Thêm vào giỏ hàng"
                :disabled="product.quantity === 0" @click.stop="handleAddRelatedToCart(product)">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </button>

            </div>
          </div>
        </div>
      </section>


      <!--=============== NEWSLETTER ===============-->
      <section class="newsletter section">
        <div class="newsletter__container container grid">
          <h3 class="newsletter__title flex">
            <img src="/assets/img/icon-email.svg" alt="" class="newsletter__icon" />
            Sign in to Newsletter
          </h3>
          <p class="newsletter__description">
            ...and receive $25 coupon for first shopping.
          </p>
          <form action="" class="newsletter__form">
            <input type="text" placeholder="Enter Your Email" class="newsletter__input" />
            <button type="submit" class="newsletter__btn">Subscribe</button>
          </form>
        </div>
      </section>
    </main>
  </MainLayout>
</template>
