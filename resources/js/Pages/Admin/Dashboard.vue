<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'

/* ================= STATS ================= */

const stats = ref([
  { label: 'Doanh thu', value: '15.500.000 đ', icon: 'fa-coins' },
  { label: 'Đơn hàng mới', value: 12, icon: 'fa-cart-shopping' },
  { label: 'Sắp hết hàng', value: 5, icon: 'fa-box-open' },
  { label: 'Tổng người dùng', value: 284, icon: 'fa-users' },
])

/* ================= ORDERS ================= */

const orders = ref([
  { id: 'ORD001', name: 'Nguyễn Văn A', total: 1200000, status: 'paid' },
  { id: 'ORD002', name: 'Trần Thị B', total: 850000, status: 'pending' },
  { id: 'ORD003', name: 'Lê Văn C', total: 2300000, status: 'completed' },
  { id: 'ORD004', name: 'Phạm Minh D', total: 1500000, status: 'cancelled' },
])

const fmtVND = (v) =>
  new Intl.NumberFormat('vi-VN').format(v) + ' đ'

const translateStatus = (s) => {
  const map = {
    paid: 'Chờ duyệt',
    pending: 'Đang giao',
    completed: 'Đã giao',
    cancelled: 'Đã huỷ'
  }
  return map[s] || s
}

/* ================= CHART ================= */

onMounted(() => {
  const ctx = document.getElementById('revenueChart')
  if (!ctx) return

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['20/1','21/1','22/1','23/1','24/1','25/1','26/1'],
      datasets: [{
        label: 'Doanh thu',
        data: [120,180,150,220,260,300,280].map(v => v * 10000),
        borderColor: '#0f766e',
        backgroundColor: 'rgba(15,118,110,0.1)',
        fill: true,
        tension: 0.4,
        pointRadius: 4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: v => fmtVND(v)
          }
        }
      }
    }
  })
})
</script>


<template>
<AdminLayout title="Tổng Quan Hệ Thống">

<div class="dashboard">

  <!-- ================= STATS ================= -->

  <div class="stats-wrapper">
    <div v-for="item in stats" :key="item.label" class="stat-card">
      <div class="stat-icon">
        <i :class="['fa-solid', item.icon]"></i>
      </div>
      <div>
        <p class="stat-label">{{ item.label }}</p>
        <p class="stat-number">{{ item.value }}</p>
      </div>
    </div>
  </div>

  <!-- ================= CHART ================= -->

  <div class="table-card">
    <h3 class="section-title">
      <i class="fa-solid fa-chart-line"></i>
      Biểu đồ doanh thu
    </h3>
    <div class="chart-wrapper">
      <canvas id="revenueChart"></canvas>
    </div>
  </div>

  <!-- ================= TABLE ================= -->

  <div class="table-card">
    <div class="table-header">
      <h3>
        <i class="fa-solid fa-receipt"></i>
        Đơn hàng gần đây
      </h3>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Mã</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Chi tiết</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="o in orders" :key="o.id">
            <td>#{{ o.id }}</td>
            <td>{{ o.name }}</td>
            <td class="price">{{ fmtVND(o.total) }}</td>
            <td>
              <span :class="['badge', `badge--${o.status}`]">
                {{ translateStatus(o.status) }}
              </span>
            </td>
            <td class="action-cell">
              <button class="btn-detail">
                <i class="fa-solid fa-eye"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

</div>

</AdminLayout>
</template>

<style scoped>
/* ================= LAYOUT ================= */

.dashboard {
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

/* ================= STATS ================= */

.stats-wrapper {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
}

.stat-card {
  flex: 1;
  min-width: 220px;
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 1.5rem;
  background: #ffffff;
  border-radius: 18px;
  border: 1px solid #e5e7eb;
  transition: 0.3s ease;
}

.stat-card i {
  font-size: 1.6rem;
  color: #0f766e;
}

.stat-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.06);
}

.stat-label {
  font-size: 0.85rem;
  color: #6b7280;
}

.stat-number {
  font-size: 1.6rem;
  font-weight: 700;
  color: #111827;
}

/* ================= CARD ================= */

.table-card {
  background: #ffffff;
  border-radius: 22px;
  padding: 2rem;
  border: 1px solid #e5e7eb;
  box-shadow: 0 8px 30px rgba(0,0,0,0.03);
}

.section-title {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 2rem;
}

/* ================= CHART ================= */

.chart-wrapper {
  height: 300px;
}

/* ================= TABLE ================= */

.table-wrapper {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  text-align: center;
  padding: 1rem 0;
  vertical-align: middle;
}

th {
  font-size: 0.75rem;
  text-transform: uppercase;
  color: #6b7280;
  border-bottom: 1px solid #e5e7eb;
}

tbody tr:hover {
  background: #f9fafb;
}

.price {
  font-weight: 600;
  color: #0f766e;
}

/* ================= BADGE ================= */

.badge {
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 600;
}

.badge--paid { background:#e6fffa; color:#0f766e; }
.badge--pending { background:#fef9c3; color:#ca8a04; }
.badge--completed { background:#dcfce7; color:#15803d; }
.badge--cancelled { background:#fee2e2; color:#dc2626; }

/* ================= ACTION ================= */

.action-cell {
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn-detail {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  border: none;
  cursor: pointer;
  transition: 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #e6fffa;
  color: #0f766e;
}

.btn-detail:hover {
  transform: scale(1.1);
  background: #0f766e;
  color: white;
}

/* ================= MOBILE ================= */

@media (max-width: 768px) {
  .action-cell {
    display: flex;
    justify-content: flex-end;  /* đẩy hẳn sang phải */
    width: 100%;
  }
  .table-card {
    padding: 1.2rem;
  }

  .chart-wrapper {
    height: 220px;
  }

  table,
  thead,
  tbody,
  th,
  td,
  tr {
    display: block;
    width: 100%;
  }

  thead {
    display: none;
  }

  tbody tr {
    background: #ffffff;
    padding: 1.2rem;
    border-radius: 18px;
    margin-bottom: 1.5rem;
    border: 1px solid #e5e7eb;
  }

  tbody td {
    position: relative;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0.7rem 1rem 0.7rem 130px;
    border-bottom: 1px solid #f1f5f9;
    text-align: right;
  }

  tbody td:last-child {
    border-bottom: none;
  }

  tbody td::before {
    position: absolute;
    left: 1rem;
    font-weight: 600;
    color: #6b7280;
  }

  tbody td:nth-child(1)::before { content: "Mã"; }
  tbody td:nth-child(2)::before { content: "Khách hàng"; }
  tbody td:nth-child(3)::before { content: "Tổng tiền"; }
  tbody td:nth-child(4)::before { content: "Trạng thái"; }
  tbody td:nth-child(5)::before { content: "Chi tiết"; }

}

</style>
