<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, router, usePage, useForm } from '@inertiajs/vue3'
import { onMounted, ref, computed } from 'vue';

/* =========================
   TAB CONTROL
========================= */
const activeTab = ref('dashboard');

const changeTab = (tabName) => {
  activeTab.value = tabName;
};

/* =========================
   USER INFO
========================= */
const page = usePage()
const user = computed(() => page.props.auth?.user)

/* =========================
   UPDATE PROFILE
========================= */
const form = useForm({
  name: user.value?.name || '',
  email: user.value?.email || '',
})

const updateProfile = () => {
  form.put(route('profile.update'), {
    preserveScroll: true,
    onSuccess: () => {
      alert('Cập nhật tên người dùng thành công!')
    }
  })
}

/* =========================
   CHANGE PASSWORD
========================= */
const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const updatePassword = () => {
  passwordForm.put(route('password.update'), {
    preserveScroll: true,
    onSuccess: () => {
      passwordForm.reset()
      alert('Đổi mật khẩu thành công!')
    }
  })
}

const showPassword = ref({
  current: false,
  new: false,
  confirm: false,
})

/* =========================
   LOGOUT
========================= */
const showLogoutModal = ref(false)

const logout = () => {
  router.post(route('logout'), {}, {
    onFinish: () => {
      router.visit(route('login'))
    }
  })
}

/* =========================
   ADDRESS (VIETNAM API)
========================= */

const address = ref({
  province: '',
  district: '',
  ward: ''
})

const provinces = ref([])
const districts = ref([])
const wards = ref([])

const fetchProvinces = async () => {
  try {
    const res = await fetch('https://provinces.open-api.vn/api/p/')
    provinces.value = await res.json()
  } catch (error) {
    console.error('Lỗi load tỉnh:', error)
  }
}

const handleProvinceChange = async () => {
  address.value.district = ''
  address.value.ward = ''
  districts.value = []
  wards.value = []

  if (!address.value.province) return

  try {
    const res = await fetch(
      `https://provinces.open-api.vn/api/p/${address.value.province}?depth=2`
    )
    const data = await res.json()
    districts.value = data.districts
  } catch (error) {
    console.error('Lỗi load quận:', error)
  }
}

const handleDistrictChange = async () => {
  address.value.ward = ''
  wards.value = []

  if (!address.value.district) return

  try {
    const res = await fetch(
      `https://provinces.open-api.vn/api/d/${address.value.district}?depth=2`
    )
    const data = await res.json()
    wards.value = data.wards
  } catch (error) {
    console.error('Lỗi load phường:', error)
  }
}
const fullAddress = computed(() => {
  const province = provinces.value.find(
    p => p.code === address.value.province
  )

  const district = districts.value.find(
    d => d.code === address.value.district
  )

  const ward = wards.value.find(
    w => w.code === address.value.ward
  )

  return [
    address.value.detail,
    ward?.name,
    district?.name,
    province?.name
  ]
    .filter(Boolean)
    .join(', ')
})

onMounted(() => {
  fetchProvinces()
})

</script>


<template>
  <!-- Logout Confirm Modal -->
  <div v-if="showLogoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">
        Xác nhận đăng xuất
      </h2>

      <p class="text-gray-600 mb-6">
        Bạn có chắc chắn muốn đăng xuất khỏi tài khoản không?
      </p>

      <div class="flex justify-end gap-3">
        <button @click="showLogoutModal = false"
          class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
          Hủy
        </button>

        <button @click="logout" class="px-4 py-2 rounded-lg text-white bg-[#088179] hover:bg-[#066f68] transition">
          Đăng xuất
        </button>

      </div>
    </div>
  </div>


  <MainLayout>
    <main class="main">
      <!--=============== BREADCRUMB ===============-->
      <section class="breadcrumb">
        <ul class="breadcrumb__list flex container">
          <li><a :href="route('home')" class="breadcrumb__link">Trang chủ</a></li>
          <li><span class="breadcrumb__link">></span></li>
          <li><a :href="route('account')" class="breadcrumb__link">Tài khoản</a></li>
        </ul>
      </section>

      <!--=============== ACCOUNTS ===============-->
      <section class="accounts section--lg">
        <div class="accounts__container container grid">
          <div class="account__tabs">
            <p class="account__tab" :class="{ 'active-tab': activeTab === 'dashboard' }"
              @click="changeTab('dashboard')">
              <i class="fi fi-rs-settings-sliders"></i> Bảng điều khiển
            </p>

            <p class="account__tab" :class="{ 'active-tab': activeTab === 'orders' }" @click="changeTab('orders')">
              <i class="fi fi-rs-shopping-bag"></i> Đơn hàng
            </p>

            <p class="account__tab" :class="{ 'active-tab': activeTab === 'update-profile' }"
              @click="changeTab('update-profile')">
              <i class="fi fi-rs-user"></i> Cập nhật hồ sơ
            </p>

            <p class="account__tab" :class="{ 'active-tab': activeTab === 'address' }" @click="changeTab('address')">
              <i class="fi fi-rs-marker"></i> Địa chỉ của tôi
            </p>

            <p class="account__tab" :class="{ 'active-tab': activeTab === 'change-password' }"
              @click="changeTab('change-password')">
              <i class="fi fi-rs-settings-sliders"></i> Đổi mật khẩu
            </p>

            <p class="account__tab" @click="showLogoutModal = true">
              <i class="fi fi-rs-exit"></i> Đăng xuất
            </p>

          </div>
          <div class="tabs__content">
            <div class="tab__content" :class="{ 'active-tab': activeTab === 'dashboard' }"
              v-if="activeTab === 'dashboard'">
              <h3 class="tab__header">Xin chào, {{ user?.name }}</h3>
              <div class="tab__body">
                <p class="tab__description">
                  Từ bảng điều khiển tài khoản của bạn, bạn có thể dễ dàng kiểm tra & xem các đơn hàng gần đây, quản lý
                  địa chỉ giao hàng và thanh toán cũng như chỉnh sửa mật khẩu và thông tin tài khoản của bạn
                </p>
              </div>
            </div>

            <div class="tab__content" :class="{ 'active-tab': activeTab === 'orders' }" v-if="activeTab === 'orders'">
              <h3 class="tab__header">Đơn hàng của bạn</h3>
              <div class="tab__body">
                <table class="placed__order-table">
                  <thead>
                    <tr>
                      <th>Đơn hàng</th>
                      <th>Ngày</th>
                      <th>Trạng thái</th>
                      <th>Tổng tiền</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#1357</td>
                      <td>March 19, 2022</td>
                      <td>Đang xử lý</td>
                      <td>$125.00</td>
                      <td><a href="#" class="view__order">Xem</a></td>
                    </tr>
                    <tr>
                      <td>#2468</td>
                      <td>June 29, 2022</td>
                      <td>Hoàn thành</td>
                      <td>$364.00</td>
                      <td><a href="#" class="view__order">Xem</a></td>
                    </tr>
                    <tr>
                      <td>#2366</td>
                      <td>August 02, 2022</td>
                      <td>Hoàn thành</td>
                      <td>$280.00</td>
                      <td><a href="#" class="view__order">Xem</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="tab__content" :class="{ 'active-tab': activeTab === 'update-profile' }"
              v-if="activeTab === 'update-profile'">
              <h3 class="tab__header">Cập nhật hồ sơ</h3>
              <div class="tab__body">
                <form class="form grid" @submit.prevent="updateProfile">
                  <input type="text" placeholder="Tên người dùng" class="form__input" v-model="form.name" />
                  <input type="email" class="form__input" placeholder="Email" v-model="form.email" disabled />
                  <div class="form__btn">
                    <button type="submit" class="btn btn--md" :disabled="form.processing">Lưu</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="tab__content" :class="{ 'active-tab': activeTab === 'address' }" v-if="activeTab === 'address'">
              <h3 class="tab__header">Địa chỉ giao hàng</h3>
              <div class="tab__body">
                <div class="tab__body address__form">

                  <!-- Tỉnh -->
                  <div class="form__group">
                    <label>Tỉnh / Thành phố</label>
                    <select 
                      v-model="address.province" 
                      @change="handleProvinceChange"
                    >
                      <option disabled value="">Chọn tỉnh/thành</option>
                      <option 
                        v-for="province in provinces" 
                        :key="province.code" 
                        :value="province.code"
                      >
                        {{ province.name }}
                      </option>
                    </select>
                  </div>

                  <!-- Quận -->
                  <div class="form__group">
                    <label>Quận / Huyện</label>
                    <select 
                      v-model="address.district" 
                      @change="handleDistrictChange"
                      :disabled="!districts.length"
                    >
                      <option disabled value="">Chọn quận/huyện</option>
                      <option 
                        v-for="district in districts" 
                        :key="district.code" 
                        :value="district.code"
                      >
                        {{ district.name }}
                      </option>
                    </select>
                  </div>

                  <!-- Phường -->
                  <div class="form__group">
                    <label>Phường / Xã</label>
                    <select 
                      v-model="address.ward"
                      :disabled="!wards.length"
                    >
                      <option disabled value="">Chọn phường/xã</option>
                      <option 
                        v-for="ward in wards" 
                        :key="ward.code" 
                        :value="ward.code"
                      >
                        {{ ward.name }}
                      </option>
                    </select>
                  </div>
                  <div class="form__group">
                    <label>Địa chỉ chi tiết</label>
                    <input 
                      type="text" 
                      v-model="address.detail"
                      placeholder="Nhập số nhà, tên đường..."
                    />
                  </div>
                  <!-- Địa chỉ đầy đủ (auto) -->
                  <div class="form__group full-width">
                    <label>Địa chỉ đầy đủ</label>
                    <input 
                      type="text"
                      :value="fullAddress"
                      disabled
                      class="address__preview"
                    />
                  </div>

                  <div class="form__action full-width">
                    <button class="address__btn" @click="saveAddress">
                      Lưu địa chỉ
                    </button>
                  </div>

                </div>
              </div>
            </div>

            <div class="tab__content" :class="{ 'active-tab': activeTab === 'change-password' }"
              v-if="activeTab === 'change-password'">
              <h3 class="tab__header">Đổi mật khẩu</h3>
              <div class="tab__body">
                <form class="form grid" @submit.prevent="updatePassword">
                  <input type="password" placeholder="Mật khẩu hiện tại" class="form__input"
                    v-model="passwordForm.current_password" />
                  <p v-if="passwordForm.errors.current_password" class="text-red-500 text-sm">
                    {{ passwordForm.errors.current_password }}
                  </p>

                  <input type="password" placeholder="Mật khẩu mới" class="form__input"
                    v-model="passwordForm.password" />
                  <p v-if="passwordForm.errors.password" class="text-red-500 text-sm">
                    {{ passwordForm.errors.password }}
                  </p>

                  <input type="password" placeholder="Xác nhận mật khẩu" class="form__input"
                    v-model="passwordForm.password_confirmation" />
                  <p v-if="passwordForm.errors.password_confirmation" class="text-red-500 text-sm">
                    {{ passwordForm.errors.password_confirmation }}
                  </p>

                  <p v-if="passwordForm.errors.general" class="text-red-500 text-sm mb-2">
                    {{ passwordForm.errors.general }}
                  </p>

                  <div class="form__btn">
                    <button type="submit" class="btn btn--md" :disabled="passwordForm.processing">
                      Lưu
                    </button>
                  </div>
                </form>
              </div>
            </div>
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
