<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, onMounted, computed, watch } from 'vue'

const props = defineProps({
    cartItems: Array,
    total: Number,
    user: Object,
    defaultAddress: Object,
})

const SHIPPING_FEE = 30000

/* ===============================
   TÍNH TỔNG TIỀN
================================= */

const subTotal = computed(() =>
    props.cartItems.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    )
)

const grandTotal = computed(() =>
    subTotal.value + SHIPPING_FEE
)

/* ===============================
   FORM DATA
================================= */

const form = reactive({
    receiver_name: '',
    receiver_phone: '',
    receiver_email: '',
    province: '',
    district: '',
    ward: '',
    detail: '',
    note: '',
    payment_method: 'cod',
})

/* ===============================
   FULL ADDRESS (AUTO BUILD)
================================= */

const fullAddress = computed(() => {
    const provinceName =
        provinces.value.find(p => String(p.code) === String(form.province))?.name || ''

    const districtName =
        districts.value.find(d => String(d.code) === String(form.district))?.name || ''

    const wardName =
        wards.value.find(w => String(w.code) === String(form.ward))?.name || ''

    return [
        form.detail,
        wardName,
        districtName,
        provinceName
    ]
        .filter(v => v && v.trim() !== '')
        .join(', ')
})

/* ===============================
   LOCATION DATA
================================= */

const provinces = ref([])
const districts = ref([])
const wards = ref([])

/* ===============================
   LOAD PROVINCES
================================= */

async function loadProvinces() {
    try {
        const res = await fetch('https://provinces.open-api.vn/api/p/')
        provinces.value = await res.json()
    } catch (error) {
        console.error('Load provinces failed:', error)
    }
}

/* ===============================
   LOAD DISTRICTS
================================= */

async function loadDistricts(provinceCode) {
    if (!provinceCode) {
        districts.value = []
        wards.value = []
        return
    }

    try {
        const res = await fetch(
            `https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`
        )
        const data = await res.json()
        districts.value = data.districts || []
        wards.value = []
    } catch (error) {
        console.error('Load districts failed:', error)
    }
}

/* ===============================
   LOAD WARDS
================================= */

async function loadWards(districtCode) {
    if (!districtCode) {
        wards.value = []
        return
    }

    try {
        const res = await fetch(
            `https://provinces.open-api.vn/api/d/${districtCode}?depth=2`
        )
        const data = await res.json()
        wards.value = data.wards || []
    } catch (error) {
        console.error('Load wards failed:', error)
    }
}

/* ===============================
   WATCH SELECT
================================= */

watch(
    () => form.province,
    async (val) => {
        form.district = ''
        form.ward = ''
        await loadDistricts(val)
    }
)

watch(
    () => form.district,
    async (val) => {
        form.ward = ''
        await loadWards(val)
    }
)

/* ===============================
   DÙNG THÔNG TIN ĐÃ LƯU
================================= */

async function useSavedInfo() {
    if (!props.defaultAddress) return

    form.receiver_name =
        props.defaultAddress.receiver_name ?? props.user?.name ?? ''

    form.receiver_phone =
        props.defaultAddress.receiver_phone ?? ''

    form.receiver_email =
        props.user?.email ?? ''

    form.detail =
        props.defaultAddress.detail ?? ''

    form.note =
        props.defaultAddress.note ?? ''

    form.province =
        props.defaultAddress.province ?? ''

    await loadDistricts(form.province)

    form.district =
        props.defaultAddress.district ?? ''

    await loadWards(form.district)

    form.ward =
        props.defaultAddress.ward ?? ''
}

/* ===============================
   SUBMIT ORDER
================================= */

function submitOrder() {
    router.post(route('checkout.store'), {
        ...form,
        full_address: fullAddress.value,
    })
}
/* ===============================
   ON MOUNT
================================= */

onMounted(async () => {
    await loadProvinces()

    if (props.user) {
        form.receiver_name = props.user.name ?? ''
        form.receiver_email = props.user.email ?? ''
    }

    if (typeof Swiper !== 'undefined') {
        new Swiper('.categories__container', {
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })

        new Swiper('.new__container', {
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })
    }
})
</script>

<template>
    <MainLayout>
        <main class="main">

            <!-- Breadcrumb -->
            <section class="breadcrumb">
                <ul class="breadcrumb__list flex container">
                    <li><a :href="route('home')" class="breadcrumb__link">Trang chủ</a></li>
                    <li><span class="breadcrumb__link">></span></li>
                    <li><a :href="route('shop')" class="breadcrumb__link">Cửa hàng</a></li>
                    <li><span class="breadcrumb__link">></span></li>
                    <li><span class="breadcrumb__link">Thanh toán</span></li>
                </ul>
            </section>

            <!-- Checkout -->
            <section class="checkout section--lg">
                <div class="checkout__container container grid">

                    <!-- LEFT: FORM -->
                    <div class="checkout__group">
                        <h3 class="section__title">Thông tin thanh toán</h3>

                        <form class="form grid" @submit.prevent="submitOrder">

                            <div class="saved-info-btn" @click="useSavedInfo">
                                <div class="circle-btn">
                                    ↺
                                </div>
                                <span>Dùng thông tin đã lưu</span>
                            </div>

                            <input v-model="form.receiver_name" type="text" placeholder="Họ và tên người nhận"
                                class="form__input" required />

                            <input v-model="form.receiver_phone" type="text" placeholder="Số điện thoại"
                                class="form__input" required />

                            <input v-model="form.receiver_email" type="email" placeholder="Email" class="form__input" />

                            <!-- PROVINCE -->
                            <select v-model="form.province" class="form__input" required>
                                <option value="">Chọn Tỉnh / Thành phố</option>
                                <option v-for="p in provinces" :key="p.code" :value="p.code">
                                    {{ p.name }}
                                </option>
                            </select>

                            <!-- DISTRICT -->
                            <select v-model="form.district" class="form__input" :disabled="!form.province" required>
                                <option value="">Chọn Quận / Huyện</option>
                                <option v-for="d in districts" :key="d.code" :value="d.code">
                                    {{ d.name }}
                                </option>
                            </select>

                            <!-- WARD -->
                            <select v-model="form.ward" class="form__input" :disabled="!form.district" required>
                                <option value="">Chọn Phường / Xã</option>
                                <option v-for="w in wards" :key="w.code" :value="w.code">
                                    {{ w.name }}
                                </option>
                            </select>

                            <input v-model="form.detail" type="text"
                                placeholder="Địa chỉ chi tiết (số nhà, tên đường...)" class="form__input" required />

                            <!-- ĐỊA CHỈ ĐẦY ĐỦ (AUTO) -->
                            <input :value="fullAddress" type="text" class="form__input" placeholder="Địa chỉ đầy đủ"
                                readonly />

                            <h3 class="checkout__title">Thông tin bổ sung</h3>

                            <textarea v-model="form.note" placeholder="Ghi chú" class="form__input textarea">
                            </textarea>

                            <!-- <button type="submit" class="btn btn--md">
                                Xác nhận đặt hàng
                            </button> -->

                        </form>
                    </div>

                    <!-- RIGHT: ORDER SUMMARY -->
                    <div class="checkout__group order-summary">

                        <h3 class="section__title">Tổng đơn hàng</h3>

                        <table class="order__table">
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th class="text-right">Tổng cộng</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="item in cartItems" :key="item.id" class="order__item">
                                    <td class="order__img-cell">
                                        <img :src="item.product.primary_image?.image_url ?? '/assets/img/default.jpg'"
                                            class="order__img" />
                                    </td>

                                    <td class="order__info">
                                        <h4 class="table__title">{{ item.product.name }}</h4>
                                        <p class="table__quantity">x {{ item.quantity }}</p>
                                    </td>

                                    <td class="order__price text-right">
                                        {{ (item.price * item.quantity).toLocaleString('vi-VN') }}₫
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- SUMMARY BLOCK -->
                        <div class="order__totals">

                            <div class="total__row">
                                <span>Tạm tính</span>
                                <span>{{ subTotal.toLocaleString('vi-VN') }}₫</span>
                            </div>

                            <div class="total__row">
                                <span>Phí vận chuyển</span>
                                <span>30.000₫</span>
                            </div>

                            <div class="total__row total__grand">
                                <span>Tổng cộng</span>
                                <span>{{ grandTotal.toLocaleString('vi-VN') }}₫</span>
                            </div>

                        </div>

                        <!-- PAYMENT -->
                        <div class="payment__methods">
                            <h3 class="checkout__title payment__title">
                                Phương thức thanh toán
                            </h3>

                            <div class="payment__option">
                                <input type="radio" value="cod" v-model="form.payment_method" />
                                <label>Thanh toán khi nhận hàng</label>
                            </div>

                            <div class="payment__option">
                                <input type="radio" value="momo" v-model="form.payment_method" />
                                <label>Thanh toán MoMo</label>
                            </div>
                        </div>

                        <button type="button" class="btn btn--md order__btn" @click="submitOrder">
                            Xác nhận đặt hàng
                        </button>

                    </div>

                </div>
            </section>
        </main>
    </MainLayout>
</template>
