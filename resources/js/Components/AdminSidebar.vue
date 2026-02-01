<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
        <div class="dash__pad-1">
            <ul class="dash__f-list">
                <li>
                    <Link :class="{ 'dash-active': $page.url === '/admin/dashboard' }" href="/admin/dashboard">
                        <i class="fas fa-chart-line u-s-m-r-6"></i> Tổng Quan
                    </Link>
                </li>
                <li class="u-s-m-t-10">
                    <span class="dash__text u-s-m-b-8">QUẢN LÝ CỬA HÀNG</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-box-open u-s-m-r-6"></i> Sản Phẩm
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-list-alt u-s-m-r-6"></i> Danh Mục Sản Phẩm
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-shopping-bag u-s-m-r-6"></i> Đơn Hàng
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-users u-s-m-r-6"></i> Người Dùng
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.dash-active {
    background-color: hsl(176, 88%, 27%) !important; /* Teal */
    color: #fff !important;
    border-radius: 0.5rem;
    font-weight: 600;
}
.dash__f-list li a:hover {
    color: hsl(176, 88%, 27%);
}
</style>