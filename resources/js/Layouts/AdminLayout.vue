<script setup>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue'; // Import MainLayout
import AdminSidebar from '@/Components/AdminSidebar.vue';

defineProps({
    title: String,
});
</script>

<template>
    <MainLayout>
        <div class="admin-layout min-h-screen bg-gray-50">
            <div class="app-content">
                <div class="u-s-p-y-0">
                    <div class="section__content">
                        <div class="container mx-auto px-4">
                            <div class="breadcrumb py-4">
                                <div class="breadcrumb__wrap">
                                    <ul class="breadcrumb__list flex items-center space-x-2 text-sm text-gray-600">
                                        <li class="has-separator">
                                            <Link :href="route('admin.dashboard')" class="hover:text-orange-500">Admin</Link>
                                        </li>
                                        <li class="text-gray-400" v-if="title">/</li>
                                        <li class="is-marked font-bold text-gray-900" v-if="title">
                                            {{ title }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="u-s-p-b-60">
                <div class="section__content">
                    <div class="dash">
                        <div class="container mx-auto px-4">
                            <div class="flex flex-col lg:flex-row -mx-4">
                                
                                <div class="w-full lg:w-1/4 px-4 mb-6 lg:mb-0">
                                    <AdminSidebar />
                                </div>

                                <div class="w-full lg:w-3/4 px-4">
                                    <slot />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.u-s-p-y-0 { padding-top: 0; padding-bottom: 0; }
.u-s-p-b-60 { padding-bottom: 60px; }
.breadcrumb__list li a { transition: color 0.3s; }
.has-separator::after { content: ''; margin-left: 5px; }
.row { display: flex; flex-wrap: wrap; }
</style>