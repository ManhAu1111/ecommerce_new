<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref, computed } from 'vue'

/* ================= STATS ================= */

const stats = ref([
  { label: 'Sản phẩm phổ biến', value: 12, icon: 'fa-fire' },
  { label: 'Sản phẩm bán chạy', value: 8, icon: 'fa-chart-line' },
  { label: 'Sản phẩm sắp hết', value: 3, icon: 'fa-box-open' },
])

/* ================= SEARCH ================= */

const search = ref('')

/* ================= DEMO DATA ================= */

const products = ref([
  {
    id: 1,
    name: 'Rubik 3x3 GAN 356',
    price: 350000,
    stock: 24,
    image: '/assets/img/category-4.jpg',
    sold: 120
  },
  {
    id: 2,
    name: 'Rubik 4x4 MoYu',
    price: 420000,
    stock: 5,
    image: '/assets/img/category-4.jpg',
    sold: 90
  },
  {
    id: 3,
    name: 'Rubik Mirror Silver',
    price: 280000,
    stock: 2,
    image: '/assets/img/category-4.jpg',
    sold: 70
  },
])

const filteredProducts = computed(() =>
  products.value.filter(p =>
    p.name.toLowerCase().includes(search.value.toLowerCase())
  )
)
</script>

<template>
<AdminLayout title="Quản Lý Sản Phẩm">

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
      <h3><i class="fa-solid fa-box"></i> Danh sách sản phẩm</h3>

      <div class="header-actions">

        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input
            v-model="search"
            type="text"
            placeholder="Tìm kiếm sản phẩm..."
          />
        </div>

        <button class="btn-add">
          <i class="fa-solid fa-plus"></i>
          Thêm sản phẩm
        </button>

      </div>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Tồn kho</th>
            <th>Đã bán</th>
            <th>Hành động</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="p in filteredProducts" :key="p.id">
            <td>#{{ p.id }}</td>

            <td>
              <img :src="p.image" class="product-img" />
            </td>

            <td class="name-cell">{{ p.name }}</td>

            <td>{{ p.price.toLocaleString() }}đ</td>

            <td :class="{ low: p.stock <= 5 }">
              {{ p.stock }}
            </td>

            <td>{{ p.sold }}</td>

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

.table-header h3 {
  display: flex;
  align-items: center;
  gap: 8px;
}

/* ================= SEARCH ================= */

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

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

/* ================= BUTTON ================= */

.btn-add {
  background: #0f766e;
  color: white;
  padding: 9px 18px;
  border-radius: 999px;
  border: none;
  display: flex;
  gap: 8px;
  align-items: center;
  cursor: pointer;
  transition: 0.2s;
}

.btn-add:hover {
  background: #115e59;
}

/* ================= TABLE ================= */

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  text-align: center;   /* căn giữa toàn bộ */
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

/* ================= IMAGE ================= */

.product-img {
  width: 65px;
  height: 65px;
  object-fit: cover;
  border-radius: 14px;
  margin: auto;   /* căn giữa hình */
}

/* ================= STOCK ================= */

.low {
  color: #dc2626;
  font-weight: 600;
}

/* ================= ACTION ================= */

.action-cell {
  display: flex;
  justify-content: center;   /* KHÔNG còn dồn phải */
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
  background: #fef3c7;
  color: #d97706;
}

.btn-delete {
  background: #fee2e2;
  color: #dc2626;
}

.btn-edit:hover,
.btn-delete:hover {
  transform: scale(1.1);
}

/* ================= MOBILE FULL ================= */

@media (max-width: 768px) {
  .product-img {
    margin: 0;           /* bỏ auto */
  }
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
    width: 100%;        /* FULL WIDTH */
  }

  .search-box input {
    width: 100%;
  }

  .btn-add {
    width: 100%;
    justify-content: center;
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
    justify-content: flex-end;   /* đẩy value sang phải */
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
  tbody td:nth-child(2)::before { content: "Hình ảnh"; }
  tbody td:nth-child(3)::before { content: "Tên"; }
  tbody td:nth-child(4)::before { content: "Giá"; }
  tbody td:nth-child(5)::before { content: "Tồn kho"; }
  tbody td:nth-child(6)::before { content: "Đã bán"; }
  tbody td:nth-child(7)::before { content: "Hành động"; }

}
</style>

