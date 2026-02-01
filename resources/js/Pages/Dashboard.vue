<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Chart from 'chart.js/auto';

// --- Fake Data (Giữ nguyên) ---
const selectedDays = ref(30);
const stats = ref({ revenue: "15.500.000 đ", pendingOrders: 12, lowStockCount: 5 });
const recentOrders = ref([
    { public_id: 'ORD001', receiver_name: 'Nguyễn Văn A', status: 'paid', total_price: 1200000 },
    { public_id: 'ORD002', receiver_name: 'Trần Thị B', status: 'pending_payment', total_price: 850000 },
    { public_id: 'ORD003', receiver_name: 'Lê Văn C', status: 'completed', total_price: 2300000 },
    { public_id: 'ORD004', receiver_name: 'Phạm Minh D', status: 'delivering', total_price: 1500000 },
    { public_id: 'ORD005', receiver_name: 'Hoàng Anh E', status: 'cancelled', total_price: 0 },
]);
const lowStockProducts = ref([
    { id: 1, name: 'Áo thun Polo Nam', quantity: 3 },
    { id: 2, name: 'Quần Jean Slimfit', quantity: 8 },
    { id: 3, name: 'Giày Sneaker trắng', quantity: 2 },
    { id: 4, name: 'Thắt lưng da', quantity: 10 },
    { id: 5, name: 'Tất cổ cao', quantity: 5 },
]);

const fmtVND = (v) => new Intl.NumberFormat('vi-VN').format(v) + ' đ';
const translateStatus = (status) => {
    const map = { pending_payment: 'Chờ thanh toán', paid: 'Đang xử lý', delivering: 'Đang giao', completed: 'Hoàn thành', cancelled: 'Đã hủy' };
    return map[status] || status;
};

// --- Biểu đồ (Cập nhật màu Teal) ---
let revenueChart = null;
const initChart = () => {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    if (!ctx) return;
    revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['20/1', '21/1', '22/1', '23/1', '24/1', '25/1', '26/1', '27/1', '28/1', '29/1'],
            datasets: [{ 
                label: 'Doanh thu thực tế', 
                data: [120, 150, 180, 140, 200, 250, 210, 300, 280, 350].map(v => v * 10000), 
                backgroundColor: '#146C64', // Màu Teal từ --first-color
                borderRadius: 20 // Bo tròn thanh biểu đồ cho hiện đại
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false, 
            scales: { 
                y: { beginAtZero: true, ticks: { callback: v => fmtVND(v) } } 
            } 
        }
    });
};

onMounted(() => { initChart(); });
</script>

<template>
    <Head title="Tổng Quan Quản Trị" />

    <AdminLayout title="Tổng Quan Quản Trị">
        <div class="dashboard__content">
            <div class="flex flex-wrap -mx-3 mb-8">
                <div class="w-full md:w-1/3 px-3 mb-6">
                    <div class="stat__card h-full"> <div class="stat__icon color-1"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="stat__data">
                            <h3 class="stat__value text-lg font-bold">{{ stats.revenue }}</h3>
                            <span class="stat__label text-xs">Doanh thu ({{ selectedDays }} ngày)</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6">
                    <div class="stat__card h-full">
                        <div class="stat__icon color-2"><i class="fas fa-clock"></i></div>
                        <div class="stat__data">
                            <h3 class="stat__value text-lg font-bold">{{ stats.pendingOrders }}</h3>
                            <span class="stat__label text-xs">Đơn hàng mới</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6">
                    <div class="stat__card h-full">
                        <div class="stat__icon color-3"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="stat__data">
                            <h3 class="stat__value text-lg font-bold">{{ stats.lowStockCount }}</h3>
                            <span class="stat__label text-xs">Sản phẩm sắp hết</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content__card mb-8">
                <div class="card__header flex justify-between items-center mb-6">
                    <h3 class="card__title text-lg font-bold">BIỂU ĐỒ DOANH THU</h3>
                    <select v-model="selectedDays" class="select-box filter__select">
                        <option :value="10">10 ngày gần nhất</option>
                        <option :value="30">30 ngày gần nhất</option>
                        <option :value="60">60 ngày gần nhất</option>
                    </select>
                </div>
                <div class="chart__container" style="height: 350px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="row flex flex-wrap -mx-3">
                <div class="w-full lg:w-2/3 px-3 mb-6">
                    <div class="content__card h-full">
                        <h3 class="card__title mb-6">ĐƠN HÀNG GẦN ĐÂY</h3>
                        <div class="table__responsive">
                            <table class="admin__table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th>Tổng tiền</th>
                                        <th class="text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="order in recentOrders" :key="order.public_id">
                                        <td><strong>#{{ order.public_id }}</strong></td>
                                        <td>{{ order.receiver_name }}</td>
                                        <td class="text-center">
                                            <span :class="['status__badge', `status--${order.status}`]">
                                                {{ translateStatus(order.status) }}
                                            </span>
                                        </td>
                                        <td><span class="text-teal font-bold">{{ fmtVND(order.total_price) }}</span></td>
                                        <td class="text-right">
                                            <Link href="#" class="view__btn">Chi tiết</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/3 px-3 mb-6">
                    <div class="content__card h-full">
                        <h3 class="card__title mb-6 text-red-600">CẢNH BÁO KHO</h3>
                        <div class="stock__list">
                            <div v-for="p in lowStockProducts" :key="p.id" class="stock__item flex justify-between items-center py-4 border-b last:border-0">
                                <span class="stock__name font-medium text-sm truncate w-40" :title="p.name">{{ p.name }}</span>
                                <span class="stock__qty px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold">Còn {{ p.quantity }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
/* Màu sắc chủ đạo từ phong cách Home.vue */
:deep(.text-teal) { color: hsl(176, 88%, 27%); }

/* Card Style giống product__item */
.content__card, .stat__card {
    background: #fff;
    border: 1px solid hsl(129, 36%, 85%);
    border-radius: 1.5rem;
    padding: 1.5rem;
    transition: all 0.3s ease;
}
.content__card:hover, .stat__card:hover {
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
}

.card__title {
    font-family: 'Spartan', sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    color: hsl(0, 0%, 13%);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Widget Styles */
.stat__card {
    display: flex;
    align-items: center;
    column-gap: 1.25rem;
}
.stat__icon {
    width: 60px;
    height: 60px;
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.stat__icon.color-1 { background: #e8f5f4; color: #146C64; }
.stat__icon.color-2 { background: #fef9ec; color: #f1c40f; }
.stat__icon.color-3 { background: #fff1f1; color: #e74c3c; }

.stat__value {
    font-family: 'Spartan', sans-serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: #146C64;
}
.stat__label {
    font-size: 0.875rem;
    color: #7f8c8d;
}

/* Table Style */
.admin__table {
    width: 100%;
}
.admin__table th {
    padding: 1rem 0.5rem;
    border-bottom: 2px solid #f1f1f1;
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 700;
    color: #95a5a6;
}
.admin__table td {
    padding: 1.25rem 0.5rem;
    font-size: 0.875rem;
}

/* Status Badge y hệt product__badge style */
.status__badge {
    padding: 4px 12px;
    border-radius: 2.5rem;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
}
.status--paid { background-color: #e8f5f4; color: #146C64; }
.status--pending_payment { background-color: #fef9ec; color: #f39c12; }
.status--completed { background-color: #f0fff0; color: #27ae60; }
.status--cancelled { background-color: #fff1f1; color: #e74c3c; }

/* Filter Select */
.filter__select {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    cursor: pointer;
}

.view__btn {
    color: #146C64;
    font-weight: 700;
    font-size: 0.75rem;
    text-transform: uppercase;
    border-bottom: 2px solid transparent;
}
.view__btn:hover {
    border-bottom-color: #146C64;
}
</style>