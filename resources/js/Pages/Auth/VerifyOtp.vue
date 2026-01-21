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
        <Head title="Verify Email" />

        <section class="login-register section--lg">
            <div class="login-register__container container grid" style="grid-template-columns: 1fr; max-width: 600px; margin-inline: auto;">
                <div class="register">
                    <h3 class="section__title" style="text-align: center;">Verify Your Email</h3>
                    <p class="text-center" style="margin-bottom: 1.5rem; text-align: center;">Please enter the 6-digit code sent to your email.</p>

                    <form @submit.prevent="submit" class="form grid">
                        <div>
                            <input type="email" placeholder="Your Email" class="form__input" v-model="form.email" required style="width: 100%;" :readonly="!!props.email" :class="{'opacity-75': !!props.email}" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <input type="text" placeholder="Enter 6-digit Code" class="form__input" v-model="form.otp" required style="width: 100%;" maxlength="6" />
                            <InputError class="mt-2" :message="form.errors.otp" />
                        </div>

                        <div class="form__btn mt-4" style="display: flex; justify-content: flex-end;">
                            <button class="btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Verify & Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
