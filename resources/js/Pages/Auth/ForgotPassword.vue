<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Forgot Password"/>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-gray-600 dark:text-white ">
                <div class="max-w-md mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg text-center">
                    <div class="mb-4 text-sm text-gray-600 dark:text-white">
                        Forgot your password? No problem. Just let us know your email address and we will email you a
                        password reset link that will allow you to choose a new one.
                    </div>

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <div class="dark:text-white">
                            <BreezeLabel for="email" value="Enter your Email" class="text-left dark:text-white"/>
                            <BreezeInput id="email" type="email" class="mt-1 block w-full dark:bg-neutral-800" v-model="form.email" required
                                         autofocus autocomplete="username"/>
                            <BreezeInputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Email Password Reset Link
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
