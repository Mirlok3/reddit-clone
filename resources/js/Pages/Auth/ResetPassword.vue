<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Reset Password"/>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-gray-600 dark:text-white ">
                <div class="max-w-md mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg">
                    <h2 class="text-center text-xl font-bold mb-5">Reset Password</h2>
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="email" value="Email" class="dark:text-white"/>
                            <BreezeInput id="email" type="email" class="mt-1 block w-full dark:bg-neutral-800" v-model="form.email" required
                                         autofocus autocomplete="username"/>
                            <BreezeInputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="password" value="Password" class="dark:text-white"/>
                            <BreezeInput id="password" type="password" class="mt-1 block w-full dark:bg-neutral-800" v-model="form.password"
                                         required autocomplete="new-password"/>
                            <BreezeInputError class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="password_confirmation" value="Confirm Password" class="dark:text-white"/>
                            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full dark:bg-neutral-800"
                                         v-model="form.password_confirmation" required autocomplete="new-password"/>
                            <BreezeInputError class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Reset Password
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
