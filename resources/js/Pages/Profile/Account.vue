<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, router, usePage, useForm } from '@inertiajs/vue3'
import { onMounted, ref, computed } from 'vue';

const activeTab = ref('dashboard');

const page = usePage()

const user = computed(() => page.props.auth?.user)

const changeTab = (tabName) => {
  activeTab.value = tabName;
};

// đổi tên
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

// đổi mẩt khẩu
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

// đăng xuất
const showLogoutModal = ref(false)

const logout = () => {
  router.post(route('logout'), {}, {
    onFinish: () => {
      router.visit(route('login'))
    }
  })
}

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
                <address class="address">
                  3522 Interstate <br />
                  75 Business Spur, <br />
                  Sault Ste. <br />
                  Marie, Mi 49783
                </address>
                <p class="city">New York</p>
                <a href="#" class="edit">Chỉnh sửa</a>
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
