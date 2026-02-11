<script setup>
import { Link } from '@inertiajs/vue3'
import AdminSidebar from '@/Components/AdminSidebar.vue'
import { ref } from 'vue'

defineProps({
    title: String,
})

const sidebarOpen = ref(false)
</script>

<template>
<div class="admin-wrapper">

    <!-- ========== SIDEBAR ========== -->
    <aside :class="['admin-sidebar', { open: sidebarOpen }]">
        <AdminSidebar />
    </aside>

    <!-- Overlay mobile -->
    <div 
        v-if="sidebarOpen"
        class="admin-overlay"
        @click="sidebarOpen = false"
    ></div>

    <!-- ========== MAIN ========== -->
    <div class="admin-main">

        <!-- HEADER -->
        <header class="admin-header">

            <div class="admin-header__left">

                <button 
                    class="admin-menu-btn"
                    @click="sidebarOpen = !sidebarOpen"
                >
                    ☰
                </button>

                <div>
                    <!-- ===== BREADCRUMB MỚI ===== -->
                    <div class="admin-breadcrumb">
                        <Link 
                            :href="route('admin.dashboard')" 
                            class="admin-breadcrumb__link"
                        >
                            Admin
                        </Link>

                        <span 
                            v-if="title" 
                            class="admin-breadcrumb__separator"
                        >
                            /
                        </span>

                        <span 
                            v-if="title" 
                            class="admin-breadcrumb__current"
                        >
                            {{ title }}
                        </span>
                    </div>

                    <h1 v-if="title" class="admin-page-title">
                        {{ title }}
                    </h1>
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="admin-content">
            <div class="admin-content__card">
                <slot />
            </div>
        </main>

    </div>

</div>
</template>

<style scoped>

/* ================= WRAPPER ================= */

.admin-wrapper {
    display: flex;
    min-height: 100vh;
    background: #f8fafc;
}

/* ================= SIDEBAR ================= */

.admin-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: #0f172a;
    color: white;
    transition: 0.3s ease;
    overflow-y: auto; /* nếu menu dài sẽ scroll riêng */
}


/* ================= MAIN ================= */

.admin-main {
    margin-left: 260px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* ================= HEADER ================= */

.admin-header {
    position: fixed;
    top: 0;
    left: 260px;  /* đúng bằng width sidebar */
    right: 0;
    height: 90px; /* cố định chiều cao */
    background: #ffffff;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e5e7eb;
    z-index: 500;
}


.admin-header__left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* ================= MENU BTN ================= */

.admin-menu-btn {
    display: none;
    font-size: 22px;
    background: none;
    border: none;
    cursor: pointer;
}

/* ================= BREADCRUMB (MỚI) ================= */

.admin-breadcrumb {
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.admin-breadcrumb__link {
    font-weight: 600;
    color: #0f766e;
    text-decoration: none;
}

.admin-breadcrumb__link:hover {
    opacity: 0.7;
}

.admin-breadcrumb__separator {
    color: #9ca3af;
}

.admin-breadcrumb__current {
    color: #6b7280;
    font-weight: 500;
}

/* ================= TITLE ================= */

.admin-page-title {
    margin-top: 4px;
    font-size: 1.6rem;
    font-weight: 700;
    color: #111827;
}

/* ================= CONTENT ================= */

.admin-content {
    margin-top: 90px; /* đúng bằng header height */
    padding: 2rem;
    height: calc(100vh - 90px);
    overflow-y: auto;  /* 👈 content scroll riêng */
}


.admin-content__card {
    background: white;
    border-radius: 20px;
    border: 1px solid #e5e7eb;
    padding: 2rem;
}

/* ================= MOBILE ================= */

@media (max-width: 1024px) {

    .admin-sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        height: 100%;
        z-index: 1000;
    }

    .admin-sidebar.open {
        left: 0;
    }

    .admin-menu-btn {
        display: block;
    }

    .admin-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 999;
    }

}
/* ================= TABLET ================= */

@media (max-width: 1024px) {
    .admin-main {
        margin-left: 0;
    }
    
    .admin-header {
        padding: 1rem 1.5rem;
        left: 0;
    }

    .admin-content {
        padding: 1.5rem;
    }

    .admin-content__card {
        padding: 1.5rem;
        border-radius: 16px;
    }

    .admin-page-title {
        font-size: 1.4rem;
    }

}

/* ================= MOBILE ================= */

@media (max-width: 640px) {

    .admin-wrapper {
        flex-direction: column;
    }

    .admin-header {
        padding: 1rem;
    }

    .admin-header__left {
        align-items: flex-start;
    }

    .admin-page-title {
        font-size: 1.2rem;
        margin-top: 2px;
    }

    .admin-breadcrumb {
        font-size: 0.75rem;
        flex-wrap: wrap;
    }

    .admin-content {
        padding: 1rem;
    }

    .admin-content__card {
        padding: 1.2rem;
        border-radius: 14px;
    }

}

</style>
