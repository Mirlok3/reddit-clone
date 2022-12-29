<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="max-w-md mx-auto bg-white shadow rounded-md p-6 dark:bg-neutral-700">
            <div>
                <BreezeLabel for="name" value="Name" class="dark:text-white" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus autocomplete="name" />
                <BreezeInputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <BreezeLabel for="username" value="Username" class="dark:text-white mt-2" />
                <BreezeInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" autofocus autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" class="dark:text-white" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" class="dark:text-white" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" class="dark:text-white" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">
                    Already registered?
                </Link>

                <BreezeButton :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
