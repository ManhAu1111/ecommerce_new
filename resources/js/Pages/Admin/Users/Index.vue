<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref, computed } from 'vue'

/* ================= STATS ================= */

const stats = ref([
  { label: 'Tổng người dùng', value: 120, icon: 'fa-users' },
  { label: 'Đang hoạt động', value: 98, icon: 'fa-user-check' },
  { label: 'Bị khóa', value: 22, icon: 'fa-user-slash' },
])

/* ================= SEARCH ================= */

const search = ref('')

/* ================= DEMO DATA ================= */

const users = ref([
  {
    id: 1,
    name: 'Nguyễn Văn A',
    email: 'vana@gmail.com',
    role: 'customer',
    status: 'active',
    created_at: '01/02/2026'
  },
  {
    id: 2,
    name: 'Trần Minh B',
    email: 'minhb@gmail.com',
    role: 'staff',
    status: 'inactive',
    created_at: '28/01/2026'
  },
  {
    id: 3,
    name: 'Lê Hoàng C',
    email: 'hoangc@gmail.com',
    role: 'manager',
    status: 'active',
    created_at: '20/01/2026'
  },
])

const filteredUsers = computed(() =>
  users.value.filter(u =>
    u.name.toLowerCase().includes(search.value.toLowerCase())
  )
)

/* ================= FORMAT ================= */

const getRoleLabel = (role) => {
  if (role === 'customer') return 'Khách hàng'
  if (role === 'staff') return 'Nhân viên'
  if (role === 'manager') return 'Quản lý'
}

const getRoleClass = (role) => {
  if (role === 'customer') return 'badge customer'
  if (role === 'staff') return 'badge staff'
  if (role === 'manager') return 'badge manager'
}

const getStatusLabel = (status) => {
  return status === 'active' ? 'Hoạt động' : 'Bị khóa'
}

const getStatusClass = (status) => {
  return status === 'active'
    ? 'badge active'
    : 'badge inactive'
}
</script>
<template>
<AdminLayout title="Quản Lý Người Dùng">

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
      <h3><i class="fa-solid fa-users"></i> Danh sách người dùng</h3>

      <div class="header-actions">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input
            v-model="search"
            type="text"
            placeholder="Tìm kiếm người dùng..."
          />
        </div>
      </div>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="u in filteredUsers" :key="u.id">
            <td>#{{ u.id }}</td>

            <td>{{ u.name }}</td>

            <td>{{ u.email }}</td>

            <td>
              <span :class="getRoleClass(u.role)">
                {{ getRoleLabel(u.role) }}
              </span>
            </td>

            <td>
              <span :class="getStatusClass(u.status)">
                {{ getStatusLabel(u.status) }}
              </span>
            </td>

            <td>{{ u.created_at }}</td>

            <td class="action-cell">
              <button class="btn-edit">
                <i class="fa-solid fa-pen"></i>
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
/* Badge chung */
.badge {
  padding: 5px 12px;
  border-radius: 999px;
  font-size: 0.75rem;
  font-weight: 600;
}

/* Role */
.customer {
  background: #e0f2fe;
  color: #0284c7;
}

.staff {
  background: #ede9fe;
  color: #7c3aed;
}

.manager {
  background: #fef3c7;
  color: #d97706;
}

/* Status */
.active {
  background: #dcfce7;
  color: #16a34a;
}

.inactive {
  background: #fee2e2;
  color: #dc2626;
}

/* Giữ nguyên toàn bộ CSS layout từ trang Orders */

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