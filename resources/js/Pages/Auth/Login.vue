<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <MainLayout>
        <Head title="Đăng nhập" />

        <section class="login-register section--lg">
            <div class="login-register__container container grid" style="grid-template-columns: 1fr; max-width: 600px; margin-inline: auto;">
                <div class="login">
                    <h3 class="section__title" style="text-align: center;">Đăng nhập</h3>

                    <form @submit.prevent="submit" class="form grid">
                        <div>
                            <input
                                type="email"
                                placeholder="Địa chỉ Email"
                                class="form__input"
                                v-model="form.email"
                                required
                                style="width: 100%;"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <input
                                type="password"
                                placeholder="Mật khẩu"
                                class="form__input"
                                v-model="form.password"
                                required
                                style="width: 100%;"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-gray-600 underline hover:text-gray-900"
                            >
                                Quên mật khẩu?
                            </Link>
                        </div>

                        <div class="form__btn mt-4" style="display: flex; justify-content: flex-end;">
                            <button class="btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Đăng nhập
                            </button>
                        </div>

                        <div class="mt-4">
                            <p>Bạn chưa có tài khoản? <Link :href="route('register')" style="color: var(--first-color);">Đăng ký ngay</Link></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
