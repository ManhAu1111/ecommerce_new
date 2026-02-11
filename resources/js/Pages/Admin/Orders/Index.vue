<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref, computed } from 'vue'

/* ================= STATS ================= */

const stats = ref([
  { label: 'Chờ duyệt', value: 5, icon: 'fa-clock' },
  { label: 'Đang giao', value: 3, icon: 'fa-truck' },
  { label: 'Đã giao', value: 12, icon: 'fa-circle-check' },
])

/* ================= SEARCH ================= */

const search = ref('')

/* ================= DEMO DATA ================= */

const orders = ref([
  {
    id: 101,
    customer: 'Nguyễn Văn A',
    total: 850000,
    status: 'pending',
    date: '11/02/2026'
  },
  {
    id: 102,
    customer: 'Trần Minh B',
    total: 1200000,
    status: 'shipping',
    date: '10/02/2026'
  },
  {
    id: 103,
    customer: 'Lê Hoàng C',
    total: 650000,
    status: 'completed',
    date: '09/02/2026'
  },
])

const filteredOrders = computed(() =>
  orders.value.filter(o =>
    o.customer.toLowerCase().includes(search.value.toLowerCase())
  )
)

const getStatusLabel = (status) => {
  if (status === 'pending') return 'Chờ duyệt'
  if (status === 'shipping') return 'Đang giao'
  if (status === 'completed') return 'Đã giao'
}

const getStatusClass = (status) => {
  if (status === 'pending') return 'status pending'
  if (status === 'shipping') return 'status shipping'
  if (status === 'completed') return 'status completed'
}
</script>

<template>
<AdminLayout title="Quản Lý Đơn Hàng">

<div class="dashboard">

  <!-- ================= STATS ================= -->

  <div class="stats-wrapper">
    <div
      v-for="item in stats"
      :key="item.label"
      class="stat-card"
    >
      <i :class="['fa-solid', item.icon]"></i>
      <div>
        <p class="stat-label">{{ item.label }}</p>
        <p class="stat-number">{{ item.value }}</p>
      </div>
    </div>
  </div>

  <!-- ================= TABLE CARD ================= -->

  <div class="table-card">

    <div class="table-header">
      <h3><i class="fa-solid fa-cart-shopping"></i> Danh sách đơn hàng</h3>

      <div class="header-actions">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input
            v-model="search"
            type="text"
            placeholder="Tìm khách hàng..."
          />
        </div>
      </div>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="o in filteredOrders" :key="o.id">
            <td>#{{ o.id }}</td>

            <td class="name-cell">{{ o.customer }}</td>

            <td>{{ o.total.toLocaleString() }}đ</td>

            <td>{{ o.date }}</td>

            <td>
              <span :class="getStatusClass(o.status)">
                {{ getStatusLabel(o.status) }}
              </span>
            </td>

            <td class="action-cell">
              <button class="btn-edit">
                <i class="fa-solid fa-eye"></i>
              </button>
              <button class="btn-delete">
                <i class="fa-solid fa-trash"></i>
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

/* ================= TABLE CARD ================= */

.table-card {
  background: #ffffff;
  border-radius: 22px;
  padding: 2rem;
  border: 1px solid #e5e7eb;
  box-shadow: 0 8px 30px rgba(0,0,0,0.03);
}

.table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  gap: 1rem;
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

/* ================= SEARCH ================= */

.search-box {
  position: relative;
  width: 260px;
}

.search-box i {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
}

.search-box input {
  width: 100%;
  padding: 9px 16px 9px 40px;
  border-radius: 999px;
  border: 1px solid #e5e7eb;
  transition: 0.2s;
}

.search-box input:focus {
  border-color: #0f766e;
  box-shadow: 0 0 0 3px rgba(15,118,110,0.1);
}

/* ================= TABLE ================= */

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

/* ================= STATUS BADGE ================= */

.status {
  padding: 5px 12px;
  border-radius: 999px;
  font-size: 0.75rem;
  font-weight: 600;
}

.pending {
  background: #fef3c7;
  color: #d97706;
}

.shipping {
  background: #dbeafe;
  color: #2563eb;
}

.completed {
  background: #dcfce7;
  color: #16a34a;
}

/* ================= ACTION ================= */

.action-cell {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.btn-edit,
.btn-delete {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  border: none;
  cursor: pointer;
  transition: 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-edit {
  background: #e0f2fe;
  color: #0284c7;
}

.btn-delete {
  background: #fee2e2;
  color: #dc2626;
}

.btn-edit:hover,
.btn-delete:hover {
  transform: scale(1.1);
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

  .table-header {
    flex-direction: column;
    align-items: stretch;
  }

  .header-actions {
    flex-direction: column;
    width: 100%;
  }

  .search-box {
    width: 100%;
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
    padding: 0.7rem 1rem 0.7rem 110px;
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

  tbody td:nth-child(1)::before { content: "ID"; }
  tbody td:nth-child(2)::before { content: "Khách hàng"; }
  tbody td:nth-child(3)::before { content: "Tổng tiền"; }
  tbody td:nth-child(4)::before { content: "Ngày đặt"; }
  tbody td:nth-child(5)::before { content: "Trạng thái"; }
  tbody td:nth-child(6)::before { content: "Hành động"; }

}
</style>
