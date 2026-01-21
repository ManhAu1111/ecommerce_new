<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    email: {
        type: String,
        default: '',
    },
});

const form = useForm({
    email: props.email,
    otp: '',
});

const submit = () => {
    form.post(route('verification.verify_otp'), {
        onFinish: () => form.reset('otp'),
    });
};
</script>

<template>
    <MainLayout>
        <Head title="Xác thực Email" />

        <section class="login-register section--lg">
            <div class="login-register__container container grid" style="grid-template-columns: 1fr; max-width: 600px; margin-inline: auto;">
                <div class="register">
                    <h3 class="section__title" style="text-align: center;">Xác thực Email của bạn</h3>
                    <p class="text-center" style="margin-bottom: 1.5rem; text-align: center;">Vui lòng nhập mã 6 số đã được gửi đến email của bạn.</p>

                    <form @submit.prevent="submit" class="form grid">
                        <div>
                            <input type="email" placeholder="Email của bạn" class="form__input" v-model="form.email" required style="width: 100%;" :readonly="!!props.email" :class="{'opacity-75': !!props.email}" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <input type="text" placeholder="Nhập mã 6 số" class="form__input" v-model="form.otp" required style="width: 100%;" maxlength="6" />
                            <InputError class="mt-2" :message="form.errors.otp" />
                        </div>

                        <div class="form__btn mt-4" style="display: flex; justify-content: flex-end;">
                            <button class="btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Xác thực & Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
