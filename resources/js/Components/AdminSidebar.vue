<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const showLogoutModal = ref(false)

const logout = () => {
    router.post(route('logout'))
}
</script>

<template>
<div class="sidebar">

     <div class="sidebar-top">
        <div class="sidebar-logo">
            <img src="/assets/img/logo-removebg-toymark.png" />
            <span>ADMIN PANEL</span>
        </div>

    <!-- MENU -->
        <nav class="sidebar-menu">

            <Link :href="route('admin.dashboard')" 
                :class="['menu-item', { active: route().current('admin.dashboard') }]">
                <i class="fa-solid fa-chart-line"></i>
                <span>Tổng Quan</span>
            </Link>

            <Link :href="route('admin.products')" 
                :class="['menu-item', { active: route().current('admin.products') }]">
                <i class="fa-solid fa-box"></i>
                <span>Sản Phẩm</span>
            </Link>

            <Link :href="route('admin.categories')" 
                :class="['menu-item', { active: route().current('admin.categories') }]">
                <i class="fa-solid fa-layer-group"></i>
                <span>Danh Mục</span>
            </Link>

            <Link :href="route('admin.orders')" 
                :class="['menu-item', { active: route().current('admin.orders') }]">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Đơn Hàng</span>
            </Link>

            <Link :href="route('admin.users')" 
                :class="['menu-item', { active: route().current('admin.users') }]">
                <i class="fa-solid fa-users"></i>
                <span>Người Dùng</span>
            </Link>

        </nav>
    </div>

    <!-- LOGOUT -->
    <div class="sidebar-footer">
        <button class="logout-btn" @click="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            Đăng xuất
        </button>
    </div>
</div>
</template>

<style scoped>
/* ================= SIDEBAR ================= */

.sidebar {
    width: 260px;
    height: 100vh;
    background: linear-gradient(
        to bottom,
        #0a0e14 0%,   
        #121c33 100%  
    );

    display: flex;
    flex-direction: column;
    padding: 0;                 /* bỏ padding để logo full */
}

/* ================= TOP AREA ================= */

.sidebar-top {
    padding: 2rem 1.5rem 1rem 1.5rem;
}

/* ================= LOGO ================= */

.sidebar-logo {
    width: 100%;
    text-align: center;
    margin-bottom: 1.5rem;
}

.sidebar-logo img {
    width: 100%;        /* FULL WIDTH */
    max-width: 190px;   /* không quá to */
    object-fit: contain;
    display: block;
    margin: 0 auto; 
}

.sidebar-logo span {
    display: block;
    margin-top: 10px;
    color: white;
    font-weight: 600;
    letter-spacing: 2px;
    font-size: 0.95rem;
}

/* ================= MENU ================= */

.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 16px;
    border-radius: 14px;
    color: #cbd5e1;
    transition: 0.25s;
    font-size: 0.95rem;
}

.menu-item i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
}

.menu-item:hover {
    background: #1e293b;
    color: white;
}

.menu-item.active {
    background: #0f766e;
    color: white;
}

/* ================= PUSH FOOTER DOWN ================= */

.sidebar-footer {
    margin-top: auto;       /* 👈 cái này đẩy logout xuống đáy */
    padding: 1.5rem;
}

/* ================= LOGOUT ================= */

.logout-btn {
    width: 100%;
    padding: 14px;
    border-radius: 16px;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
    background: #1e293b;
    color: #f87171;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: 0.25s;
}

.logout-btn:hover {
    background: #dc2626;
    color: white;
}

</style>
