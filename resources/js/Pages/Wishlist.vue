<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { addToCart } from '@/Services/cartService'
import axios from 'axios'

const props = defineProps({
    wishlists: Array
})

// ❗ QUAN TRỌNG: tạo state local
const wishlistItems = ref([...props.wishlists])

const formatPrice = (value) => {
    if (!value) return '0'
    return Number(value).toLocaleString('vi-VN')
}


const toggleWishlistAjax = async (product) => {
    try {
        const res = await axios.post('/wishlist/toggle', {
            product_id: product.id
        })

        // nếu bỏ wishlist → remove khỏi list ngay
        if (!res.data.wishlisted) {
            wishlistItems.value = wishlistItems.value.filter(
                item => item.product.id !== product.id
            )
        }

        // 🔔 báo cho header cập nhật lại wishlist count
        window.dispatchEvent(new Event('wishlist-updated'))

    } catch (err) {
        if (err.response?.status === 401) {
            window.location.href = '/login'
        }
    }
}

// thêm giỏ hàng
const handleAddToCart = async (product) => {
    console.log('PRODUCT:', product)

    if (!product?.id) {
        console.error('Product has no id')
        return
    }

    try {
        await addToCart(product.id, 1)
    } catch (e) {
        console.error('Add to cart failed', e)
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
                            <tr v-for="item in wishlistItems" :key="item.id">
                                <td class="table__img-cell">
                                    <div class="table__img-wrapper">
                                        <img :src="item.product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                                            @click="router.visit(route('detail', item.product.id))"
                                            class="table__img" />
                                    </div>
                                </td>


                                <td>
                                    <h3 class="table__title">
                                        {{ item.product.name }}
                                    </h3>
                                    <p class="table__description">
                                        {{ item.product.short_description }}
                                    </p>
                                </td>

                                <td>
                                    <span class="table__price">
                                        {{ formatPrice(item.product.price) }}đ
                                    </span>
                                </td>

                                <td>
                                    <span class="table__stock">
                                        {{ item.product.quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                                    </span>
                                </td>

                                <td class="table__action-cell">
                                    <div class="table__actions">
                                        <!-- Xem sản phẩm -->
                                        <a :href="route('detail', item.product.id)" class="action-btn action-btn--view"
                                            aria-label="Xem chi tiết sản phẩm" data-tooltip="Xem sản phẩm">
                                            <i class="fi fi-rs-eye"></i>
                                        </a>

                                        <!-- Thêm vào giỏ -->
                                        <!-- <a href="#" class="action-btn action-btn--cart"
                                            aria-label="Thêm sản phẩm vào giỏ hàng" data-tooltip="Thêm vào giỏ hàng">
                                            <i class="fi fi-rs-shopping-bag-add"></i>
                                        </a> -->
                                        <button type="button" class="action-btn action-btn--cart"
                                            aria-label="Thêm sản phẩm vào giỏ hàng" data-tooltip="Thêm vào giỏ hàng"
                                            @click="handleAddToCart({ id: item.product_id })">
                                            <i class="fi fi-rs-shopping-bag-add"></i>
                                        </button>
                                    </div>
                                </td>

                                <td>
                                    <i class="fi fi-rs-trash table__trash"
                                        @click="toggleWishlistAjax(item.product)"></i>
                                </td>
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
