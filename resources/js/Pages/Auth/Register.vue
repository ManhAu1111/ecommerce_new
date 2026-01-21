<script setup>  
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <MainLayout>
        <Head title="Đăng ký" />

        <section class="login-register section--lg">
            <div class="login-register__container container grid" style="grid-template-columns: 1fr; max-width: 600px; margin-inline: auto;">
                <div class="register">
                    <h3 class="section__title" style="text-align: center;">Tạo tài khoản</h3>

                    <form @submit.prevent="submit" class="form grid">
                        <div>
                            <input type="text" placeholder="Họ và tên" class="form__input" v-model="form.name" required style="width: 100%;" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <input type="email" placeholder="Địa chỉ Email" class="form__input" v-model="form.email" required style="width: 100%;" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <input type="password" placeholder="Mật khẩu" class="form__input" v-model="form.password" required style="width: 100%;" />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4">
                            <input type="password" placeholder="Nhập lại mật khẩu" class="form__input" v-model="form.password_confirmation" required style="width: 100%;" />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>

                        <div class="form__btn mt-4" style="display: flex; justify-content: flex-end;">
                            <button class="btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Đăng ký
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
